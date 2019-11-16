<?php
  //Displays all posts in the db.

  //Includes the connect and query file.
  //include "connect_query.php";
  
  //Selects most recent post.
  //$sql = 'SELECT * FROM posts ORDER BY id DESC';
  $sql = 'select title, body, postdatetime, displayname 
                from posts 
                left join users on posts.authorid = users.id
                order by postdatetime desc';

  $result = connect_query($sql); 

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<div><h1>" . $row["title"]. "</h1> ".
	"<p>". $row["body"]."</p><br>".
	"<em>By: ".$row["displayname"]."</em><br>".
	"Posted: ".$row["postdatetime"]. "</div>";
    }
  } else {
      echo "0 results";
    }
?>

