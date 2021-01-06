<?php

  include("../../config.php");

  if(isset($_POST['songId'])){
    $songId = $_POST['songId'];

    $dbh->query("UPDATE songs SET plays=plays + 1 WHERE id='$songId'");

  }


 ?>
