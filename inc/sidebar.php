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

<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
    <ul class="space-y-2 font-medium">
    <?php foreach( $nav_items as $nav_item ): extract($nav_item); ?>
      <li>
        <a href="<?php echo $href ?>"
          class="flex items-center p-2 text-gray-900 rounded-lg <?php echo $current_uri == $href ? "bg-gray-100" : "hover:bg-gray-100 group" ?>">
          <i data-lucide="<?php echo $icon ?>" class="w-5 h-5 text-gray-500 transition duration-75 <?php echo $current_uri == $href ? "text-gray-900" : "group-hover:text-gray-900" ?>"></i>
          <span class="ms-3"><?php echo $title ?></span>
        </a>
      </li>
    <?php endforeach; ?>
      <!-- <li>
        <a href="#"
          class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
            <path
              d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
          <span
            class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span>
        </a>
      </li>
      <li>
        <a href="#"
          class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
          <span
            class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span>
        </a>
      </li> -->
    </ul>
  </div>
</aside>