<?php
include('config/db_connect.php');
include('config/init.php');

if ($_SERVER['QUERY_STRING'] === 'signout') {
  unset($_SESSION['user']);
  setcookie('PHPSESSID', '', time() - 3600, '/');
  header('Location: index.php');
}

//Change query to return some documents 
//and also include author, likes and comments
// $query = 'SELECT * FROM blogs ORDER BY created_at';
$query = 'SELECT * FROM blogs';

$result = pg_query($connection, $query);
$blogs = pg_fetch_all($result, PGSQL_ASSOC);

pg_free_result($result);
pg_close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <h2 class="text-xl text-green-400 mb-4"><?php echo $logged_in_user !== 'None' ? "Welcome " . $logged_in_user['fullname'] : 'Welcome Guest' ?></h2>
  <!-- Show when there are no blogs  -->
  <?php if (empty($blogs)) : ?>
    <h2 class="text-center my-8 font-bold text-5xl text-red-700">No blogs yet.</h2>
  <?php else : ?>
    <!-- Show random Blog posts from different users -->
    <h1 class="font-bold text-3xl mb-4 text-center">Blogs from other users</h1>
    <?php foreach ($blogs as $blog) : ?>
      <h1><?php echo htmlspecialchars($blog['title']) ?></h1>
      <p><?php echo htmlspecialchars($blog['blog_content']) ?></p>
      <a href="#" class="text-underline block mb-4">More info</a>
    <?php endforeach; ?>
  <?php endif; ?>

  <?php include('templates/footer.php') ?>

</body>

</html>