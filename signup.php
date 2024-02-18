<?php
include('config/db_connect.php');
$email = $fullname = $password_1 =  $password_2 = '';
$errors = array('email' => '', 'fullname' => '', 'password_1' => '', 'password_2' => '');

if (isset($_POST['submit'])) {

  //Trim for spaces
  $email = trim($_POST['email']);
  $fullname = trim($_POST['fullname']);
  $password_1 = trim($_POST['password_1']);
  $password_2 = trim($_POST['password_2']);

  //Check errors
  //Check email
  if (empty($email)) {
    $errors['email'] = 'An email is required';
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Email must be a valid email address';
    }
  }

  //Check fullname
  if (empty($fullname)) {
    $errors['fullname'] = 'Your fullname is required';
  } else {
    if (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
      $errors['title'] = 'Title must be letters and spaces only';
    }
  }

  //Check password
  if (empty($password_1) && empty($password_2)) {
    $errors['password_1'] = 'No password input';
    $errors['password_2'] = 'Please re-enter password';
  } elseif ($password_1 !== $password_2) {
    $errors['password_1'] = $errors['password_2'] = 'Passwords do not match';
  }

  if (!array_filter($errors)) {
    $fullname_array = array_map('ucfirst', explode(' ', $fullname));
    $capitalized_name = join(' ', $fullname_array);

    $email = pg_escape_string($connection, $email);
    $fullname = pg_escape_string($connection, $fullname);
    $passsword = pg_escape_string($connection, $password_2);
    $hash = password_hash($passsword, PASSWORD_DEFAULT);

    $query = "INSERT INTO users(email, fullname, passkey) VALUES('$email', '$fullname', '$hash')";
    if (pg_query($connection, $query)) {
      header('Location: login.php');
    } else {
      echo 'Error occured while signing in';
    }
  };
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <!-- Content -->
  <h1 class="font-bold text-2xl mb-4">Sign up to Michael's blog</h1>
  <form action="signup.php" class="flex flex-col gap-3" method="POST">
    <input type="email" name="email" placeholder="Enter your email" class="border outline-none p-3 rounded-md" value="<?php echo $email ?>">
    <p class="text-red-600"><?php echo $errors['email'] ?></p>
    <input type="text" name="fullname" placeholder="Enter your fullname" class="border outline-none p-3 rounded-md" value="<?php echo $fullname ?>">
    <p class="text-red-600"><?php echo $errors['fullname'] ?></p>
    <input type="password" name="password_1" placeholder="Enter your password" class="border outline-none p-3 rounded-md" value="<?php echo $password_1 ?>">
    <p class="text-red-600"><?php echo $errors['password_1'] ?></p>
    <input type="password" name="password_2" placeholder="Repeat password" class="border outline-none p-3 rounded-md" value="<?php echo $password_2 ?>">
    <p class="text-red-600"><?php echo $errors['password_2'] ?></p>
    <input type="submit" name="submit" class="border bg-blue-700 self-center p-2 rounded-lg text-white" />
    <p class="text-red-600"><?php echo $errors['password_2'] ?></p>

  </form>

  <?php include('templates/footer.php') ?>
  <script>
    // console.log('working')
    //To show and hide passsword
  </script>
</body>

</html>