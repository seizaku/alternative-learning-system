<?php include("./header.php"); ?>

<?php $class_id = $_GET["class_id"] ?>
<?php $class_data = $crud->getClassroom($class_id)[0];
extract($class_data); ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <div class="grid gap-4 md:grid-cols-1 place-items-center p-6 md:p-10">
      <div class="flex justify-start w-full max-w-4xl">
        <a href="./manage-strands.php" class="flex gap-2 items-center text-lg">
          <i data-lucide="arrow-left"></i>
          Back to Classroom
        </a>
      </div>
      <section class="md:max-w-4xl w-full mx-auto flex justify-between items-start mb-4">
        <div>
          <h1 class="font-bold text-2xl">
            <?php echo $classroom ?>
          </h1>
        </div>
        <div>
          <button onclick="showModal()" class="py-2.5 px-5 bg-blue-700 hover:bg-blue-800 rounded-lg text-white max-w-xs w-full">New
            Module</button>
        </div>
      </section>
      <!-- <section class="md:max-w-4xl w-full mx-auto h-44 rounded-lg border"></section> -->

      <?php $modules = $crud->getAllClassModules($class_id) ?>
      <?php foreach ($modules as $module) :
        extract($module);
        $module_file = json_decode(base64_decode($module_file)); ?>
        <a href="./view-module.php?class_id=<?php echo $class_id ?>&module_id=<?php echo $module_id ?>" class="transition-all duration-500 shadow hover:shadow-xl cursor-pointer md:max-w-4xl w-full mx-auto h-fit p-8 flex gap-4 rounded-lg border">
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

<div id="modal" class="overflow-y-hidden bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen">
  <div class="relative p-4 w-full m-auto flex flex-col justify-center max-w-2xl h-screen">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Module Form
        </h3>
        <button onclick="closeModal()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
          <i data-lucide="x"></i>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5 space-y-4">
        <form action="./action.php?action=insert_module" method="POST" enctype="multipart/form-data" class="space-y-4">
          <input type="text" value="<?php echo $class_id ?>" name="class_id" id="class_id" class="hidden">
          <div class="grid grid-cols-1 gap-2">
            <div class="grid gap-1.5">
              <label for="">Title</label>
              <input type="text" name="title" id="title" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Description</label>
              <textarea name="description" id="description" cols="30" rows="5" class="py-2 px-3 border w-full rounded-lg"></textarea>
            </div>
            <div class="grid gap-1.5">
              <label for="">Deadline</label>
              <input type="datetime-local" name="deadline" class="py-2 px-3 border w-full rounded-lg">
            </div>
            <div class="grid gap-1.5">
              <label for="">Module File PDF</label>
              <input type="file" name="module_file" id="img_input" accept="application/pdf" class="file:border-none file:bg-white py-2 px-3 border w-full rounded-lg">
            </div>
          </div>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="flex items-center gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
        <button onclick="$('form').submit()" data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit
          Form</button>
        <button onclick="$('form').submit()" data-modal-hide="default-modal" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete
          Item</button>
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

  function viewItem(announcement_id) {
    $.get(`./action.php?action=get_announcement&announcement_id=${announcement_id}`, (res) => {
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