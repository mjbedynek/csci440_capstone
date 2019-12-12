<html>
<title>Inserted Post</title>
<body>

<?php

// get the data from the form and assign the data to variables
$title = $_POST['select'];

// add slashes and prepare the data for inserting into the db
//$title = addslashes($title);

// connect to the db
$conn = new mysqli("localhost","id7820654_willyoung18","/*Password*/","id7820654_blog_posts");
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . $conn->connect_errno() . PHP_EOL;
    echo "Debugging error: " . $conn->connect_error() . PHP_EOL;
    exit;
}


// prepare the query
$query = 'DELETE FROM posts WHERE Title = "' . $title. '"';

// run the query
$result = $conn->query($query);

?>
<script type = "text/javascript" > location.href = 'https://william-young.000webhostapp.com/blog_posts.php'; </script>

</body>
</html>
