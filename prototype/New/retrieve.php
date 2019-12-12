<html>
    <head>

        <meta charset = "utf-8">
	<?php 
	//Dispalying the title of the requested post
	//include "connect_query.php";
	  $title = $_GET['select'];
	  '<title>'.$title.'</title>'
        ?> 

	<link rel="stylesheet" href="styles.css">
  </head>
  
  <body>
  <body>
    <header><img src = "tamuc-logo.png" alt = "TAMUC" /> 

      <div class = "flexbox">
        <?php include 'menu.php';?>    
      </div>	
    </header>
	
      <div class="sidenav">
      <div>
	<?php include "sidenav.php";?>
      </div></div>

      <div class = "blog_box">
      <div>
	<?php	
	  $sql = 'SELECT * FROM posts WHERE Title = "'.$title. '"';
	  $result = connect_query($sql);

	   if ($result->num_rows > 0) {
	       // output data of each row
	      while($row = $result->fetch_assoc()) {
	          echo "<h1>" . $row["Title"]. "</h1> ".
	      		"<p>". $row["Body"]."</p><br>".
			"<em>By: ".$row["author"]."</em><br>".
			"Posted: ".$row["post_date"];
	      }
	    } else {
		echo "0 results";
	      }
	
	?>
	</div>
	</div>
</body>
</html>
