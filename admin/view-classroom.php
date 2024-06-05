<?php include("./header.php"); ?>

<?php $classroom_data = $crud->getClassroom($_GET["class_id"])[0];

extract($classroom_data) ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <a href="./manage-strands.php" class="flex gap-2 items-center text-lg">
      <i data-lucide="arrow-left"></i>
      Back to Manage Strands <?php ?>
    </a>
    <section class="flex flex-col md:flex-row gap-4 justify-between my-8">
      <div>
        <h1 class="text-2xl font-bold">
          <?php echo $classroom ?> Masterlist
        </h1>
      </div>
      <button onclick="showModal()"
        class="py-2.5 px-5 h-fit bg-blue-700 hover:bg-blue-800 rounded-lg text-white max-w-xs w-full">Enroll
        Students</button>
    </section>
    <section class="flex">
      <table id="datatable" class="ui sixteen wide centered column table" width="100%">
        <thead>
          <tr>
            <th>LRN</th>
            <th>Learning Level</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Birthdate</th>
            <th>Gender</th>
          </tr>
        </thead>
        <tbody>
          <?php $users = $crud->getAllClassroomUsers($class_id); ?>
          <?php foreach ($users as $user):
            extract($user) ?>
            <tr onclick="showPrompt(<?php echo $user_id ?>)" class="cursor-pointer">
              <td>
                <?php echo $lrn ?>
              </td>
              <td>
                <?php echo $level_name ?>
              </td>
              <td>
                <?php echo $fullname ?>
              </td>
              <td>
                <?php echo $email ?>
              </td>
              <td>
                <?php echo $birthdate ?>
              </td>
              <td>
                <?php echo $gender ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </section>
  </div>
</main>

<!-- All Students -->
<div id="modal"
  class="overflow-y-hidden bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
  <div class="relative p-4 w-full m-auto flex flex-col justify-center max-w-7xl h-screen">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
        Enroll Students
        </h3>
        <button onclick="closeModal()" type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
          data-modal-hide="default-modal">
          <i data-lucide="x"></i>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5">
        <form action="" class="">
          <input type="text" name="class_id" id="class_id" class="hidden">
          <div class="grid gap-2">
            <table id="students_datatable" class="ui sixteen wide centered column unstackable table nowrap table-fixed"
              width="100%">
              <thead>
                <tr>
                  <th class="flex items-center gap-2">
                    <input type="checkbox" id="checkAll" value="1">
                    <span class="">Enroll All</span>
                  </th>
                  <th>LRN</th>
                  <th>Learning Level</th>
                  <th>Fullname</th>
                  <th>Email</th>
                  <th>Birthdate</th>
                  <th>Gender</th>
                </tr>
              </thead>
              <tbody>
                <?php $users = $crud->getStudentsNotOnClassroom($class_id); ?>
                <?php foreach ($users as $user):
                  extract($user); ?>
                  <tr class="cursor-pointer">
                    <td>
                      <input type="checkbox" value="<?php echo $user_id ?>" id="item-<?php echo $user_id ?>">
                      <span id="item-<?php echo $user_id ?>-text">---</span>
                    </td>
                    <td>
                      <?php echo $lrn ?>
                    </td>
                    <td>
                      <?php echo $level_name ?>
                    </td>
                    <td>
                      <?php echo $fullname ?>
                    </td>
                    <td>
                      <?php echo $email ?>
                    </td>
                    <td>
                      <?php echo $birthdate ?>
                    </td>
                    <td>
                      <?php echo $gender ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
        <button onclick="submitForm(<?php echo $class_id ?>)" data-modal-hide="default-modal" type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit
          Form</button>
        <button onclick="closeModal()" data-modal-hide="default-modal" type="button"
          class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="prompt-modal" tabindex="-1" class="overflow-y-auto overflow-x-hidden bg-black/50 fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-screen">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button onclick="closePrompt()" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                <i data-lucide="x"></i>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <i data-lucide="alert-circle" class="h-16 w-16 my-4 text-red-600 mx-auto"></i>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to remove this student from class?</h3>
                <button onclick="deleteForm(<?php echo $class_id ?>)" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                    Yes, I'm sure
                </button>
                <button onclick="closePrompt()" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
  let selected_id;

  var students = new DataTable('#students_datatable', {
    searching: true
  });

  var students = new DataTable('#masterlist', {
    searching: true
  });

  function filterSelect(input) {
    let value = $(input).val();
    students.search(value).draw();
  }

  let selected_users = [];

  function setSelectedUsers() {
    var arr = [];
    $("input[type=checkbox]").each(function () {
      var self = $(this);
      let self_id = self.attr("id");
      if (self.is(':checked')) {
        arr.push(self.val());
        $(`${self_id}-text`).text("Enrolled");
        selected_users = arr;
        return;
      }
      else if (self.not(":checked")) {
        $(`${self_id}-text`).text("---");
        selected_users = arr;
        return;
      }
    });
  }

  $("input[type=checkbox]").on('change', () => {
    setSelectedUsers()
  });

  let checked = false;
  $('#checkAll').click(function () {
    if (!checked) {
      $('input:checkbox').prop('checked', this.checked);
    } else {
      $('input:checkbox').removeAttr('checked');
      checked = false;
    }
  });

  function submitForm(class_id) {
    console.log(selected_users);
    $.post("./action.php?action=insert_classroom_user", {selected_users, class_id}, (res) => {
      location.reload();
      console.log(res);
    });
  }

  function deleteForm(class_id) {
    console.log({selected_id, class_id});
    $.post("./action.php?action=delete_classroom_user", {user_id: selected_id, class_id}, (res) => {
      location.reload();
    })
  }

  $("#modal").hide();
  $("#prompt-modal").hide();

  function closeModal() {
    $("#modal").hide();
  }

  function showPrompt(user_id) {
    selected_id = user_id;
    $("#prompt-modal").show();
  }

  function closePrompt() {
    $("#prompt-modal").hide();
  }

  function showModal() {
    $("#modal").show();
  }

  $("#show_students_modal").click(() => showModalStudent())

  function viewItem() {
    $("#modal").show();
    // let allFilters = [],
    //   currentFilters = ["Assigned"];
    // allFilters = currentFilters.join('|').replace("&", "\\&").replace(/\s/g, "\\s");
    // table.columns(columnIndex).search(allFilters, true).draw();
  }
</script>

<?php include("./footer.php"); ?>