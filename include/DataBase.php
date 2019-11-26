<?php

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
      PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
   ];

   // Setup persistent DB connection within object
   function __construct() {
      //echo $this->DB['USER'];
      try {
         $dsn = "mysql:host=".$this->DB['HOST'].";dbname=".$this->DB[NAME];
         $this->pdo = new PDO($dsn, $this->DB['USER'], $this->DB['PASS'],
                         $this->PDO_OPTS);
      } catch(PDOException $e) {
         die("ERROR: could not connect" . $e->getMessage());
      }
   }

   // Handle queries using fetchall.  This returns an array of hashes.
   function query($sql) {
      try {
         $qry = $this->pdo->query($sql);
         $res = $qry->fetchall();
      } catch (PDOException $e) {
         die("ERROR: Could not execute query " . $e->getMessage);
      }
      return $res;
   }
   // Insert data into the database
   function insert($sql, $params) {
      try {
         $qry = $this->pdo->prepare($sql);
         $res = $qry->execute($params);
      } catch (PDOExeception $e) {
         die("ERROR: Could not execute insert " . $e->getMessage);
      }
      return $res;
   }

   // PHP does this anyway but lets be clean with our code
   function __destruct() {
      $this->pdo = null;
   }
}
?>
