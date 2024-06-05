<?php include("./header.php"); ?>
<?php

$current_uri = basename($_SERVER['PHP_SELF']);

$nav_items = array(
  [
    "title" => "Manage Students",
    "href" => "manage-students.php",
    "icon" => "graduation-cap"
  ],
  [
    "title" => "Learning Strands",
    "href" => "manage-strands.php",
    "icon" => "book-open"
  ],
  [
    "title" => "Announcements",
    "href" => "announcements.php",
    "icon" => "megaphone"
  ],
);

?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <h1 class="mt-6 text-3xl font-bold my-2">Overview</h1>
    <section class="grid md:grid-cols-3 gap-4">
      <a href="./manage-students.php" class="flex h-44 w-86 flex-col items-center justify-center rounded-md border border-dashed border-gray-200 transition-colors duration-100 ease-in-out hover:border-gray-400/80">
        <div class="flex flex-row items-center justify-center">
          <i data-lucide="graduation-cap" class="mr-3 h-12 w-12 fill-blue-500/95"></i>
          <span class="font-bold text-4xl text-gray-600"><?php echo sizeof($crud->getAllUsers()) ?></span>
        </div>
        <div class="mt-2 text-2xl text-gray-400">Total Students</div>
      </a>
      <a href="./manage-classroom.php" class="flex h-44 w-86 flex-col items-center justify-center rounded-md border border-dashed border-gray-200 transition-colors duration-100 ease-in-out hover:border-gray-400/80">
        <div class="flex flex-row items-center justify-center">
          <i data-lucide="school" class="mr-3 h-12 w-12 fill-blue-500/95"></i>
          <span class="font-bold text-4xl text-gray-600"><?php echo sizeof($crud->getAllClassrooms()) ?></span>
        </div>
        <div class="mt-2 text-2xl text-gray-400">Total Learning Strands</div>
      </a>
      <a href="./learning-levels.php" class="flex h-44 w-86 flex-col items-center justify-center rounded-md border border-dashed border-gray-200 transition-colors duration-100 ease-in-out hover:border-gray-400/80">
        <div class="flex flex-row items-center justify-center">
          <i data-lucide="book-a" class="mr-3 h-12 w-12 fill-blue-500/95"></i>
          <span class="font-bold text-4xl text-gray-600"><?php echo sizeof($crud->getAllLearningLevels()) ?></span>
        </div>
        <div class="mt-2 text-2xl text-gray-400">Total Learning Levels</div>
      </a>
      <a class="flex h-64 w-86 p-8 flex-col items-center justify-center rounded-md border border-dashed border-gray-200 transition-colors duration-100 ease-in-out hover:border-gray-400/80">
        <div class="flex flex-row items-center justify-center h-full w-full">
          <canvas id="donut-chart" class="h-full w-full"></canvas>
        </div>
        <div class="mt-2 text-2xl text-gray-400">Graded Students</div>
      </a>
      <a class="flex h-64 w-86 p-8 flex-col items-center justify-center rounded-md border border-dashed border-gray-200 transition-colors duration-100 ease-in-out hover:border-gray-400/80">
        <div class="flex flex-row items-center justify-center h-full w-full">
          <canvas id="donut-chart-2" class="h-full w-full"></canvas>
        </div>
        <div class="mt-2 text-2xl text-gray-400">On-going Students</div>
      </a>
    </section>
    <hr class="my-8">
    <section class="grid md:grid-cols-3 gap-4">
      <?php foreach ($nav_items as $nav_item) : extract($nav_item); ?>
        <a href="<?php echo $href ?>" class="flex h-44 w-86 flex-col items-center justify-center rounded-md border border-dashed border-blue-200 transition-colors duration-100 ease-in-out bg-blue-200/10 hover:bg-blue-300/10 hover:border-blue-400/80">
          <div class="flex flex-row items-center justify-center">
            <i data-lucide="<?php echo $icon ?>" class="mr-3 h-12 w-12 fill-gray-500/95"></i>
          </div>
          <div class="mt-2 text-2xl text-gray-400"><?php echo $title ?></div>
        </a>
      <?php endforeach; ?>
    </section>
  </div>
</main>

<?php $JSONData = json_encode($crud->getStudentPieChart()); ?>
<?php $JSONData2 = json_encode($crud->getStudentPieChart2()); ?>

<script>
  var chartData = <?php echo $JSONData; ?>;
  console.log(chartData);
  var canvas = document.getElementById('donut-chart');

  // Set the chart data
  var data = {
    labels: chartData.map(data => data[0]),
    datasets: [{
      label: 'Students',
      data: chartData.map(data => data[1]),
      backgroundColor: [
        '#EF4444',
        '#3B82F6',
        '#FBBF24',
        '#10B981',
        '#A78BFA',
        '#F59E0B'
      ],
      hoverOffset: 4
    }]
  };

  // Set the chart options
  var options = {
    plugins: {
      legend: {
        display: false
      }
    },
    aspectRatio: 1,
    cutout: '50%',
    animation: {
      animateRotate: false
    }
  };

  // Create the chart
  var chart = new Chart(canvas, {
    type: 'doughnut',
    data: data,
    options: options
  });

  ////////

  var chartData2 = <?php echo $JSONData; ?>;
  console.log(chartData);
  var canvas2 = document.getElementById('donut-chart-2');

  // Set the chart data
  var data2 = {
    labels: chartData2.map(data => data[0]),
    datasets: [{
      label: 'Students',
      data: chartData2.map(data => data[1]),
      backgroundColor: [
        '#EF4444',
        '#3B82F6',
        '#FBBF24',
        '#10B981',
        '#A78BFA',
        '#F59E0B'
      ],
      hoverOffset: 4
    }]
  };

  // Set the chart options
  var options2 = {
    plugins: {
      legend: {
        display: false
      }
    },
    aspectRatio: 1,
    cutout: '50%',
    animation: {
      animateRotate: false
    }
  };

  // Create the chart
  var chart2 = new Chart(canvas2, {
    type: 'doughnut',
    data: data2,
    options: options2
  });
</script>

<?php include("./footer.php"); ?>