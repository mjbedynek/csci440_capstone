<html>
  <title>Inserted Post</title>
<body>

  <?php

  include "connect_query.php";

  // get the data from the form and assign the data to variables
  $title = $_POST['Title'];
  $body = $_POST['Body'];
  $date = $_POST['post_date'];
  $author = $_POST['author'];

  // check to see if all the data is there
  if (!$title || !$body || !$date || !$author)
  {
    echo "You have not entered all the required details.<br>"
		."Please go back and try again.";
    echo '<p><a href = "http://no-carrier.org/insert_form.php">Go Back</a></p>';
    exit;
  }

  // add slashes and prepare the data for inserting into the db
  $title = addslashes($title);
  $body = addslashes($body);
  $date = addslashes($date);
  $author = addslashes($author);

  // prepare the query
  $sql = "insert into posts values
	('".NULL."','".$title."','".$body."','".$date."','".NULL."','".$author."')";

  // Connect to the database and run query.
  connect_query($sql);

  ?>

  <script type = "text/javascript" > location.href = 'http://no-carrier.org/blog_posts.php'; </script>

</body>
</html>
