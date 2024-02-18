<?php

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <!-- Content -->
  <h1 class="font-bold text-2xl mb-4">Sign up to Michael's blog</h1>
  <form action="signup.php" class="flex flex-col gap-3">
    <input type="email" placeholder="Enter your email" class="border outline-none p-3 rounded-md" required>
    <input type="text" placeholder="Enter your fullname" class="border outline-none p-3 rounded-md" required>
    <input type="password" placeholder="Enter your password" class="border outline-none p-3 rounded-md" required>
    <input type="password" placeholder="Repeat password" class="border outline-none p-3 rounded-md" required>
    <input type="submit" class="border bg-blue-700 self-center p-2 rounded-lg text-white" />
  </form>

  <?php include('templates/footer.php') ?>
  <script>
    console.log('working')
    //To show and hide passsword
  </script>
</body>

</html>