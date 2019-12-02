<?php

session_start();

require_once "include/Blog.php";
require_once "include/html_includes.php";

?>
<html>
<?
   // _GET returns strings... must cast as Integer for getPost method
   $pid = isset($_GET[ "pid" ]) ? (int)$_GET[ "pid" ] : 0;

   if ( isset ( $_SESSION['username'] ) ) {
      $blog = new Blog();
      $blogPost = $blog->getPost($id);

      // Permit the author or admin the ability to delete the post
      if ($_SESSION["uid"] == $blogPost["authorid"] || $_SESSION["isadmin"])
         $blog->deletePost($pid);
      else
         $html = "<p>Access denied</p>";
   } else
      $html = "<p>Login required</p>";

   echo $html;
?>

<script type = "text/javascript" > location.href = '/all_posts.php'; </script>


</body>
</html>
