<?php
include('config/db_connect.php');
include('config/init.php');

$blog_query = "SELECT blogs.*,
               COUNT(likes.blog_id) AS num_likes,
               COUNT(comments.blog_id) AS num_comments
               FROM blogs 
               LEFT JOIN likes ON likes.blog_id = blogs.id 
               LEFT JOIN comments ON comments.blog_id = blogs.id 
               WHERE blogs.user_id = $1
               GROUP BY blogs.id";
               
$result = pg_query_params($connection, $blog_query, array(($_SESSION['user']['id'])));

if ($result) {
  $blogs = pg_fetch_all($result, PGSQL_ASSOC);
} else {
  $error_message = pg_last_error($connection);
  echo "Query failed: $error_message";
}

pg_free_result($result);
pg_close($connection);
?>

<?php ?>
<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <!-- Content -->
  <h1 class="text-2xl font-bold mb-4">My blogs</h1>
  <?php if (count($blogs) > 0) : ?>
    <?php foreach ($blogs as $blog) : ?>
      <div class="bg-[#f7f7f7] p-3 rounded-lg mb-2">
        <h2 class="text-[#111] mb-2 font-semibold"><?php echo  htmlspecialchars($blog["title"]) ?></h2>
        <p class="text-sm mb-2"><?php echo substr(htmlspecialchars($blog['blog_content']), 0, 300) ?>... <a class="text-blue-400 cursor-pointer">Read More</a></p>
        <div class="flex gap-4 mr-6 w-max ml-auto">
          <span class="flex gap-2 items-center">
            <i class="fa-regular fa-heart"></i>
            <p><?php echo $blog['num_likes'] ?></p>
          </span>
          <span class="flex gap-2 items-center">
            <i class="fa-regular fa-comment"></i>
            <p><?php echo $blog['num_comments'] ?></p>
          </span>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <p class="text-xl mb-3">You have no blogs yet</p>
  <?php endif; ?>

  <?php include('templates/footer.php') ?>
  <script>
    document.title = "<?php echo explode(' ', $logged_in_user['fullname'])[0] . "'s Blog"  ?>"
  </script>
</body>

</html>