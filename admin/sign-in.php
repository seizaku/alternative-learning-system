<?php 

session_start();

if (isset($_SESSION["user_id"])) {
  header("location: ../index.php");
  return;
}

if (isset($_SESSION["user_loggedin"])) {
  header("location: ./index.php");
  return;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./assets/tailwind.js"></script>
  <script src="./assets/jquery.js"></script>
  <title>ALS | Sign In Admin</title>
</head>
<body >
  <main class="h-screen flex items-center justify-center">    
    <section class="border max-w-md w-full rounded-lg p-6">
      <img class="h-36 mx-auto mt-6 mb-4" src="./assets/ALS2.png" alt="">
      <form action="./action.php?action=staff_auth" method="POST" class="w-full h-fit space-y-4">
        <div class="grid gap-1.5">
          <label for="">Username</label>
          <input type="text" name="username" class="py-2 px-3 border w-full">
        </div>
        <div class="grid gap-1.5">
          <label for="">Password</label>
          <input type="password" name="password" id="password" class="py-2 px-3 border w-full">
        </div>
        <div class="flex gap-2">
          <input type="checkbox" id="show_password">
          <label for="">Show password</label>
        </div>
        <?php if (isset($_GET["status"]) && $_GET["status"] == "false"): ?>
          <p class="text-red-700">Incorrect username or password!</p>
        <?php endif ?>
        <button class="bg-blue-800 hover:bg-blue-900 rounded-lg text-white py-2.5 px-5 w-full">Sign in</button>
      </form>
    </section>
  </main>
  <script type='text/javascript'>
    $(document).ready(function () {
      $('#show_password').click(function () {
        $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
      });
    });
  </script>
</body>
</html>