<?php

//require_once "include/config.php";

class Database {
   private $pdo;
   private $DB = array(
      'HOST' => 'localhost',
      'USER' => 'csci440c_user',
      'PASS' => 'J@_;hYnRyw6J',
      'NAME' => 'csci440c_blog_posts',
   );
   private $PDO_OPTS = [
      PDO::ATTR_EMULATE_PREPARES    => false,
      PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
   ];

   // Setup persistent DB connection within object
   function __construct() {
      try {
         $dsn = "mysql:host=".$this->DB['HOST'].";dbname=".$this->DB[NAME];
         $this->pdo = new PDO($dsn, $this->DB['USER'], $this->DB['PASS'], 
                         $this->PDO_OPTS);
      } catch(PDOException $e) {
         die("ERROR: could not connect" . $e->getMessage());
      }
   }
   
   // Handle queries using prepared statements to prevent SQL injects
   function query($sql, $params) {
      try { 
         $qry = $this->pdo->prepare($sql); 
         $qry->execute($params);
         $res = $qry->fetchall();
      } catch (PDOException $e) {
         die("ERROR: Could not execute query " . $e->getMessage);
      }
      return $res;
   }
   // Insert data into the database
   function execute($sql, $params) {
      try {
         $qry = $this->pdo->prepare($sql);
         $res = $qry->execute($params);
      } catch (PDOExeception $e) {
         die("ERROR: Could not execute insert " . $e->getMessage);
      }
      return $res;
   }

   // PHP do not need a deconstructor but we do this any way
   function __destruct() {
      $this->pdo = null;
   }
}
?>
