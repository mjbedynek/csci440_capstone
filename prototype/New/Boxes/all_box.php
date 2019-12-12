<?php
  //Displays all posts in the db.

  //Includes the connect and query file.
  //include "connect_query.php";
  
  //Selects most recent post.
  $sql = 'SELECT * FROM posts ORDER BY postsid DESC';
  $result = connect_query($sql); 

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<div><h1>" . $row["Title"]. "</h1> ".
	"<p>". $row["Body"]."</p><br>".
	"<em>By: ".$row["author"]."</em><br>".
	"Posted: ".$row["post_date"]. "</div>";
    }
  } else {
      echo "0 results";
    }
?>

