<?php
//use in production
// ini_set('display_errors', 0);

$host = 'localhost';
$database = 'blog';
$port = 5432;
$user = 'postgres';
$password = 'damzymike';
$connection = pg_connect("host=localhost dbname=blog user=postgres password=damzymike");
if (!$connection) {
  echo "<h1 class='text-center text-3xl font-bold mt-20'>
            Server error, pleae try again later
          </h1>";
  exit();
};
?>
<!-- DATABASE CONNECTION  -->
<!-- RETURN ERROR IF DATABASE DOESNT CONNECT  -->