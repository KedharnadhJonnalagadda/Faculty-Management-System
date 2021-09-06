<?php
//$link = mysqli_connect("localhost:3307", "root", "", "fms") or die (mysql_error());
;
try {
    $conn = new PDO('mysql:host=localhost:3307;dbname=fms', 'root', '');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>