<?php
	
	  include "connect_query.php";

	  $sql = 'SELECT Title FROM posts';
	  $result = connect_query($sql);

	  if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	      echo '<a href="https://william-young.000webhostapp.com/retrieve.php?select='
		.$row["Title"].'">'
		.$row["Title"].'</a> ';
	    }
	  } else {
		  echo "0 results";
	    }
?>

