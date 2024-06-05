<?php include("./header.php"); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <div class="grid gap-4 md:grid-cols-1 place-items-center p-6 md:p-10">
      <div class="flex justify-start w-full max-w-4xl">
        <a href="./index.php" class="flex gap-2 items-center text-lg">
          <i data-lucide="arrow-left"></i>
          Back to Home
        </a>
      </div>
      <section class="md:max-w-4xl w-full mx-auto flex justify-between items-start mb-4">
        <div>
          <h1 class="font-bold text-2xl">
            Announcements
          </h1>
          <h2>
            <?php echo $fullname ?>
          </h2>
        </div>
        <div>
        </div>
      </section>
      <!-- <section class="md:max-w-4xl w-full mx-auto h-44 rounded-lg border"></section> -->

      <?php $announcements = $crud->getAllAnnouncements() ?>
      <?php foreach ($announcements as $announcement): extract($announcement) ?>
        <a class="transition-all duration-500 shadow hover:shadow-xl cursor-pointer md:max-w-4xl w-full mx-auto h-fit p-8 flex gap-4 rounded-lg border">
          <div class="p-2 rounded-full flex items-center border bg-blue-100 border-blue-200">
            <i data-lucide="megaphone" class="w-12 h-full text-blue-500"></i>
          </div>
          <div class="flex flex-col items-start">
            <h1 class="text-lg font-medium">
              <?php echo $title ?>
            </h1>
            <h2 class="text-sm">
              Date Posted: <?php echo $date_created ?>
            </h2>
            <p class="text-sm font-medium">
              <?php echo $description ?>
            </p>
          </div>
        </a>
      <?php endforeach ?>
    </div>
  </div>
</main>

<?php include("./footer.php"); ?>