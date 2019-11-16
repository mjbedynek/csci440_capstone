<html>
  <title>Inserted Post</title>
<body>

  <?php

  include "connect_query.php";

  // get the data from the form and assign the data to variables
  $title = $_POST['Title'];
  $body = $_POST['Body'];

  // check to see if all the data is there
  if (!$title || !$body)
  {
    echo "You have not entered all the required details.<br>"
		."Please go back and try again.";
    echo '<p><a href = "http://no-carrier.org/insert_form.php">Go Back</a></p>';
    exit;
  }

  // add slashes and prepare the data for inserting into the db
  $title = addslashes($title);
  $body = addslashes($body);

  // INSERT INTO posts (authorid, body, title) VALUES (1, "testing a msg", "routine test")
  
  // set to admin for now - change later
  $authorid = 1;

  // prepare the query
  $sql = "insert into posts (authorid, title, body) VALUES (1,"
            ."'".$title."','".$body."')";
  // Connect to the database and run query.
  connect_query($sql);

  ?>

  <script type = "text/javascript" > location.href = 'http://no-carrier.org/all_posts.php'; </script>

</body>
</html>
