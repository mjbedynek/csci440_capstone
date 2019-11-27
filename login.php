<?php

require_once "include/Database.php";
require_once "include/User.php";

$html_menu = file_get_contents("menu.php");
$html = '<head>
   <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="restyle.css">
</head>

<body>
   <header><img src = "tamuc-logo.png" alt = "TAMUC" />

<div class = "flexbox">'.$html_menu.
'</div>
</header>

<div class = "blog_box">
<div>';

// Always start this first
session_start();

if ( isset( $_POST['uname'] ) && isset( $_POST['psw'] ) ) {
   $user = new User($_POST['uname'], $_POST['psw']);
   if ($user->isAuthenticated()) {
         $_SESSION['id'] = $user->getID();
         $_SESSION['username'] = $_POST['uname'];
      if ($user->isAdmin())
         $_SESSION['isadmin'] = true;
      $html .= "<script type = 'text/javascript' > location.href = 'admin_home.php'; </script>";
   } else {
      $html .= "<h1>Invalid Username or Password. Please try again or return to the <a href = '/'>Home Page</a></h1>";
    }
}

echo $html;

?>
