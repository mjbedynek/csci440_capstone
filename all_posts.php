<?php

session_start();

require_once "include/Blog.php";
require_once "include/html_includes.php";

?>
<!DOCTYPE HTML>
<html>
<?

// If a page is not specified, assume page 1
if (isset($_GET["page"]))
   $pagenum = (int)$_GET["page"]; 
else
   $pagenum = 1;
// Determine page size
if (isset($_GET["psize"]))
   $psize = $_GET["psize"]; 
else if ( isset($_SESSION['psize']))
   $psize = $_SESSION['psize'];
else
   $psize = 5;


$html = $head.'<body>';

// if user is admin - use admin header
if ( isset ( $_SESSION['isadmin'] ) )
   $html .= $admin_body_header;
else
   $html .= $user_body_header;


// Sidenav?  Do we keep it???
//$html .= '<div class="sidenav"><div>';
#  php include "sidenav.php";
//$html .= '</div></div>';

// Blog box
$blog = new Blog();
$html .= '<div class = "blog_box">
<div><h1>Most Recent Posts</h1>';
$rows = $blog->getPage($pagenum, $psize);
$postCount = $blog->getPostCount();

if ($rows) {
   foreach ($rows as $row) {
      $html .= "<h1>" . $row["title"]. "</h1> ".
               "<p>". $row["body"]."</p><br>".
               "<em>By: ".$row["displayname"]."</em><br>".
               "Posted: ".$row["postdatetime"];
      // Only the admin or the user to created the post can see edit/delete
      if ($_SESSION["uid"] == $row["authorid"] || $_SESSION["isadmin"])
         $html .= "<br><br><a href=edit.php?pid=".$row["pid"].">Edit</a>".
               "&nbsp&nbsp&nbsp<a href=delete.php?pid=".$row["pid"].">Delete</a>";
   }
   if ($postCount > $psize) {
      $num_of_pages = $postCount / $psize;
      // If there are leftover results, add another page
      if ($postCount % $psize)
         $num_of_pages++;
         $html .= "<h2>Page&nbsp:&nbsp";
         for ($p = 1; $p <= $num_of_pages; $p++) {
            if ($pagenum == $p)
               $html .= "$p&nbsp;";
            else
               $html .= "<a href=/all_posts.php?page=".$p."&psize=".$psize.">".$p."</a>&nbsp";
         }
         $html .= "</h2>";
         $html .= '</div></div>';
      }
} else {
   $html .= "0 results";
}
$html .= '</div></div>';

echo $html;


?>
</body>
</html>
