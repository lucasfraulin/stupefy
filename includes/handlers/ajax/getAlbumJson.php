<?php

  include("../../config.php");

  if(isset($_POST['albumId'])){
    $albumId = $_POST['albumId'];

    $queryData = $dbh->query("SELECT * FROM albums WHERE id='$albumId'")->fetch();

    echo json_encode($queryData);

  }


 ?>
