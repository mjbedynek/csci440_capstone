<?php

require_once "Database.php";

class User {

   // Instance variables
   private $dbh;
   private $authenticated;
   private $id;
   private $username;
   private $lastlogin;
   private $isadmin;

   // Constructor
   function __construct($username, $password) {
      // Open a connection to the DB
      $this->dbh = new Database();
      // Parameterize query - prevent SQL injection
      // Also use strip tags to remove html from username and password
      $password_hash = hash('sha256', $password);
      $params = [ 'username'  => strip_tags($username),
                  'password'  => strip_tags($password_hash) , ];
      $sql = 'SELECT id, username, isadmin FROM users WHERE '.
             'username = :username AND password = :password';
      $res = $this->dbh->query($sql, $params)[0];

      // If we get any results then the username is valid
      if ($res) {
         // Store instance vars for obj
         $this->id = $res['id'];
         $this->username = $res['username'];
         $this->lastlogin = $res['lastlogin'];
         // Recast string value to boolean
         $this->isadmin = filter_var($res['isadmin'], FILTER_VALIDATE_BOOLEAN);
         $this->authenticated = true;
      }
   }

   // Return id (from DB)
   public function getID() {
      return $this->id;
   }

   // Return username for object
   public function getUserName() {
      return $this->username;
   }

   // Return if user is admin
   public function isAdmin() {
      return $this->isadmin;
   }

   public function isAuthenticated() {
      return $this->authenticated;
   }

   // Change the user's password
   //public function setPassword() {
   //}
}

?>
