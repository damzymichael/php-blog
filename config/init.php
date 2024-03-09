<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
$logged_in_user = $_SESSION['user'] ?? 'None';
$curr_page_url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
// echo "The current page link is: " . $curr_page_url;


//Redirect from login or signup page if there's an active user in session
if ($curr_page_url === 'login.php' || $curr_page_url === 'signup.php') {
  if ($logged_in_user !== 'None') {
    header('Location: index.php');
  }
}

?>
<!-- SESSION INITIALIZATION  -->
<!-- REDIRECT IF EXISTING USER  -->