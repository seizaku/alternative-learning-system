<?php include("./header.php"); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <section class="flex flex-col md:flex-row gap-4 justify-between my-8">
      <h1 class="text-2xl font-bold">Manage Learning Strands</h1>
      <button onclick="showModal()"
        class="py-2.5 px-5 bg-blue-700 hover:bg-blue-800 rounded-lg text-white max-w-xs w-full">New Strand</button>
    </section>
    <section class="flex">
      <table id="datatable" class="ui sixteen wide centered column table" width="100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Strand</th>
            <th>Student Count</th>
            <th>Date Created</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $classrooms = $crud->getAllClassrooms(); ?>
          <?php foreach ($classrooms as $class):
            extract($class) ?>
            <tr onclick="viewItem(<?php echo $class_id ?>)" class="cursor-pointer">
              <td>
                <?php echo $class_id ?>
              </td>
              <td>
                <?php echo $classroom ?>
              </td>
              <td>
                <?php echo sizeof($crud->getAllClassroomUsers($class_id)) ?>
              </td>
              <td>
                <?php echo $date_created ?>
              </td>
              <td>
                <a class="py-2.5 px-5 text-blue-800 rounded-lg" href="./view-classroom.php?class_id=<?php echo $class_id ?>">Students</a>
              </td>
              <td>
                <a class="py-2.5 px-5 text-blue-800 rounded-lg" href="./class-modules.php?class_id=<?php echo $class_id ?>">Modules</a>
              </td>
              <td>
                <a class="py-2.5 px-5 text-blue-800 rounded-lg" href="./class-grades.php?class_id=<?php echo $class_id ?>">Grades</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </section>
  </div>
</main>

<!-- Masterlist -->
<div id="modal"
  class="overflow-y-hidden bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
  <div class="relative p-4 w-full m-auto flex flex-col justify-center max-w-xl h-screen">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Learning Strand Form
        </h3>
        <button onclick="closeModal()" type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
          data-modal-hide="default-modal">
          <i data-lucide="x"></i>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5 space-y-4">
        <form action="./action.php?action=insert_classroom" method="POST">
          <input type="text" name="class_id" id="class_id" class="hidden">
          <div class="grid grid-cols-1 gap-2">
            <div class="grid gap-1.5">
              <label for="">Learning Strand Name</label>
              <input type="text" name="classroom" id="classroom" class="py-2 px-3 border w-full rounded-lg">
              <label for="">Short Code</label>
              <input type="text" name="shortcode" id="shortcode" placeholder="Ex. CS" class="py-2 px-3 border w-full rounded-lg">
            </div>
          </div>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
        <button onclick="submitForm()" data-modal-hide="default-modal" type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit
          Form</button>
        <button onclick="closeModal()" data-modal-hide="default-modal" type="button"
          class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  var students = new DataTable('#students_datatable', {
    searching: true
  });

  function submitForm() {
    $("form").submit()
  }

  $("#modal").hide();
  $("#modal-students").hide();

  $("#show_students_modal").click(() => showModalStudent())

  function viewItem(class_id) {
    $.get(`./action.php?action=get_classroom&class_id=${class_id}`, (res) => {
      let data = JSON.parse(res)[0];
      Object.keys(data).forEach((value) => {
        let element = $(`#${value}`);
        element.val(data[value]);
        element.text(data[value]);
      })
    })
    $("#modal").show();
  }

</script>

<?php include("./footer.php"); ?>