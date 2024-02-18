<?php
$links = [
  0 => ['title' => 'My blogs', 'link' => 'my-blogs.php'],
  1 => ['title' => 'Add blog', 'link' => 'add-blog.php'],
  2 => ['title' => 'Sign out', 'link' => 'signout.php'],
  3 => ['title' => 'Login', 'link' => 'login.php'],
  4 => ['title' => 'Sign up', 'link' => 'signup.php']
];

$curr_page_url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
// echo "The current page link is: " . $curr_page_url;

function underline_curr_link($link)
{
  global  $curr_page_url;
  return $link['link'] ===  $curr_page_url ? 'underline' : '';
};

if($curr_page_url === 'login.php' || $curr_page_url === 'signup.php') {
  $links = array_slice($links, 3);
}
?>

<header class="flex justify-between p-3 px-0">
  <a href="index.php">
    <h1 class="font-bold text-2xl">LOGO</h1>
  </a>
  <!-- Display buttons in respect to current session  -->
  <ul class="flex gap-4">
    <?php foreach ($links as $link) : ?>
      <a href="<?php echo $link['link'] ?>">
        <li class="<?php echo underline_curr_link($link); ?> font-medium hover:underline cursor-pointer text-blue-400">
          <?php echo $link['title'] ?>
        </li>
      </a>
    <?php endforeach; ?>
  </ul>
</header>