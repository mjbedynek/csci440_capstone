<html>
<title>Inserted Post</title>
<body>

<?php
include "connect_query.php";

// get the data from the form and assign the data to variables
$title = $_POST['select'];

// add slashes and prepare the data for inserting into the db
//$title = addslashes($title);

// connect to the db
// prepare the query
$sql = 'DELETE FROM posts WHERE Title = "' . $title. '"';

// run the query
$result = connect_query($sql);

?>
<script type = "text/javascript" > location.href = 'http://no-carrier.org/all_posts.php'; </script>

</body>
</html>
