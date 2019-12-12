<?php

session_start();

require_once "include/Blog.php";
require_once "include/html_includes.php";

?>
<html>

<?
$html .= $head;
$html .= '<body>';

// if user is admin - use admin header
if ( isset ( $_SESSION['isadmin'] ) )
   $html .= $admin_body_header;
else
   $html .= $user_body_header;

// If a page is not specified, assume page 1
if (isset($_GET["page"]))
   $pagenum = (int)$_GET["page"];
else
   $pagenum = 1;
   
// Page size (default is 5)
if (isset($_GET["psize"]))
   $psize = (int)$_GET["psize"];
else if ( isset($_SESSION['psize']))
   $psize = (int)$_SESSION['psize'];
else
   $psize = 5;

// Sidenav?  Do we keep it???
//$html .= '<div class="sidenav"><div>';
#  php include "sidenav.php";
//$html .= '</div></div>';

// Instatiate new blog object
$blog = new Blog();

// Display results for a single Post
if ( isset($_GET[ "pid" ]) ) {
   $html .= '<div class = "blog_box"><div>';
   $pid = (int) $_GET[ "pid" ];
   //$keyword = $_GET[ "keyword" ];
   $row = $blog->getPost($pid);
   if ($row) {
      $html .= "<h1>" . $row["title"]. "</h1> ".
               "<p>". $row["body"]."</p><br>".
               "<em>By: ".$row["displayname"]."</em><br>".
               "Posted: ".$row["postdatetime"];
      if ($_SESSION["id"] == $row["authorid"] || $_SESSION["isadmin"])
         $html .= "<br><br><a href=edit.php?pid=".$row["pid"].">Edit</a>".
                  "&nbsp&nbsp&nbsp<a href=delete.php?pid=".$row["pid"].">Delete</a>";
      //$html .= "<br><a href=/search.php?keyword=".$keyword."&page=".$pagenum."&psize=".$psize.">Back to Search results...</a>&nbsp";
      $html .= '</div></div>';
      } else {
         $html .= "Post may have been deleted";
         $html .= '</div></div>';
      }
// Search for results
} else if ( isset($_GET[ "keyword" ]) ) {
   $html .= '<div class = "blog_box"><div>';
   $keyword = $_GET[ "keyword" ];

   // Get the search results
   $search_results = $blog->search($pagenum, $psize, $keyword);
   $search_results_count = $blog->getPostCount($keyword);

   if ($search_results) {
      foreach ($search_results as $row) {
         $body_trunc = strip_tags(substr($row["body"], 0, 500)) . "...";
         $html .= "<a href=\"/search.php?pid=".$row["pid"]."&page=".$pagenum."\"><h2>" . $row["title"]. "</h2></a> ".
                  "<p>". $body_trunc."</p><br>".
                  "Posted: ".$row["postdatetime"];
      }
      // Pagination to display multiple pages of results
      if ($search_results_count > $psize) {
         $num_of_pages = $search_results_count / $psize;
         // If there are leftover results, add another page
         if ($search_results_count % $psize)
            $num_of_pages++;
         $html .= "<h2>Page&nbsp:&nbsp";
         for ($p = 1; $p <= $num_of_pages; $p++) {
            if ($pagenum == $p)
               $html .= "$p&nbsp;";
            else
               $html .= "<a href=/search.php?keyword=".$keyword."&page=".$p."&psize=".$psize.">".$p."</a>&nbsp";
         }
         $html .= "</h2>";
         $html .= '</div></div>';
      }
   // If no results,let the user know this
   } else {
      $html .= "0 results";
      $html .= '</div></div>';
   }
// Display search form
} else {
   $html .= '<div class="insert-form">
               <div class = "insert_box_wrapper">
                  <form action="/search.php" method = "get">
                     <label for="keyword">Search for</label>
                     <input type="text" id="keyword" name="keyword" placeholder="Insert a key word.. ">
                     <label for="psize">Results Per Page:</label>
                     <select name="psize">';
   foreach ($page_sizes as $v) {
      if ($psize == $v)
         $html .= "<option value=\"$v\" selected>$v</option>";
      else
         $html .= "<option value=\"$v\">$v</option>";
   }
   $html .='</select>
                     <!-- Hidden fields for passing data -->
                     <input type="hidden" name="page" value="'.$pagenum.'">
                     <input type="submit" value="Search">
                  </form>
               </div>
            </div>';
}


echo $html;
?>

</body>
</html>
