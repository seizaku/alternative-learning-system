<?php include("./header.php"); ?>

<?php $class_id = $_GET["class_id"] ?>
<?php $class_data = $crud->getClassroom($_GET["class_id"])[0];
extract($class_data); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <div class="grid gap-4 md:grid-cols-1 place-items-center p-6 md:p-10">
      <div class="flex justify-start w-full max-w-6xl">
        <a href="./manage-strands.php" class="flex gap-2 items-center text-lg">
          <i data-lucide="arrow-left"></i>
          Back to Learning Strand
        </a>
      </div>
      <section class="md:max-w-6xl w-full mx-auto flex justify-between items-start mb-4">
        <div>
          <h1 class="font-bold text-2xl">
            <?php echo $classroom ?>
          </h1>
        </div>
      </section>
      <section class="max-w-6xl w-fu">
        <table id="datatable" class="ui sixteen wide centered column table table-fixed" width="100%">
          <thead>
            <tr>
              <th>Learning Level</th>
              <th>Name</th>
              <th>Standard Score</th>
              <th>Percentage of Correct Response</th>
            </tr>
          </thead>
          <tbody>
            <?php $masterlist = $crud->getAllUserGrades($class_id); ?>
            <?php foreach ($masterlist as $item) : extract($item); ?>
              <tr onclick="viewItem(<?php echo $grade_id ?>)" class="cursor-pointer">
                <td><?php echo $level_name ?></td>
                <td><?php echo $fullname ?></td>
                <td><?php echo $ss ?></td>
                <td><?php echo $pcr ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </section>
    </div>
  </div>
</main>

<div id="modal" class="overflow-y-hidden bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
  <div class="relative p-4 w-full m-auto flex flex-col justify-center max-w-md h-screen">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Grades Form
        </h3>
        <button onclick="closeModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
          <i data-lucide="x"></i>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5">
        <form action="./action.php?action=insert_grade" method="POST" enctype="multipart/form-data" class="space-y-4">
          <input type="text" value="" name="grade_id" id="grade_id" class="hidden">
          <div class="grid grid-cols-1 gap-2">
            <div class="grid gap-1.5">
              <label for="">Standard Score</label>
              <input type="number" name="ss" id="ss" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Percentage of Correct Response</label>
              <input type="number" name="pcr" id="pcr" class="py-2 px-3 border w-full rounded-lg">
            </div>
          </div>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="flex items-center gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
        <button onclick="$('form').submit()" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit
          Form</button>
        <button onclick="closeModal()" data-modal-hide="default-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  $("#modal").hide();

  function closeModal() {
    $("#modal").hide();
    $('form')[0].reset();
  }

  function showModal() {
    $("#modal").show();
    $('form')[0].reset();
  }

  function viewItem() {
    showModal();

  }

  function generateMasterlist(subject_id, year_level, class_id) {
    console.log(subject_id, year_level);
    $.post("./action.php?action=grading_masterlist", {
      subject_id,
      year_level,
      class_id
    }, (res) => {
      console.log(res);
    });
  }

  function viewItem(grade_id) {
    $.get(`./action.php?action=get_user_grade&grade_id=${grade_id}`, (res) => {
      let data = JSON.parse(res)[0];
      console.log(data);
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