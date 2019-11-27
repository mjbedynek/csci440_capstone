<?php

require_once "Database.php";

class Blog {
   // Instance variables
   private $dbh;

   // Constructor
   function __construct() {
      // Open a connection to the DB
      $this->dbh = new Database();
   }
   function getMostRecentPost() {
      // No need to parameterize... no user input sent to DB
      $sql = 'SELECT title, body, postdatetime, displayname FROM posts
              LEFT JOIN users ON posts.authorid = users.id
              ORDER BY postdatetime DESC LIMIT 1';
      $res = $this->dbh->query($sql, null)[0];
      return $res;
   }
}

?>
