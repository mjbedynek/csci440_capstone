<?php

session_start();

require_once "include/Blog.php";
require_once "include/html_includes.php";

?>
<html>
<?
   // _GET returns strings... must cast as Integer for getPost method
   $id = isset($_GET[ "id" ]) ? (int)$_GET[ "id" ] : 0;

   if ( isset ( $_SESSION['username'] ) ) {
      $blog = new Blog();
      $blogPost = $blog->getPost($id);

      // Permit the author or admin the ability to delete the post
      if ($_SESSION["id"] == $blogPost["authorid"] || $_SESSION["isadmin"])
         $blog->deletePost($id);
      else
         $html = "<p>Access denied</p>";
   } else
      $html = "<p>Login required</p>";

   echo $html;
?>

<script type = "text/javascript" > location.href = '/all_posts.php'; </script>


</body>
</html>
