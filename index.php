<?php

session_start();

require_once "include/Blog.php";
require_once "include/html_includes.php";

?>
<!DOCTYPE HTML>
<html>
<?

$html = $head.'<body>';

// if user is admin - use admin header
if ( isset ( $_SESSION['isadmin'] ) )
   $html .= $admin_body_header;
else
   $html .= $user_body_header;

// Sidenav?  Do we keep it???
//$html .= '<div class="sidenav"><div>';
#	php include "sidenav.php";
//$html .= '</div></div>';

// Blog box
$blog = new Blog();
$html .= '<div class = "blog_box">
<div><h1>Most Recent Posts</h1>';
#$row = $blog->getLatestPost();
$row = $blog->getPage(1,1)[0];
if ($row) {
   $html .= "<h1>" . $row["title"]. "</h1> ".
        "<p>". $row["body"]."</p><br>".
        "<em>By: ".$row["displayname"]."</em><br>".
        "Posted: ".$row["postdatetime"];
   if ($_SESSION["id"] == $row["authorid"] || $_SESSION["isadmin"])
      $html .= "<br><br><a href=edit.php?pid=".$row["pid"].">Edit</a>".
               "&nbsp&nbsp&nbsp<a href=delete.php?pid=".$row["pid"].">Delete</a>";
} else {
   $html .= "0 results";
}
$html .= '</div></div>';


echo $html;
echo $body;

?>
</body>
</html>

