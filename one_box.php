<?php
  //Displays the most recent post in the db.

  //Includes the connect and query file.
  //include "connect_query.php";
  
  //Selects most recent post.
  //$sql = 'SELECT * FROM posts ORDER BY id DESC LIMIT 1';
  $sql = 'select title, body, postdatetime, displayname 
                from posts 
                left join users on posts.authorid = users.id
                order by postdatetime desc limit 1';
  $result = connect_query($sql); 

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<h1>" . $row["title"]. "</h1> ".
	"<p>". $row["body"]."</p><br>".
	"<em>By: ".$row["displayname"]."</em><br>".
	"Posted: ".$row["postdatetime"];
    }
  } else {
      echo "0 results";
    }
?>
