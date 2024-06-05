<?php

session_start();
class AdminClass
{
  private $db;
  public function __construct()
  {
    include(__DIR__ . "/db_connect.php");
    $this->db = $conn;
    $this->db->query('SET @@global.max_allowed_packet = ' . 500 * 1024 * 1024);

    date_default_timezone_set('Asia/Manila');
  }

  function __destruct()
  {
    $this->db->close();
    ob_end_flush();
  }

  function insertQuery($table, $data)
  {
    $key = implode(',', array_keys($data));
    $value = "'" . implode("','", array_values($data)) . "'";

    $sqlQuery = "INSERT INTO $table ($key) VALUES ($value)";
    return $sqlQuery;
  }

  function insertOverwriteQuery($table, $data)
  {
    $key = implode(',', array_keys($data));
    $value = "'" . implode("','", array_values($data)) . "'";

    // Build the ON DUPLICATE KEY UPDATE part of the query
    $updateClause = '';
    foreach ($data as $column => $val) {
      $updateClause .= "$column = '$val', ";
    }
    $updateClause = rtrim($updateClause, ', ');

    $sqlQuery = "INSERT INTO $table ($key) VALUES ($value) ON DUPLICATE KEY UPDATE $updateClause";
    return $sqlQuery;
  }
  function _staffLogin()
  {
    extract($_POST);

    $user = $this->db->query("SELECT * FROM staff WHERE username='$username'")->fetch_assoc();

    if (password_verify($password, $user["password"])) {
      foreach ($user as $key => $value) {
        $_SESSION["user_loggedin"] = true;
        if ($key != "password") {
          $_SESSION["$key"] = $value;
        }
      }
      header("location: " . $_SERVER["HTTP_REFERER"]."?status=true");
    }

    header("location: " . $_SERVER["HTTP_REFERER"]."?status=false");
  }

  function _loginUser() {
    extract($_POST);

    $user = $this->db->query("SELECT * FROM users WHERE username='$username'")->fetch_assoc();

    if (!$user) {
      header("location:" . $_SERVER["HTTP_REFERER"]."?status=false");
      return;
    }

    if (password_verify($_POST["password"], $user["password"])) {
      var_dump($user);
      $_SESSION["user_id"] = $user["user_id"];
      $_SESSION["is_loggedin"] = TRUE;
      $_SESSION["email"] = $user["email"];
      $_SESSION["fullname"] = $user["fullname"];
      $_SESSION["profile"] = $user["profile"];
      header("location: " . $_SERVER["HTTP_REFERER"]."/index.php?status=true");
    }  
    
  }
  function insertStudent()
  {
    extract($_POST);

    if ($_FILES) {
      foreach ($_FILES as $key => $File) {
        if (!empty($File["tmp_name"])) {
          $imageData = file_get_contents($File['tmp_name']);
          $data = base64_encode($imageData);
          $_POST[$key] = "data:image/png;base64," . $data;
        }
      }
    }
    if ($password != "") {
      $_POST["password"] = password_hash($password, PASSWORD_DEFAULT);
    } else {
      unset($_POST["password"]);
    }

    var_dump($_POST);
    $this->db->query($this->insertOverwriteQuery("users", $_POST));

    header("location: " . $_SERVER["HTTP_REFERER"]);
    return;
  }

  function signOut()
  {
    session_destroy();
    header("location: ./../index.php");
  }

  function getAllUsers()
  {
    return $this->db->query("SELECT * FROM users u LEFT JOIN learning_levels l ON u.level_id=l.level_id")->fetch_all(MYSQLI_ASSOC);
  }

  function getAllClassroomUsers($class_id)
  {
    return $this->db->query("SELECT * FROM users u LEFT JOIN learning_levels l ON u.level_id=l.level_id INNER JOIN classroom_users c ON u.user_id=c.user_id WHERE c.class_id='$class_id'")->fetch_all(MYSQLI_ASSOC);
  }
  function getUserClassrooms($user_id) {
    return $this->db->query("SELECT * FROM classrooms c INNER JOIN classroom_users cu ON c.class_id=cu.class_id INNER JOIN users u ON cu.user_id=u.user_id WHERE cu.user_id='$user_id'")->fetch_all(MYSQLI_ASSOC);
  }
  function getUserModules($class_id, $user_id) {
    return $this->db->query("SELECT * FROM class_modules cm INNER JOIN classroom_users cu ON cm.class_id=cu.class_id WHERE cu.user_id='$user_id' AND cm.class_id='$class_id'")->fetch_all(MYSQLI_ASSOC);
  }
  function getStudentsNotOnClassroom($class_id)
  {

    $array1 = $this->db->query("SELECT * FROM users u LEFT JOIN learning_levels l ON u.level_id=l.level_id")->fetch_all(MYSQLI_ASSOC);
    $array2 = $this->db->query("SELECT * FROM classroom_users WHERE class_id='$class_id'")->fetch_all(MYSQLI_ASSOC);

    foreach ($array1 as $key => $item1) {
      $id = $item1['user_id'];
      foreach ($array2 as $item2) {
        if ($item2['user_id'] === $id) {
          unset($array1[$key]); // Remove item from array1
          break; // No need to continue checking once a match is found
        }
      }
    }

    $array1 = array_values($array1);

    return $array1;
  }

  function getUser($user_id, $echo = true)
  {
    $result = $this->db->query("SELECT * FROM users u INNER JOIN learning_levels l ON u.level_id=l.level_id WHERE user_id='$user_id'")->fetch_assoc();
    
    if ($echo) {
      echo json_encode($result);
      return;
    }

    return $result;
  }

  function insertClassroom()
  {
    $this->db->query($this->insertOverwriteQuery("classrooms", $_POST));

    header("location:".$_SERVER["HTTP_REFERER"]);    
  }
  function getAllClassrooms()
  {
    return $this->db->query("SELECT * FROM classrooms")->fetch_all(MYSQLI_ASSOC);
  }
  function getClassroom($class_id, $echo = false)
  {
    $result = $this->db->query("SELECT * FROM classrooms WHERE class_id='$class_id'")->fetch_all(MYSQLI_ASSOC);
    if ($echo) {
      echo json_encode($result);
      return;
    }
    return $result;
  }

  function insertUser()
  {
    $this->db->query($this->insertOverwriteQuery("users", $_POST));
  }

  function insertStudentToClassroom()
  {
    extract($_POST);
    foreach (array_unique($selected_users) as $user_id) {
      $has_duplicates = $this->db->query("SELECT * FROM classroom_users WHERE class_id='$class_id' AND user_id='$user_id'")->fetch_all(MYSQLI_ASSOC);
      if (!$has_duplicates) {
        $user = array("class_id" => $class_id, "user_id" => $user_id);
        $this->db->query($this->insertOverwriteQuery("classroom_users", $user));

        $is_assigned = $this->db->query("SELECT * FROM user_grades WHERE class_id='$class_id' AND user_id='$user_id'")->fetch_assoc();
        if ($is_assigned) {
          $user["grade_id"] = $is_assigned["grade_id"];          
        }
        $this->db->query($this->insertOverwriteQuery("user_grades", $user));
      };
    }
  }
  function insertAnnouncement()
  {
    $this->db->query($this->insertOverwriteQuery("announcements", $_POST));
    header("location:" . $_SERVER["HTTP_REFERER"]);
  }
  function getAllAnnouncements()
  {
    return $this->db->query("SELECT * FROM announcements")->fetch_all(MYSQLI_ASSOC);
  }
  function getAnnouncement($announcement_id)
  {
    echo json_encode($this->db->query("SELECT * FROM announcements WHERE announcement_id='$announcement_id'")->fetch_all(MYSQLI_ASSOC));
  }
  function getSubjectUsers($year_level)
  {
    return $this->db->query("SELECT * FROM users u INNER JOIN classroom_users cu ON u.user_id=cu.user_id INNER JOIN classrooms c ON cu.class_id=c.class_id WHERE c.year_level='$year_level'")->fetch_all(MYSQLI_ASSOC);
  }

  function getAllUserGrades($class_id)
  {
    return $this->db->query("SELECT * FROM user_grades sg
    INNER JOIN users u ON sg.user_id=u.user_id
    INNER JOIN learning_levels ll ON u.level_id=ll.level_id 
    INNER JOIN classrooms c ON c.class_id=sg.class_id
    WHERE sg.class_id='$class_id' ")->fetch_all(MYSQLI_ASSOC);
  }

  function getUserSubjectGrade($subject_id, $user_id) {
    return $this->db->query("SELECT * FROM user_grades sg
    WHERE sg.user_id='$user_id' AND sg.subject_id='$subject_id'")->fetch_all(MYSQLI_ASSOC);
  }

  function getAllClassModules($class_id) {
    return $this->db->query("SELECT * FROM class_modules WHERE class_id='$class_id'")->fetch_all(MYSQLI_ASSOC);
  }

  function insertLearningLevel()
  {
    $this->db->query($this->insertOverwriteQuery("learning_levels", $_POST));
    header("location:" . $_SERVER["HTTP_REFERER"]);
  }
  function getAllLearningLevels()
  {
    return $this->db->query("SELECT * FROM learning_levels")->fetch_all(MYSQLI_ASSOC);
  }
  function getLearningLevel($level_id, $echo = false)
  {
    $result = $this->db->query("SELECT * FROM learning_levels WHERE level_id='$level_id'")->fetch_all(MYSQLI_ASSOC);
    if ($echo) {
      echo json_encode($result);
      return;
    }
    return $result;
  }
  function insertModule() {
    $array_files = array();
    if ($_FILES) {
      foreach ($_FILES as $key => $File) {
        if (!empty($File["tmp_name"])) {
          $imageData = file_get_contents($File['tmp_name']);
          $data = base64_encode($imageData);
          array_push($array_files, array("title" => $File["name"], "uri" => "data:application/pdf;base64," . $data));
        }
      }
    }

    $_POST["module_file"] = base64_encode(json_encode($array_files));

    $this->db->query($this->insertOverwriteQuery("class_modules", $_POST));
    header("location:".$_SERVER["HTTP_REFERER"]);    
  }

  function getModuleData($module_id) {
    return $this->db->query("SELECT * FROM class_modules WHERE module_id='$module_id'")->fetch_all(MYSQLI_ASSOC);
  }

  function deleteStudentToClassroom() {
    extract($_POST);
    $this->db->query("DELETE FROM classroom_users WHERE class_id='$class_id' AND user_id='$user_id'");
    $this->db->query("DELETE FROM user_grades WHERE subject_id='$subject_id' AND user_id='$user_id'");
  }

  function insertGrade() {
    $this->db->query($this->insertOverwriteQuery("user_grades", $_POST));
    header("location:".$_SERVER["HTTP_REFERER"]);    
  }

  function getUserGrade($grade_id, $echo = false) {
    $result = $this->db->query("SELECT * FROM user_grades WHERE grade_id='$grade_id'")->fetch_all(MYSQLI_ASSOC);
    if ($echo) {
      echo json_encode($result);
      return;
    }
    return $result;
  }

  function generateMasterlist() {
    extract($_POST);
    $students = $this->getSubjectUsers($year_level);

    foreach($students as $student) {
      $user_id = $student["user_id"];
      $has_duplicates = $this->db->query("SELECT * FROM user_grades WHERE user_id='$user_id' AND subject_id='$subject_id'")->fetch_all();
      if (!$has_duplicates) {
        $user_grade = array("user_id" => $user_id, "subject_id" => $subject_id);
        $this->db->query($this->insertQuery("user_grades", $user_grade));
      }
    }
    var_dump($students);
  }
  function insertModuleSubmit() {
    if ($_FILES) {
      foreach ($_FILES as $multi_files) {
        if (!empty($multi_files["tmp_name"])) {
          foreach($multi_files["tmp_name"] as $File) {
            $imageData = file_get_contents($File);
            $data = "data:image/png;base64," . base64_encode($imageData);
            $submit_data = ["module_id" => $_POST["module_id"], "user_id" => $_POST["user_id"], "file" => $data];
            $this->db->query($this->insertOverwriteQuery("module_submissions", $submit_data ));
          }
        }
      }
    }
    header("location:".$_SERVER["HTTP_REFERER"]);    
  }

  function deleteModule() {
    extract($_GET);
    $this->db->query("DELETE FROM class_modules WHERE module_id='$module_id'");
    $this->db->query("DELETE FROM module_submissions WHERE module_id='$module_id'");
    header("location: ./manage-classroom.php");    
  }

  function getModuleSubmissions($module_id) {
    return $this->db->query("SELECT * FROM module_submissions m INNER JOIN users u ON m.user_id=u.user_id WHERE module_id='$module_id' GROUP BY m.user_id")->fetch_all(MYSQLI_ASSOC);
  }
  
  function getUserSubmittedModule($module_id, $user_id) {
    return $this->db->query("SELECT * FROM module_submissions WHERE module_id='$module_id' AND user_id='$user_id'")->fetch_all(MYSQLI_ASSOC);
  }

  function getUserGrades($user_id) {
    return $this->db->query("SELECT * FROM user_grades u INNER JOIN classrooms c ON u.class_id=c.class_id WHERE u.user_id='$user_id'")->fetch_all(MYSQLI_ASSOC);
  }

  function getStudentPieChart() {
    $grades = $this->db->query("SELECT shortcode, (count(u.user_id)/2) AS count FROM users u INNER JOIN classroom_users cu INNER JOIN classrooms c ON cu.class_id=c.class_id WHERE u.remarks <> '' GROUP BY c.class_id")->fetch_all();

    return $grades;
  }

  function getStudentPieChart2() {
    $grades = $this->db->query("SELECT shortcode, (count(u.user_id)/2) AS count FROM users u INNER JOIN classroom_users cu INNER JOIN classrooms c ON cu.class_id=c.class_id WHERE u.remarks = '' GROUP BY c.class_id")->fetch_all();

    return $grades;
  }
}