<!DOCTYPE HTML>
<html>
  <head>
    <meta charset = "utf-8">
    <title>Admin Menu</title> 
    <link rel="stylesheet" href="styles.css">        
  </head>
  
  <body>
    <header><img src = "tamuc-logo.png" alt = "TAMUC" /> 

      <div class = "flexbox">
        <?php include 'admin_menu.php';?>    
      </div>	
    </header>

<!--
       <div class="sidenav">
       <div>
	<?php include "sidenav.php";?>
      </div></div>
-->

      <div class = "post_box">
	 <?php include "all_box.php";?>
      </div>

  </body>
</html>

