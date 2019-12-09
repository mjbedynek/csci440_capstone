<?php

// Always start this first
session_start();

require_once "include/html_includes.php";
require_once "include/User.php";

$html_menu = file_get_contents("menu.php");
$html = $head;
$html .= '

<body>
   <header><img src = "/image/tamuc-logo.png" alt = "TAMUC" />

<div class = "flexbox">'.$html_menu.
'</div>
</header>

<div class = "blog_box">
<div>';


if ( isset( $_POST['uname'] ) && isset( $_POST['psw'] ) ) {
   try {
      $user = new User($_POST['uname']);
      $user->login($_POST['psw']);
      $_SESSION['uid'] = $user->getUID();
      $_SESSION['username'] = $_POST['uname'];
      if ($user->isAdmin())
         $_SESSION['isadmin'] = true;
      $html .= "<script type = 'text/javascript' > location.href = 'all_posts.php'; </script>";
   } catch (Exception $e) {
      $html .= "<h1>Invalid Username or Password. Please try again or return to the <a href = '/'>Home Page</a></h1>";
   }
}

echo $html;

?>

</body>
</html>
