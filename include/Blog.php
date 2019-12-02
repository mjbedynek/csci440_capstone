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
   function deletePost($postID) {
      #echo "postid: $postID<Br>";
      // Ensure $postID is an Integer
      if (!is_int($postID) && $postID > 0)
         return;
      $params = [
         'pid'  => $postID,
         ];
      $sql = 'DELETE FROM posts WHERE pid = :pid';
      $this->dbh->execute($sql, $params);
   }
   function getPost($postID) {
      // Ensure $postID is an Integer
      if (!is_int($postID))
         return;
      $params = [
         'pid'  => $postID,
         ];
      $sql = 'SELECT pid, authorid, title, body, postdatetime, displayname FROM posts
              LEFT JOIN users ON posts.authorid = users.uid WHERE posts.pid = :pid';
      $res = $this->dbh->query($sql, $params)[0];
      return $res;
   }
   function getLatestPost() {
      // No need to parameterize... no user input sent to DB
      $sql = 'SELECT pid, authorid, title, body, postdatetime, displayname FROM posts
              LEFT JOIN users ON posts.authorid = users.uid
              ORDER BY postdatetime DESC LIMIT 1';
      $res = $this->dbh->query($sql, null)[0];
      return $res;
   }

   function getPage($page, $results_per_page) {
      // Ensure $page and $results_per_page are Integers
      if (!is_int($page) && !is_int($results_per_page))
         return;
      // No need to parameterize... no user input sent to DB
      $start_from = ($page - 1) * $results_per_page;
      $params = [
         'start_from'  => $start_from,
         'results_per_page'   => $results_per_page,
         ];
      $sql = 'SELECT posts.pid, authorid, title, body, postdatetime, displayname FROM posts
              LEFT JOIN users ON posts.authorid = users.uid
              ORDER BY postdatetime DESC LIMIT :start_from,:results_per_page';
      $res = $this->dbh->query($sql, $params);
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
      $this->dbh->execute($sql, $params);
   }
   function updatePost(&$pid, &$title, &$body) {
      // Parameterize data
      $params = [
         'pid'       => $pid,
         'title'     => $title,
         'body'      => $body,
         ];
      $sql = "UPDATE posts SET title = :title, body = :body WHERE pid = :pid";
      $this->dbh->execute($sql, $params);
   }
}

?>
