<?php include("./header.php"); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <section class="flex flex-col md:flex-row gap-4 justify-between my-8">
      <h1 class="text-2xl font-bold">Student Grades</h1>
      <select id="filter_table" class="py-2.5 px-5 border">
        <option hidden select>Filter Grading List</option>
        <option value="Graded">Graded Students</option>
        <option value="Ongoing">Ongoing Students</option>
        <option value="">Show All Students</option>
      </select>
    </section>
    <section class="flex">
      <table id="datatable" class="ui sixteen wide centered column table" width="100%">
        <thead>
          <tr>
            <th>Year</th>
            <th>Level</th>
            <th>Fullname</th>
            <?php $strands = $crud->getAllClassrooms(); ?>
            <?php foreach ($strands as $strand) : ?>
              <th>(<?php echo $strand["shortcode"] ?>)</th>
            <?php endforeach; ?>
            <th>Remarks</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $users = $crud->getAllUsers(); ?>
          <?php foreach ($users as $user) : extract($user) ?>
            <tr onclick="viewItem(<?php echo $user_id ?>)" class="cursor-pointer">
              <td><?php echo date('Y', strtotime($date_created)) ?></td>
              <td><?php echo $level_name ?></td>
              <td><?php echo $fullname ?></td>
              <?php foreach ($strands as $strand) : ?>
                <?php $has = false; ?>
                <?php foreach ($crud->getUserGrades($user_id) as $item_grade) : ?>
                  <?php if ($item_grade["class_id"] == $strand["class_id"]) : $has = true; ?>
                    <td class="font-extrabold"><?php echo $item_grade["pcr"] ?></td>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!$has) : ?>
                  <td></td>
                <?php endif; ?>
              <?php endforeach; ?>
              <td><?php echo $remarks ?></td>
              <td class="font-bold text-<?php echo $remarks ? "green" : "yellow" ?>-700"><?php echo $remarks ? "Graded" : "Ongoing" ?></td>
              <td>
                <a class="py-2.5 px-5 text-blue-800 rounded-lg" href="./view-user-grade.php?user_id=<?php echo $user_id ?>">View Grades</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </section>
  </div>
</main>
<div id="modal" class="overflow-y-hidden bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
  <div class="relative p-4 w-full m-auto flex flex-col justify-center max-w-xl h-screen">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Student Remark
        </h3>
        <button onclick="closeModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
          <i data-lucide="x"></i>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5">
        <form action="./action.php?action=insert_student" method="POST" enctype="multipart/form-data">
          <input type="text" name="user_id" id="user_id" class="hidden">
          <div class="grid gap-2">
            <div class="grid gap-1.5">
              <label for="">Remarks</label>
              <input type="text" name="remarks" id="remarks" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Testing Center</label>
              <input type="text" name="testing_center" id="testing_center" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Testing Date</label>
              <input type="date" name="testing_date" id="testing_date" class="py-2 px-3 border w-full rounded-lg">
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