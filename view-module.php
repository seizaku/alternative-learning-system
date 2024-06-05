<?php include("./header.php"); ?>

<?php $module_data = $crud->getModuleData($_GET["module_id"])[0];
extract($module_data); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <div class="grid gap-4 md:grid-cols-1 place-items-center p-6 md:p-10">
      <div class="flex justify-start w-full max-w-4xl">
        <a href="./classrooms.php" class="flex gap-2 items-center text-lg">
          <i data-lucide="arrow-left"></i>
          Back to Subject
        </a>
      </div>
      <section class="md:max-w-4xl w-full mx-auto flex justify-between items-start mb-4">
        <div>
          <h1 class="font-bold text-2xl">
            <?php echo $title ?>
          </h1>
          <h2>
            Deadline: <?php echo $deadline ?>
          </h2>
        </div>
        <?php $has_submitted = $crud->getUserSubmittedModule($_GET["module_id"], $_SESSION["user_id"]); ?>
        <?php if (!$has_submitted) : ?>
          <form method="POST" action="./admin/action.php?action=submit_modules" enctype="multipart/form-data">
            <input type="hidden" name="module_id" value="<?php echo $_GET["module_id"] ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
            <input required type="file" multiple name="files[]" accept="image/png" class="border file:border-none file:p-2.5 file:mr-4 file:bg-transparent rounded-lg cursor-pointer file:cursor-pointer">
            <button class="py-2.5 px-5 bg-blue-700 hover:bg-blue-800 text-white rounded-lg">Upload Files</button>
          </form>
        <?php else: ?>
          <p>You have already submitted this module.</p>
        <?php endif; ?>
      </section>
      <h1 class="text-xl font-bold">Module Files</h1>
      <?php $modules = json_decode(base64_decode($module_file)); ?>
      <?php foreach ($modules as $module) : ?>
        <div class="grid max-w-4xl w-full gap-1.5">
          <a href="<?php echo $module->uri ?>" download class="text-xl font-medium">Download <?php echo $module->title ?></a>
          <object data="<?php echo $module->uri ?>" class="w-full md:max-w-4xl h-[720px]">
        </div>
      <?php endforeach ?>
    </div>
  </div>
</main>

<?php include("./footer.php"); ?>