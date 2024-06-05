<?php include("./header.php"); ?>

<?php $user = $crud->getUser($_SESSION["user_id"], false);
extract($user) ?>

<main class="p-4 sm:ml-64">
  <div class="p-4 rounded-lg mt-14">
    <form action="./admin/action.php?action=insert_student" method="POST" enctype="multipart/form-data" class="border rounded-lg p-8 space-y-4 w-full md:max-w-5xl mx-auto">
      <input type="text" value="<?php echo $_SESSION["user_id"] ?>" name="user_id" id="user_id" class="hidden">
      <img src="<?php echo $profile ?>" id="profile_view" class="object-cover h-44 w-44 rounded-full mx-auto border">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
        <div class="w-full md:col-span-3 my-4 space-y-2">
          <h1 class="text-xl font-medium">
            Student Information
          </h1>
          <hr>
        </div>
        <div class="grid gap-1.5">
          <label for="">Learner's Reference Number</label>
          <input type="text" name="lrn" id="lrn" value="<?php echo $lrn ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Profile Picture</label>
          <input type="file" name="profile" id="img_input" value="<?php echo $profile ?>" class="file:border-none file:bg-white py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Learning Level</label>
          <input type="hidden" name="level_id" value="<?php echo $level_id ?>" class="py-2 px-3 border w-full rounded-lg">
          <input type="text" disabled value="<?php echo $level_name ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Username</label>
          <input type="text" name="username" id="username" value="<?php echo $username ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Password</label>
          <input type="text" name="password" id="password" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Student Name</label>
          <input type="text" name="fullname" id="fullname" value="<?php echo $fullname ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Age</label>
          <input type="number" name="age" id="age" value="<?php echo $age ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5 md:col-span-2">
          <label for="">Email</label>
          <input type="email" name="email" id="email" value="<?php echo $email ?>" class="py-2 px-3 border w-full rounded-lg" placeholder="student@email.com">
        </div>
        <div class="grid gap-1.5">
          <label for="">Birthdate</label>
          <input type="date" name="birthdate" id="birthdate" value="<?php echo $birthdate ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Birthplace</label>
          <input type="text" name="birthplace" id="birthplace" value="<?php echo $birthplace ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Gender</label>
          <select name="gender" class="py-2 px-3 border w-full rounded-lg">
            <option value="<?php echo $gender ?>" id="gender" hidden selected><?php echo $gender ?></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="w-full md:col-span-3 my-4 space-y-2">
          <h1 class="text-xl font-medium">
            Family Information
          </h1>
          <hr>
        </div>
        <div class="grid gap-1.5">
          <label for="">Mother's Name</label>
          <input type="text" name="mother_name" id="mother_name" value="<?php echo $mother_name ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Mother's Birthdate</label>
          <input type="date" name="father_birthdate" id="father_birthdate" value="<?php echo $father_birthdate ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Mother's Occupation</label>
          <input type="text" name="mother_occupation" id="mother_occupation" value="<?php echo $mother_occupation ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Father's Name</label>
          <input type="text" name="father_name" id="father_name" value="<?php echo $father_name ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Mother's Birthdate</label>
          <input type="date" name="mother_birthdate" id="mother_birthdate" value="<?php echo $birthdate ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
        <div class="grid gap-1.5">
          <label for="">Father's Occupation</label>
          <input type="text" name="father_occupation" id="father_occupation" value="<?php echo $father_occupation ?>" class="py-2 px-3 border w-full rounded-lg">
        </div>
      </div>
      <div class="flex justify-center">
        <button class="py-2.5 px-5 w-44 bg-blue-700 hover:bg-blue-800 rounded-lg text-white">Save Changes</button>
      </div>
    </form>
  </div>
</main>

<?php include("./footer.php"); ?>