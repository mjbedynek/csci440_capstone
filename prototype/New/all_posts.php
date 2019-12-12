<html>
<head>
<title>All Posts</title>


<html>
  <head>
    <link rel="stylesheet" href="styles.css">
  </head>
  
  <body>
    <header><img src = "tamuc-logo.png" alt = "TAMUC" /> 

      <div class = "flexbox">
	<?php include 'menu.php';?>	 
      </div>	
    </header>

    <div class = "post_box">
      <?php 
	include 'connect_query.php';
	include 'all_box.php';
      ?>
   </div>
   </body>
</html>
