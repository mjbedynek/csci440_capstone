<?php

require_once "Database.php";

class User {

   // Instance variables
   private $authenticated;
   private $dbh;
   private $defaultPageSize;
   private $emailAddress;
   private $isadmin;
   private $lastlogin;
   private $uid;
   private $username;

   // Constructor
   function __construct($username) {
      // Open a connection to the DB
      $this->dbh = new Database();
      // Parameterize query - prevent SQL injection
      // Also use strip tags to remove html from username and password
      $params = [ 'username'  => strip_tags($username) ];
      $sql = 'SELECT uid, username, lastlogin, email, def_page_size FROM users WHERE
              username = :username';
      $res = $this->dbh->query($sql, $params)[0];

      // If we get any results then the username is valid
      if ($res) {
         // Store instance vars for obj
         $this->defaultPageSize = $res['def_page_size'];
         $this->emailAddress = $res['email'];
         $this->lastlogin = $res['lastlogin'];
         $this->uid = $res['uid'];
         $this->username = $res['username'];
         // Recast string value to boolean
      } else {
         throw new Exception('Invalid user name');
      }
   }

   public function getEmailAddress() {
      return $this->emailAddress;
   }

   public function getPageSize() {
      return $this->defaultPageSize;
   }

   // Return id (from DB)
   public function getUID() {
      return $this->uid;
   }

   // Return username for object
   public function getUserName() {
      return $this->username;
   }

   // Return if user is admin
   public function isAdmin() {
      // Must be authenticated and isadmin to be considered an admin..
      return $this->authenticated && $this->isadmin;
   }

   public function isAuthenticated() {
      return $this->authenticated;
   }

   /**
    * User authentication
    * @param password the user password in clear text
    */
   public function login($password) {
      $password_hash = hash('sha256', $password);
      $params = [ 'uid'  => $this->uid,
                  'password'  => strip_tags($password_hash) , ];
      $sql = 'SELECT uid, password, isadmin FROM users WHERE '.
             'uid = :uid AND password = :password';
      $res = $this->dbh->query($sql, $params)[0];
      if ($res)
         $this->authenticated = true;
      else
         throw new Exception('Invalid password');
      // set Admin
      $this->isadmin = filter_var($res['isadmin'], FILTER_VALIDATE_BOOLEAN);
   }

   public function setEmailAddress($email) {
      if ( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
         $params = [ 'uid'  => $this->uid,
                     'email'  => strip_tags($email) , ];
         $sql = "UPDATE users SET email = :email WHERE uid = :uid";
         $this->dbh->execute($sql, $params);
         $this->emailAddress = $email;
      } else
         throw new Exception('Invalid e-mail address');
   }

   public function setPageSize($size) {
      if ($size < 0 || $size > 100)
         throw new Exception('Invalid page size');
      $params = [ 'uid'           => $this->uid,
                  'def_page_size' => $size,
                ];
      $sql = "UPDATE users SET def_page_size = :def_page_size WHERE uid = :uid";
      $this->dbh->execute($sql, $params);
      $this->defaultPageSize = $size;
   }
   public function setPassword($old_password, $new_password) {
      if (strlen($new_password) < 8)
         throw new Exception('New password is too short');
      // Verify the old password
      $old_password_hash = hash('sha256', $old_password);
      $params = [ 'uid'  => $this->uid,
                  'password'  => strip_tags($old_password_hash) , ];
      $sql = 'SELECT uid, password FROM users WHERE
              uid = :uid AND password = :password';
      $res = $this->dbh->query($sql, $params)[0];
      if ($res) {
         // Change password
         $new_password_hash = hash('sha256', $new_password);
         $params = [ 'uid'  => $this->uid,
                     'new_password_hash'  => strip_tags($new_password_hash) , ];
         $sql = "UPDATE users SET password = :new_password_hash WHERE uid = :uid";
         $this->dbh->execute($sql, $params);
      } else
         throw new Exception('Old password is invalid');
   }
}

?>
