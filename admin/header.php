<?php
include_once(__DIR__ . "/action.php");

if (isset($_SESSION["user_id"])) {
  header("location: ../index.php");
  return;
}
if (!isset($_SESSION["user_loggedin"])) {
  header("location: ./sign-in.php");
}

extract($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <!-- Fomantic UI CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">

  <!-- DataTables Core CSS with Semantic UI Theme -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.semanticui.min.css">

  <!-- DataTables Buttons CSS with Semantic UI Theme -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.semanticui.min.css">


  <!-- jQuery -->
  <script src="./assets/jquery.js"></script>

  <!-- Fomantic UI -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>

  <!-- DataTables Core -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <!-- DataTables Semantic UI Theme -->
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.semanticui.min.js"></script>

  <!-- DataTables Buttons -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

  <!-- DataTables Semantic UI Buttons Theme -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.semanticui.min.js"></script>

  <!-- JSZip -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

  <!-- PDFMake -->
  <script src="./assets/pdfmake-0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

  <!-- DataTables HTML5 Buttons -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

  <!-- DataTables Print Button -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

  <!-- DataTables Column Visibility Button -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
  
  <script src="./assets/html2pdf.bundle.min.js"></script>

  <style>
    [x-cloak] {
      display: none;
    }

    .scrollable-content {
      height: 150px;
    }

    .scrollable-content::-webkit-scrollbar {
      display: none;
    }
  </style>

  <script src="./assets/lucide.js"></script>
  <script src="./assets/tailwind.js"></script>

  <title>Alternative Learning System for Barangay Sinunuc</title>
</head>

<body class="font-normal text-gray-800">
  <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <button id="open_sidebar" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
            type="button"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <i data-lucide="align-left"></i>
          </button>
          <a href="/" class="flex ms-2 md:me-24">
            <img src="./assets/ALS2.png" class="w-8 me-3" alt="FlowBite Logo" />
            <span
              class="self-center hidden md:flex text-sm font-semibold sm:text-lg whitespace-nowrap">ALS Student Monitoring System</span>
          </a>
        </div>
        <button onclick="signOut()" class="py-2.5 px-5 rounded-lg hover:bg-gray-100 hover:text-blue-400">
          Sign Out
        </button>
      </div>
    </div>
  </nav>

  <?php include_once(__DIR__ . "/inc/sidebar.php") ?>