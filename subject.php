<?php include("./header.php"); ?>

<?php $subject_id = $_GET["subject_id"] ?>
<?php $subject_data = $crud->getSubject($_GET["subject_id"])[0];
extract($subject_data); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <div class="grid gap-4 md:grid-cols-1 place-items-center p-6 md:p-10">
      <div class="flex justify-start w-full max-w-4xl">
        <a href="./classrooms.php" class="flex gap-2 items-center text-lg">
          <i data-lucide="arrow-left"></i>
          Back to Classrooms
        </a>
      </div>
      <section class="md:max-w-4xl w-full mx-auto flex justify-between items-start mb-4">
        <div>
          <h1 class="font-bold text-2xl">
            <?php echo $subject ?>
          </h1>
          <h2>
            <?php echo $year_level ?>
          </h2>
        </div>
        <div>
        </div>
      </section>
      <!-- <section class="md:max-w-4xl w-full mx-auto h-44 rounded-lg border"></section> -->

      <?php $modules = $crud->getAllSubjectModules($subject_id) ?>
      <?php foreach ($modules as $module) :
        extract($module);
        $module_file = json_decode(base64_decode($module_file)); ?>
        <a href="./view-module.php?subject_id=<?php echo $subject_id ?>&module_id=<?php echo $module_id ?>" class="transition-all duration-500 shadow hover:shadow-xl cursor-pointer md:max-w-4xl w-full mx-auto h-fit p-8 flex gap-4 rounded-lg border">
          <div class="p-2 rounded-full flex items-center border bg-blue-100 border-blue-200">
            <i data-lucide="notebook-text" class="w-8 h-8 text-blue-500"></i>
          </div>
          <div class="flex flex-col items-start">
            <h1 class="text-lg font-medium">
              <?php echo $title ?>
            </h1>
            <h2 class="text-sm font-medium">
              Deadline:
              <?php echo $deadline ?>
            </h2>
          </div>
        </a>
      <?php endforeach ?>
    </div>
  </div>
</main>

<?php include("./footer.php"); ?>