<?php

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<body>
  <?php include('templates/nav.php') ?>
  <form action="add-blog.php" class="flex flex-col gap-3">
    <input type="text" placeholder="Blog title" class="border outline-none p-3 rounded-md" required>
    <textarea name="content" id="" cols="30" rows="10" class="border outline-none p-3 rounded-md" placeholder="Blog content" required></textarea>
    <input type="text" placeholder="Image url (optional)" class="border outline-none p-3 rounded-md">
    <input type="submit" class="border bg-blue-700 self-center p-2 rounded-lg text-white">
  </form>
  <?php include('templates/footer.php') ?>
</body>

</html>