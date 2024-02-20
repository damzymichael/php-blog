<?php
//CANT DO ANY REDIRECTS HERE
include('config/init.php');

$links = [
  0 => ['title' => 'My blogs', 'link' => 'my-blogs.php'],
  1 => ['title' => 'Add blog', 'link' => 'add-blog.php'],
  2 => ['title' => 'Sign out', 'link' => 'index.php?signout'],
  3 => ['title' => 'Login', 'link' => 'login.php'],
  4 => ['title' => 'Sign up', 'link' => 'signup.php']
];

//Add underline classname to current link
function underline_curr_link($link)
{
  global  $curr_page_url;
  return $link['link'] ===  $curr_page_url ? 'underline' : '';
};

if ($curr_page_url === 'login.php' || $curr_page_url === 'signup.php') {
  $links = array_slice($links, 3);
}

if ($logged_in_user !== 'None') {
  array_splice($links, 3);
} else {
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