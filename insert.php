<?php

session_start();

require_once "include/Blog.php";
require_once "include/html_includes.php";

?>
<html>

<?
$html .= $headedit;


// Prevent unauthorized users from making posts ;-)
if ( isset ( $_SESSION['uid'] ) ) {
   $uid = $_SESSION['uid'];

   // Store form data in usable variables
   $action = isset($_GET[ "action" ]) ? $_GET [ "action" ] : "";
   $title = isset($_POST[ "title" ]) ? $_POST [ "title" ] : "";
   $body = isset($_POST[ "body" ]) ? $_POST [ "body" ] : "";

   switch($action) {
      case "add":
         // check to see if all the data is there
         if (!$title || !$body) {
         $html .= '<body>
                  You have not entered all the required details.<br>
                  Please go back and try again.";
                  <p><a href = "insert.php">Go Back</a></p>';
                  exit;
         }

         // Open connection to DB
         $blog = new Blog();

         // Post to blog
         $blog->newPost($uid, $title, $body);

         // Forward to main page?
         $html .= '<script type = "text/javascript" > location.href = \'all_posts.php\'; </script>';

         break;
      default:
#         $body = '
#            <header><img src = "tamuc-logo.png" alt = "TAMUC" />
#            <div class = "flexbox">'.$admin_menu.'</div></header>';
         $html .= $admin_body_header;
           $function_number = $_GET['CKEditorFuncNum'];

         $html .= '
            <div class="insert-form">
               <div class = "insert_box_wrapper">
                  <form action="insert.php?action=add" method = "post">
                     <label for="fname">Title</label>
                     <input type="text" id="fname" name="title" placeholder="Insert title.. ">
                     <label for="lname">Body</label>
                     <textarea id="Body" name="body" placeholder="Write something.." style="height:200px"></textarea>
                     <br>
                     <input type="submit" value="Submit">
                  </form>
               </div>
            </div>
            <script>

                      CKEDITOR.replace(\'Body\', {
                              filebrowserUploadUrl: \'ckul.php?cmd=upload\',
                                      filebrowserUploadMethod: \'form\'
                                          });
            </script>';
      }
   }
                     #window.parent.CKEDITOR.tools.callFunction($function_number, $url, $message);
   echo $html;
?>

</body>
</html>
