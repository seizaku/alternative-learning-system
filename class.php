<?php include("./header.php"); ?>

<?php $classroom = $crud->getClassroom($_GET["class_id"]); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <?php $subjects = $crud->getUserModules($_GET["class_id"], $_SESSION["user_id"]) ?>
    <div class="flex justify-start w-full max-w-4xl my-4">
      <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="flex gap-2 items-center text-lg">
        <i data-lucide="arrow-left"></i>
        Back to Classes
      </a>
    </div>
    <h1 class="text-2xl font-bold">Class Modules</h1>
    <div class="grid gap-8 md:grid-cols-2 lg:gap-12 p-6 md:p-10">
      <?php foreach($subjects as $item): extract($item); ?>
      <a href="./view-module.php?module_id=<?php echo $module_id ?>" class="flex flex-col p-6 space-y-6 transition-all duration-500 bg-white border border-indigo-100 rounded-lg shadow hover:shadow-xl lg:p-8 lg:flex-row lg:space-y-0 lg:space-x-6">
        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 border border-blue-200 rounded-full shadow-inner lg:h-20 lg:w-20">
          <i data-lucide="book-open-text" class="w-10 h-10 text-blue-500"></i>
        </div>
        <div class="flex-1">
          <h5 class="mb-3 text-xl font-bold lg:text-2xl"><?php echo $title ?></h5>
          <h4 class="mb-3 text-sm font-bold lg:text-lg"><?php echo $deadline ?></h4>
          <p class="mb-6 text-lg text-gray-600"><?php echo $description ?></p>
        </div>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</main>

<?php include("./footer.php"); ?>