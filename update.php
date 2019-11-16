<html>
  <title>Updated Post</title>
<body>

  <?php

  include "connect_query.php";

  // get the data from the form and assign the data to variables
  $title = $_POST['Title'];
  $body = $_POST['Body'];
  $id = $_POST['id'];

  // check to see if all the data is there
  if (!$title || !$body)
  {
    echo "You have not entered all the required details.<br>"
		."Please go back and try again.";
    echo '<p><a href = "http://no-carrier.org/modify_form.php">Go Back</a></p>';
    exit;
  }

  // add slashes and prepare the data for inserting into the db
  $title = addslashes($title);
  $body = addslashes($body);
  //$date = addslashes($date);
  //$author = addslashes($author);
  

  // prepare the query
  $sql = "UPDATE posts 
          SET title = '".$title."', body= '".$body."'
	      WHERE id = ".$id."";
	      
  // Connect to the database and run query.
  connect_query($sql);

  ?>

  <script type = "text/javascript" > location.href = 'all_posts.php'; </script>

</body>
</html>
