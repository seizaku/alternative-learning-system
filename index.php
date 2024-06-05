<?php include("./header.php"); ?>
<?php

$current_uri = basename($_SERVER['PHP_SELF']);

$nav_items = array(
  [
    "title" => "Home",
    "href" => "index.php",
    "icon" => "home"
  ],
  [
    "title" => "My Classroom",
    "href" => "classrooms.php",
    "icon" => "book-open"
  ],
  [
    "title" => "My Grades",
    "href" => "grades.php",
    "icon" => "sheet"
  ],
  [
    "title" => "Announcements",
    "href" => "announcements.php",
    "icon" => "megaphone"
  ],
  [
    "title" => "My Profile",
    "href" => "profile.php",
    "icon" => "user"
  ],
);

?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
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

<?php include("./footer.php"); ?>