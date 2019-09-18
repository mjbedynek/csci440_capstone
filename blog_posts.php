<html>
<head>
<title>Query All Movies from Database</title>


<html>
    <head>

        <link rel="stylesheet" href="styles.css">
  </head>
  
  <body>
     <header><img src = "tamuc-logo.png" alt = "TAMUC" /> 

	<div class = "flexbox">
	 
	<div><a href = "https://william-young.000webhostapp.com">Home</a></div>
	 
	<div><a href = "https://william-young.000webhostapp.com/blog_posts.php">All Posts</a></div>
	
	<div><a href = "https://william-young.000webhostapp.com/insert_form.html">New Post</a></div>
	
	<div><a href = "https://william-young.000webhostapp.com/delete_form.html">Delete Post</a></div>
	
	<div><a href = "https://william-young.000webhostapp.com/about.html">About</a></div>
	
	</div>	
     </header>
    <div class = "post_box">
<?php
	
	$conn = new mysqli("localhost","id7820654_willyoung18","/*Password*/","id7820654_blog_posts");

	if (!$conn) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . $conn->connect_errno() . PHP_EOL;
	    echo "Debugging error: " . $conn->connect_error() . PHP_EOL;
	    exit;
	}


	$sql = "SELECT * FROM posts ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "<div><h1>" . $row["Title"]. "</h1> ".
				"<p>". $row["Body"]."</p><br>".
				"<em>By: ".$row["author"]."</em><br>".
				"Posted: ".$row["post_date"]."</div>";
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
?>
   </div>
   </body>
</html>