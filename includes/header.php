<?php
  include("includes/config.php");
  include("includes/classes/Artist.php");
  include("includes/classes/Album.php");
  include("includes/classes/Song.php");

  if (isset($_SESSION['userLoggedIn'])){
    $user = $_SESSION['userLoggedIn'];
  } else {
    header("Location: register.php");
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stupefy</title>

    <!--bootstrap 5 cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- css styling -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Eagle+Lake&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <!-- jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--including js files that use jquery so must come after -->
    <script type="text/javascript" src="assets/js/script.js"></script>



</head>
<body>

  <!-- <script type="text/javascript">

    // var audioElement = new Audio();
    // audioElement.setTrack("assets/music/bensound-goinghigher.mp3");
    // audioElement.audio.play();

  </script> -->

  <div id="mainContainer">

    <!--top container -->
    <div id="topContainer" >

        <!--navbar container -->
        <?php include("includes/navbarContainer.php"); ?>

        <!--main container-->
        <div id="mainViewContainer">
          <div id="mainContent">
