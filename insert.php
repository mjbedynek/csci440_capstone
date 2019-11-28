<?php

session_start();

require_once "include/Database.php";
require_once "include/html_includes.php";

?>
<html>

<?
$html .= $head;


// Prevent unauthorized users from making posts ;-)
if ( isset ( $_SESSION['username'] ) ) {
   // Store form data in usable variables
   $action = isset($_POST[ "action" ]) ? $_POST [ "action" ] : "";
   $title = isset($_POST[ "title" ]) ? $_POST [ "title" ] : "";
   $body = isset($_POST[ "body" ]) ? $_POST [ "body" ] : "";

   switch($action) {
      case "add":
         // check to see if all the data is there
         if (!$title || !$body) {
         $html .= '<body>
                  You have not entered all the required details.<br>
                  Please go back and try again.";
                  <p><a href = "insert_form.php">Go Back</a></p>';
                  exit;
         }

         // add slashes and prepare the data for inserting into the db
         $title = addslashes($title);
         $body = addslashes($body);

         // Open connection to DB
         $dbh = new Database();

         // Get Author from PHP session data
         $authorid = isset($_SESSION[ "id" ]) ? $_SESSION [ "id" ] : "";

         // Parameterize query
         $params = [
                     'authorid'  => $authorid,
                     'title'     => $title,
                     'body'      => $body,
                   ];
         $sql = "INSERT INTO posts (authorid, title, body) VALUES (:authorid, :title, :body)";
         // Insert into DB
         $dbh->insert($sql, $params);

         // Forward to main page?
         $html .= '<script type = "text/javascript" > location.href = \'all_posts.php\'; </script>';

         break;
      default:
#         $body = '
#            <header><img src = "tamuc-logo.png" alt = "TAMUC" />
#            <div class = "flexbox">'.$admin_menu.'</div></header>';
         $html .= $admin_body_header;
         $html .= '
            <div class="insert-form">
               <div class = "insert_box_wrapper">
                  <form action="insert.php?action=add" method = "post">
                     <input type="hidden" name="action" value="add" />
                     <label for="fname">Title</label>
                     <input type="text" id="fname" name="title" placeholder="Insert title.. ">
                     <label for="lname">Body</label>
                     <textarea id="Body" name="body" placeholder="Write something.." style="height:200px"></textarea>
                     <br>
                     <input type="submit" value="Submit">
                  </form>
               </div>
            </div>';
      }
   }
   echo $html;
?>

</body>
</html>
