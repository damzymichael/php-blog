<?php
include('config/db_connect.php');
include('config/init.php');

$title = $content = $image_url = '';
$errors = array('title' => '', 'content' => '', 'url' => '');

if (isset($_POST['submit'])) {
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $image_url = trim($_POST['url']);

  if (strlen($title) < 3) {
    $errors['title'] = 'Provide a valid title';
  }
  if (strlen($content) < 50) {
    $errors['content'] = 'Blog content too short';
  }

  if (strlen($image_url) > 1 && !filter_var($image_url, FILTER_VALIDATE_URL)) {
    $errors['url'] = 'Enter a valid url';
  }

  if (!array_filter($errors)) {
    $title = pg_escape_string($connection, $title);
    $content = pg_escape_string($connection, $content);
    $image_url = pg_escape_string($connection, $image_url);
    $user_id = intval($_SESSION['user']['id']);
    // Insert data into the database
    $query = "INSERT INTO blogs(user_id, title, blog_content, image_link) VALUES('$user_id', '$title', '$content', '$image_url')";
    if (pg_query($connection, $query)) {
      header("Location: my-blogs.php");
    } else {
      //! Change to error displaying in the DOM
      echo "Error adding blog";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <form action="add-blog.php" class="flex flex-col gap-3" method="POST">
    <input type="text" name="title" placeholder="Blog title" class="border outline-none p-3 rounded-md" value="<?php echo htmlspecialchars($title) ?>" required>
    <p class="text-red-600"><?php echo $errors['title'] ?></p>
    <textarea name="content" id="" cols="30" rows="10" class="border outline-none p-3 rounded-md" placeholder="Blog content" required><?php echo htmlspecialchars($content) ?></textarea>
    <p class="text-red-600"><?php echo $errors['content'] ?></p>
    <input type="url" name="url" value="<?php echo htmlspecialchars($image_url) ?>" placeholder="Image url (optional)" class="border outline-none p-3 rounded-md">
    <p class="text-red-600"><?php echo $errors['url'] ?></p>
    <input type="submit" name="submit" class="border bg-blue-700 self-center p-2 rounded-lg text-white">
  </form>
  <?php include('templates/footer.php') ?>
  <script>
    document.title = "Add Blog"
  </script>
</body>

</html>