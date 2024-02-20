<?php
include('config/db_connect.php');
include('config/init.php');
// include('config/cipher.php');

$email_signup = '';
$error = false;
$errors = array('email' => '');

if (isset($_GET['email'])) {
  $email_signup = pg_escape_string($_GET['email']);
}

if (isset($_POST['submit'])) {
  $email_signup = '';

  $email = pg_escape_string($connection, trim($_POST['email']));
  $password = trim($_POST['password']);

  // Check email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email must be a valid email address';
  }

  if (!array_filter($errors)) {
    $error = false;
    // $query = "SELECT (email, fullname, passkey) FROM users WHERE email = $email";
    $query = "SELECT * FROM users WHERE email = $1";
    $result = pg_query_params($connection, $query, array($email));
    if ($result) {
      $user = pg_fetch_array($result);
      if (password_verify($password, $user['passkey'])) {
        //Save User to session
        print_r($user);
        $_SESSION['user'] = $user;
        header('Location: index.php');
      } else {
        //Show error
        $error = true;
      }
    } else {
      $error = true;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <!-- Content -->
  <?php echo $email_signup ?
    "<h3 class='notify bg-green-200 w-max p-2 text-green-700 rounded-lg'>Sign up successful, sign up to continue</h3>"
    : ''
  ?>

  <h1 class="font-bold text-2xl mb-4">Login to your account</h1>
  <form action="login.php" class="flex flex-col gap-3" method="POST">
    <input type="email" name="email" placeholder="Enter your email" class="border outline-none p-3 rounded-md" required value="<?php echo $email_signup ?>">
    <p class="text-red-600"><?php echo $errors['email'] ?></p>
    <input type="password" name="password" placeholder="Enter your password" required class="border outline-none p-3 rounded-md">
    <?php echo $error ? "<p class='error-notify text-red-500 font-medium text-center'>Invalid username or password, try again</p>" : '' ?>
    <input type="submit" name="submit" class="border bg-blue-700 self-center p-2 rounded-lg text-white" />
  </form>

  <?php include('templates/footer.php') ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      function hideElement(element, time = 4000) {
        setTimeout(() => element.style.visibility = 'hidden', time)
      }
      const notification = document.querySelector('.notify')
      notification && hideElement(notification)

      const errorNotify = document.querySelector('.error-notify')
      errorNotify && hideElement(errorNotify)

    })
  </script>
</body>

</html>