<?php include("./header.php"); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <section class="flex flex-col md:flex-row gap-4 justify-between my-8">
      <h1 class="text-2xl font-bold">Manage Students</h1>
      <button onclick="showModal()" class="py-2.5 px-5 bg-blue-700 hover:bg-blue-800 rounded-lg text-white max-w-xs w-full">New Student</button>
    </section>
    <section class="flex">
      <table id="datatable" class="ui sixteen wide centered column table" width="100%">
        <thead>
          <tr>
            <th>LRN</th>
            <th>Year Enrolled</th>
            <th>Learning Level</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>Gender</th>
          </tr>
        </thead>
        <tbody>
          <?php $users = $crud->getAllUsers(); ?>
          <?php foreach ($users as $user) : extract($user) ?>
            <tr onclick="viewItem(<?php echo $user_id ?>)" class="cursor-pointer">
              <td><?php echo $lrn ?></td>
              <td><?php echo date('Y', strtotime($date_created)) ?></td>
              <td><?php echo $level_name ?></td>
              <td><?php echo $fullname ?></td>
              <td><?php echo $email ?></td>
              <td><?php echo $birthdate ?></td>
              <td><?php echo $gender ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </section>
  </div>
</main>

<div id="modal" class="overflow-y-hidden bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 overflow-y-scroll h-screen">
  <div class="relative p-4 w-full m-auto flex flex-col justify-center max-w-4xl h-screen">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Student Form
        </h3>
        <button onclick="closeModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
          <i data-lucide="x"></i>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5 mt-8">
        <form action="./action.php?action=insert_student" method="POST" enctype="multipart/form-data">
          <input type="text" name="user_id" id="user_id" class="hidden">
          <img src="./assets/blank-profile.webp" id="profile_view" class="object-cover mx-auto h-24 w-24 border">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <div class="w-full md:col-span-3 my-4 space-y-2">
              <h1 class="text-xl font-medium">
                Student Information
              </h1>
              <hr>
            </div>
            <div class="grid gap-1.5">
              <label for="">Learner's Reference Number</label>
              <input type="text" name="lrn" id="lrn" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Profile Picture</label>
              <input type="file" name="profile" id="img_input" value="" class="file:border-none file:bg-white py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Learning Level</label>
              <select name="level_id" id="level_select" class="py-2 px-3 border w-full rounded-lg" required>
                <option value="" id="level_id" selected required>Select Year Level</option>
                <?php $learning_levels = $crud->getAllLearningLevels(); ?>
                <?php foreach ($learning_levels as $level) : ?>
                  <option value="<?php echo $level["level_id"] ?>"><?php echo $level["level_name"] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="grid gap-1.5">
              <label for="">Username</label>
              <input type="text" name="username" id="username" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Password</label>
              <input type="text" name="password" id="password" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Student Name</label>
              <input type="text" name="fullname" id="fullname" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Age</label>
              <input type="number" name="age" id="age" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5 md:col-span-2">
              <label for="">Email</label>
              <input type="email" name="email" id="email" class="py-2 px-3 border w-full rounded-lg" placeholder="student@email.com">
            </div>
            <div class="grid gap-1.5">
              <label for="">Birthdate</label>
              <input type="date" name="birthdate" id="birthdate" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Birthplace</label>
              <input type="text" name="birthplace" id="birthplace" class="py-2 px-3 border w-full rounded-lg" placeholder="student@email.com">
            </div>
            <div class="grid gap-1.5">
              <label for="">Gender</label>
              <select name="gender" class="py-2 px-3 border w-full rounded-lg">
                <option value="" id="gender" hidden selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="grid gap-1.5">
              <label for="">Region</label>
              <input type="text" name="region" id="region" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Division</label>
              <input type="text" name="division" id="division" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="w-full md:col-span-3 my-4 space-y-2">
              <h1 class="text-xl font-medium">
                Family Information
              </h1>
              <hr>
            </div>
            <div class="grid md:grid-cols-3 gap-2 md:col-span-3">
              <div class="grid gap-1.5">
                <label for="">Mother's Name</label>
                <input type="text" name="mother_name" id="mother_name" class="py-2 px-3 border w-full rounded-lg">
              </div>
              <div class="grid gap-1.5">
                <label for="">Birthdate</label>
                <input type="date" name="father_birthdate" id="father_birthdate" class="py-2 px-3 border w-full rounded-lg">
              </div>
              <div class="grid gap-1.5">
                <label for="">Mother's Occupation</label>
                <input type="text" name="mother_occupation" id="mother_occupation" class="py-2 px-3 border w-full rounded-lg">
              </div>
            </div>
            <div class="grid gap-1.5">
              <label for="">Father's Name</label>
              <input type="text" name="father_name" id="father_name" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Father's Birthdate</label>
              <input type="date" name="mother_birthdate" id="mother_birthdate" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Father's Occupation</label>
              <input type="text" name="father_occupation" id="father_occupation" class="py-2 px-3 border w-full rounded-lg">
            </div>
          </div>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
        <button onclick="$('form').submit()" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit Form</button>
        <button onclick="closeModal()" data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  $("#modal").hide();

  function viewItem(user_id) {
    $.get(`./action.php?action=get_user&user_id=${user_id}`, (res) => {
      let data = JSON.parse(res);
      console.log(res);
      Object.keys(data).forEach((value) => {
        let element = $(`#${value}`);
        if (element) {
          if (value == "password") return;

          element.val(data[value]);
          element.text(data[value]);

          if (value == "profile") {
            $("#profile_view").attr("src", data[value])
          }

          if (value == "level_id") {
            element.text(data["level_name"]);
          }
        }
      })
    })
    $("#modal").show();
  }
</script>

<?php include("./footer.php"); ?>