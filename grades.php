<?php include("./header.php"); ?>

<?php $subject_id = $_GET["subject_id"] ?>
<?php $user = $crud->getUser($_SESSION["user_id"], false); ?>
<?php $user_classrooms = $crud->getUserClassrooms($_SESSION["user_id"]);
extract($user_classrooms); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <div class="grid gap-4 md:grid-cols-1 place-items-center p-6 md:p-10">
      <section class="md:max-w-6xl w-full mx-auto flex justify-between items-start mb-4">
        <div class="w-full text-center">
          <h2 class="text-center font-bold text-lg">Alternative Learning System's Accreditation and Equivalency (A & E) Test</h2>
          <h1 class="font-bold text-3xl">
            Certificate of Rating
          </h1>
        </div>
      </section>
      <section class="max-w-6xl w-full">
        <table class="ui sixteen wide centered column celled table table-fixed" width="100%">
          <thead>
            <tr>
              <th>Region: <?php echo $user["region"] ?></th>
              <th>Testing Date: <br> <?php echo date('F y, d', strtotime($user["testing_date"])) ?></th>
              <th>Testing Center: <br> <?php echo $user["testing_center"] ?></th>
              <th>Examinee No. <?php echo $user_id ?> </th>
              <th>Examinee: <br> <?php echo $fullname ?></th>
            </tr>
          </thead>
        </table>
        <table class="ui sixteen wide centered column celled table table-fixed" width="100%">
          <thead>
            <tr>
              <th>Learning Strand</th>
              <th>Standard Scoring</th>
              <th>Percentage of Correct Response</th>
            </tr>
          </thead>
          <tbody>
            <?php $user_grades = $crud->getUserGrades($_SESSION["user_id"]); ?>
            <?php foreach ($user_grades as $class_item) : extract($class_item) ?>
              <tr class="cursor-pointer">
                <td><?php echo $classroom." <b>($shortcode)</b>" ?></td>
                <td style="text-align: center;"><?php echo $ss ?></td>
                <td style="text-align: center;"><?php echo $pcr ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td>** REMARKS **</td>
              <td colspan="2"><?php echo $user["remarks"] ?></td>
            </tr>
          </tfoot>
        </table>
      </section>
      <section class="max-w-6xl w-full">
        <canvas id="myChart"></canvas>
      </section>
    </div>
  </div>
</main>

<div id="modal" class="overflow-y-hidden bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
  <div class="relative p-4 w-full m-auto flex flex-col justify-center max-w-2xl h-screen">
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
      <div class="p-4 md:p-5 space-y-4">
        <form action="./action.php?action=insert_grade" method="POST" enctype="multipart/form-data" class="space-y-4">
          <input type="text" value="" name="grade_id" id="grade_id" class="hidden">
          <div class="grid grid-cols-1 gap-2">
            <div class="grid gap-1.5">
              <label for="">1st Grading</label>
              <input type="text" name="first_grading" id="first_grading" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">2nd Grading</label>
              <input type="text" name="second_grading" id="second_grading" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">3rd Grading</label>
              <input type="text" name="third_grading" id="third_grading" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">4th Grading</label>
              <input type="text" name="fourth_grading" id="fourth_grading" class="py-2 px-3 border w-full rounded-lg">
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

  var allStrands = <?php echo json_encode($user_grades); ?>

  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: allStrands.map((value) => value.shortcode),
      datasets: [{
        label: 'PCR',
        data: allStrands.map((value) => value.pcr),
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

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