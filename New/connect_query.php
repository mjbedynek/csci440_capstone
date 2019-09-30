<?php
  function connect_query($sql) { 
    include "config.php";

    $conn = new mysqli($DB[HOST],$DB[USER],$DB[PASS],$DB[NAME]);

    if (mysqli_connect_error()) {
      die("Database connection failed: " . mysqli_connect_error());
    }

    $result = $conn->query($sql);

    $conn->close();

    return $result;
  }
?>
