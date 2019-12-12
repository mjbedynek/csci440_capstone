<?php

session_start();

require_once "include/User.php";
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

// main body
$html .= '<div class="insert-form">
          <div class = "insert_box_wrapper">';

if ( isset ( $_SESSION['username'] ) ) {
   $user = new User($_SESSION['username']);

   // Sidenav?  Do we keep it???
   #$html .= '<div class="sidenav"><div>';
   #$html .= '<a href="/prefs.php?edit=email">Password</a>';
   #$html .= '<a href="/prefs.php?edit=email">E-mail Address</a>';
   #$html .= '<a href="/prefs.php?edit=email">Preferences</a>';
   #$html .= '</div></div>';

   // Configuration section
   $msgs = [];
   if (!empty($_POST)) {
      // Changing of password
      if (isset($_POST['password']) && !empty($_POST['password']) &&
         isset($_POST['password1']) && !empty($_POST['password1']) &&
         isset($_POST['password2']) && !empty($_POST['password2'])) { 

         if ($_POST['password1'] == $_POST['password2']) {
            try {
               $user->setPassword($_POST['password'], $_POST['password1']);
               array_push($msgs, "Password updated");
            } catch (Exception $e) {
               array_push($msgs, $e->getMessage());
            }
         } else {
            array_push($msgs, "Password does not match");
         }
      }
      // Changing of e-mail address
      if ( isset($_POST['email']) && !empty($_POST['email']) ) {
         try {
            $user->setEmailAddress($_POST['email']);
            array_push($msgs, "E-mail updated");
         } catch (Exception $e) {
            array_push($msgs, $e->getMessage());
         }
      }
      // Default Page size
      if ( isset($_POST['psize']) && !empty($_POST['psize']) ) {
         try {
            $user->setPageSize((int)$_POST['psize']);
            $_SESSION['psize'] = (int)$_POST['psize'];
         }
         catch (Exception $e) {
            array_push($msgs, $e->getMessage());
         }
      }
   }

   $html .= '<h1>Your settings</h1>';

   if ($msgs) {
      $html .= '<em>Changes or errors found...</em><ul>';
      foreach ($msgs as $msg)
         $html .= '<li>'.$msg.'</li>';
      $html .= '</ul>';
   }

   $html .= '<p>Only changed values will be updated...</p>';

   $html .= '<form action="/prefs.php" method = "post">
                     <label for="password">Current Password</label>
                     <input type="password" id="password" name="password" placeholder="Current Password">
                     <label for="password1">Set new Password</label>
                     <input type="password" id="password1" name="password1" placeholder="New Password">
                     <label for="password2">Confirm new Password</label>
                     <input type="password" id="password2" name="password2" placeholder="Confirm Password">
                     <label for="email">E-mail Address</label>
                     <input type="text" id="email" name="email" value="'.$user->getEmailAddress().'">
                     <label for="psize">Default page Size:</label>
                     <select name="psize">';
   foreach ($page_sizes as $v) {
      if ($user->getPageSize() == $v)
         $html .= "<option value=\"$v\" selected>$v</option>";
      else
         $html .= "<option value=\"$v\">$v</option>";
   }
     $html .='                </select>
                     <!-- Hidden fields for passing data -->
                     <input type="submit" value="Save Settings">
                  </form>';
} else
   $html .= 'Invalid login.';

$html .= '</div></div>';

echo $html;

?>
</body>
</html>
