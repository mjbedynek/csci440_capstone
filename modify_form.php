
<html>
<title>Modify Post</title>


<html>
  <head>
    <meta charset = "utf-8">
    <title>Insert Form</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  
  <body>
    <header><img src = "tamuc-logo.png" alt = "TAMUC" /> 

	<div class = "flexbox">
	  <?php include 'admin_menu.php';?>	
	</div>	
     </header>
    
     <div class="sidenav">
       <div>
	<?php include "sidenav.php";?>
      </div></div>


    <div class= "form_box">
    <div><form method = "post" action = "modify.php">
	  Select a post to edit: <br><br>
<?php
	  //include "connect_query.php";

	  $sql = 'SELECT id,title,postdatetime FROM posts 
	                 ORDER BY postdatetime DESC';
	  $result = connect_query($sql);
	  
	  if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	      echo "<input type = 'radio' name = 'id' value= ".$row['id'].">"  .$row['title']."<br><br>";
	    }
	  } else {
	      echo "0 results";
	    }
?>
	   <input type = "submit" value = "Modify">
	  </form>
    </div></div>
   </body>
</html>
