<?php

$page_sizes = [ 5, 10, 25, 50, 100 ];

$head = '<head>
   <meta charset = "utf-8">
   <title>Blog Site</title>
   <link rel="stylesheet" href="/css/styles.css">
   <link rel="stylesheet" href="/css/restyle.css">
</head>';

$headedit = '<head>
   <meta charset = "utf-8">
   <title>Blog Site</title>
   <link rel="stylesheet" href="/css/styles.css">
   <link rel="stylesheet" href="/css/restyle.css">
   <script src="/ckeditor/ckeditor.js"></script>
</head>';

$admin_body_header = '<header>
   <img src = "/image/tamuc-logo.png" alt = "TAMUC" />
   <div class = "flexbox">
      <div><a href="/">Home</a></div> - 
      <div><a href="all_posts.php">All Posts</a></div> - 
      <div><a href="search.php">Find Posts</a></div> - 
      <div><a href="insert.php">Make Post</a></div> - 
      <div><a href="prefs.php">Preferences</a></div> - 
      <div><a href="logoff.php">Log Off</a></div> - 
   </div>
</header>';
#<div><a href="modify_form.php">Edit Posts</a></div> - 
#<div><a href="delete_form.php">Delete Posts</a></div> - 
 
$user_body_header = '
<header><img src = "/image/tamuc-logo.png" alt = "TAMUC" />
<div class = "flexbox">
<div><a href="http://no-carrier.org/">Home</a></div> -
   <div><a href="http://no-carrier.org/all_posts.php">All Posts</a></div> -
   <div><a href="http://no-carrier.org/search.php">Find Posts</a></div> -
  
   <div>
   <a onclick="document.getElementById(\'id01\').style.display=\'block\'" style="width:auto;">Login</a>

<div id="id01" class="modal">

  <form class="modal-content animate" action="login.php" method="post">

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <button type="submit">Login</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById(\'id01\').style.display=\'none\'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById(\'id01\');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</div>
</header>';


?> 

