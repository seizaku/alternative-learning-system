<?php include("./header.php"); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <?php $classrooms = $crud->getUserClassrooms($_SESSION["user_id"]) ?>

    <h1 class="text-2xl font-bold">My Classes</h1>
    <div class="grid gap-8 md:grid-cols-2 lg:gap-12 p-6 md:p-10">
      <?php foreach ($classrooms as $class) : extract($class); ?>
        <a href="./class.php?class_id=<?php echo $class_id ?>" class="flex flex-col p-6 space-y-6 transition-all duration-500 bg-white border border-indigo-100 rounded-lg shadow hover:shadow-xl lg:p-8 lg:flex-row lg:space-y-0 lg:space-x-6">
          <div class="flex items-center justify-center w-16 h-16 bg-blue-100 border border-blue-200 rounded-full shadow-inner lg:h-20 lg:w-20">
            <i data-lucide="library-big" class="w-10 h-10 text-blue-500"></i>
          </div>
          <div class="flex-1">
            <h5 class="mb-3 text-xl font-bold lg:text-2xl"><?php echo $classroom ?> Classroom</h5>
            <span class="flex items-baseline text-lg font-bold text-indigo-600">
              Open Classroom
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
              </svg>
            </span>
          </div>
        </a>
      <?php endforeach ?>
    </div>
  </div>
</main>

<?php include("./footer.php"); ?>