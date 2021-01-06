<?php

  include("../../config.php");

  if(isset($_POST['artistId'])){
    $artistId = $_POST['artistId'];

    $queryData = $dbh->query("SELECT * FROM artists WHERE id='$artistId'")->fetch();

    echo json_encode($queryData);

  }


 ?>
