<html>
<title>Inserted Post</title>
<body>

<?php

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
    echo '<p><a href = "https://william-young.000webhostapp.com/insert_form.html">Go Back</a></p>';
	exit;
}

// add slashes and prepare the data for inserting into the db
$title = addslashes($title);
$body = addslashes($body);
$date = addslashes($date);
$author = addslashes($author);

// connect to the db
$conn = new mysqli("localhost","id7820654_willyoung18","/*Password*/","id7820654_blog_posts");
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . $conn->connect_errno() . PHP_EOL;
    echo "Debugging error: " . $conn->connect_error() . PHP_EOL;
    exit;
}

// prepare the query
$query = "insert into posts values
	('".NULL."','".$title."','".$body."','".$date."','".NULL."','".$author."')";

// run the query
$result = $conn->query($query);
/*
if ($result) {
    // output data of each row
        echo "id: " . $row["postsid"]. " - Name: " . $row["Title"]. " " . $row["Body"]. "<br>";
    
} else {
    echo "0 results";
}
*/


?>
<script type = "text/javascript" > location.href = 'https://william-young.000webhostapp.com/blog_posts.php'; </script>
</body>
</html>
