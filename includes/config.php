<?php

ob_start();

session_start();

$timezone = date_default_timezone_set("America/Toronto");

try {

  $dbh = new PDO('mysql:host=localhost;dbname=stupefy;charset=utf8', 'root', 'abc123');

} catch (PDOException $e){
  echo 'PDO error: '.$e->getMessage()." <br/>";
  die();
}


 ?>
