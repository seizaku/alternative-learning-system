<?php include("./header.php"); ?>

<?php 
$user_id = $_GET["user_id"];
$module_id = $_GET["module_id"];
$user = $crud->getUser($user_id);
var_dump($user);
?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <div class="grid gap-4 md:grid-cols-1 place-items-center p-6 md:p-10">
      <div class="flex justify-start w-full max-w-4xl">
        <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="flex gap-2 items-center text-lg">
          <i data-lucide="arrow-left"></i>
          Back to Module
        </a>
      </div>
      <section class="md:max-w-4xl w-full mx-auto flex justify-between items-start mb-4">
        <div>
          <h1 class="font-bold text-2xl">
            Submitted Files
          </h1>
        </div>
        <div>
        </div>
      </section>
      <!-- <section class="md:max-w-4xl w-full mx-auto h-44 rounded-lg border"></section> -->

      <?php $files = $crud->getUserSubmittedModule($module_id, $user_id) ?>
      <?php foreach ($files as $item): extract($item) ?>
        <div class="transition-all duration-500 shadow hover:shadow-xl cursor-pointer md:max-w-4xl w-full mx-auto h-fit p-8 flex gap-4 rounded-lg border">
          <div class="flex flex-col items-start">
            <img src="<?php echo $file ?>" class="h-full w-full">
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</main>

<?php include("./footer.php"); ?>