<?php

  include("../../config.php");

  if(isset($_POST['songId'])){
    $songId = $_POST['songId'];

    $queryData = $dbh->query("SELECT * FROM songs WHERE id='$songId'")->fetch();

    echo json_encode($queryData);

  }


 ?>
