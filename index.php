<?php
$host = 'localhost';
$database = 'blog';
$port = 5432;
$user = 'postgres';
$password = 'damzymike';

$db_handle = pg_connect("host=localhost dbname=blog user=postgres password=damzymike");

if ($db_handle) {
  echo 'connection success';
} else {
  echo "<h1 class='text-center'>Server ERROR</h1>";
  exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <h1 class="text-center text-3xl font-bold">The best blog in the world</h1>
  <?php include('templates/footer.php') ?>
</body>

</html>