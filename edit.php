<?php

session_start();

require_once "include/Blog.php";
require_once "include/html_includes.php";

?>
<html>

<?
$html .= $head;

// Prevent unauthorized users from making posts ;-)
if ( isset ( $_SESSION['uid'] ) ) {
   $uid = $_SESSION['uid'];

   // Store form data in usable variables
   $title = isset($_POST[ "title" ]) ? $_POST [ "title" ] : "";
   $body = isset($_POST[ "body" ]) ? $_POST [ "body" ] : "";

   $action = isset($_GET[ "action" ]) ? $_GET[ "action" ] : "";
   $pid = isset($_GET[ "pid" ]) ? (int)$_GET[ "pid" ] : 0;

   // Get the blog post to modify
   $blog = new Blog();
   $post = $blog->getPost($pid);

   // Only the user to authored the post or an admin can edit it
   if ($uid == $post["authorid"] || $_SESSION["isadmin"]) {
      switch($action) {
         case "update":
            // check to see if all the data is there
            if (!$title || !$body) {
               $html .= '<body>
                     You have not entered all the required details.<br>
                     Please go back and try again.";
                     <p><a href = "insert_form.php">Go Back</a></p>';
                     exit;
            }

            // Post to blog
            $blog->updatePost($pid, $title, $body);

            // Forward to main page?
            $html .= '<script type = "text/javascript" > location.href = \'all_posts.php\'; </script>';

            break;
         default:
            $html .= $admin_body_header;
            $html .= '
               <div class="insert-form">
                  <div class = "insert_box_wrapper">
                     <form action="edit.php?pid='.$pid.'&action=update" method = "post">
                        <label for="fname">Title</label>
                        <input type="text" id="fname" name="title" value="'.$post["title"].'">
                        <label for="lname">Body</label>
                        <textarea id="Body" name="body" style="height:200px">'.$post["body"].'</textarea>
                        <br>
                        <input type="submit" value="Submit">
                     </form>
                  </div>
               </div>';
         }
      }
   }
   echo $html;
?>

</body>
</html>
