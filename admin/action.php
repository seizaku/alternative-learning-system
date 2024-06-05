<?php 


ob_start();

include_once(__DIR__ . "/admin_class.php");
$crud = new AdminClass();
$action = isset($_GET["action"]) ? $_GET["action"] : "";

switch ($action) {
  // Authentication
  case "staff_auth":
    $crud->_staffLogin();
    break;
  case "user_login":
    $crud->_loginUser();
    break;
  case "insert_student":
    $crud->insertStudent();
    break;
  case "signout":
    $crud->signOut();
    break;
  case "get_user":
    $crud->getUser($_GET["user_id"]);
    break;
  case "insert_classroom":
    $crud->insertClassroom();
    break;
  case "get_classroom":
    $crud->getClassroom($_GET["class_id"], true);
    break;
  case "insert_classroom_user":
    $crud->insertStudentToClassroom();
    break;
  case "delete_classroom_user":
    $crud->deleteStudentToClassroom();
    break;
  case "get_announcement":
    $crud->getAnnouncement($_GET["announcement_id"]);
    break;
  case "insert_announcement":
    $crud->insertAnnouncement();
    break;
  case "insert_module":
    $crud->insertModule();
    break;
  case "insert_grade":
    $crud->insertGrade();
    break;
  case "grading_masterlist":
    $crud->generateMasterlist();
    break;
  case "get_user_grade":
    $crud->getUserGrade($_GET["grade_id"], true);
    break;
  case "insert_learning_level":
    $crud->insertLearningLevel();
    break;
  case "get_learning_level":
    $crud->getLearningLevel($_GET["level_id"], true);
    break;
  case "submit_modules":
    $crud->insertModuleSubmit();
    break;
  case "delete_module":
    $crud->deleteModule();
    break;
}

ob_end_flush();

?>