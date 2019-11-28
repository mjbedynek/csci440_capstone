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

   function getPage($page, $results_per_page) {
      // No need to parameterize... no user input sent to DB
      $start_from = ($page - 1) * $results_per_page;
      $sql = 'SELECT title, body, postdatetime, displayname FROM posts
              LEFT JOIN users ON posts.authorid = users.id
              ORDER BY postdatetime DESC LIMIT '.$start_from.','.$results_per_page;
      $res = $this->dbh->query($sql, null);
      return $res;
   }
   function newPost(&$authorid, &$title, &$body) {
      // Parameterize data
      $params = [
         'authorid'  => $authorid,
         'title'     => $title,
         'body'      => $body,
         ];
      $sql = "INSERT INTO posts (authorid, title, body) VALUES (:authorid, :title, :body)";
      $this->dbh->insert($sql, $params);
   }
}

?>
