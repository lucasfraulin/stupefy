<?php
  include("includes/config.php");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Eagle+Lake&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

</head>
<body>

  <div id="mainContainer" class="">

    <!--top container -->
    <div id="topContainer" >

        <!--navbar container -->
        <div id="navbarContainer" class="vh-100">

          <nav class="navBar">

            <a href="index.php" >
              <img src="assets/images/houses/sorting-hat.png" class="logo" alt="logo">
            </a>

            <form class="d-flex input-group searchbarGroup">
              <input class="form-control bg-transparent searchBar" type="search" spellcheck="false" placeholder="Search" aria-label="Search">
              <a href="search.php" class="input-group-text btn searchIcon" type="submit"><i class="fas fa-search"></i></a>
            </form>


            <ul class="navbar-nav mt-3">
              <li class="nav-item">
                <a href="browse.php" class="nav-link">Browse</a>
              </li>
              <li class="nav-item">
                <a href="yourmusic.php" class="nav-link">Your Music</a>
              </li>
              <li class="nav-item">
                <a href="profile.php" class="nav-link">Profile</a>
              </li>
            </ul>

          </nav>

        </div>

    </div>


    <!-- footer bar -->
    <div id="nowPlayingContainerBar" class="container-fluid">
      <div id="nowPlayingBar" class="row ">

        <div id="nowPlayingLeft" class="col-4">

          <div class="content">
            <span class="albumLink">
              <img src="assets/images/square.png" alt="" class="album-footer-img">
            </span>

            <div class="trackInfo container-fluid">
              <span class="trackName row">
                <span>Do The Hippogriff</span>
              </span>
              <span class="artistName row">
                <span>Weird Sisters</span>
              </span>
            </div>

          </div>

        </div>

        <div id="nowPlayingCenter" class="col-4">

          <div class="content player-controls">

            <div class="buttons">
              <button class="control-button shuffle" title="shuffle button">
                <img src="assets/images/icons/shuffle.png" alt="Shuffle">
              </button>
              <button class="control-button previous" title="previous button">
                <img src="assets/images/icons/previous.png" alt="previous">
              </button>
              <button class="control-button play" title="play button">
                <img src="assets/images/icons/play.png" alt="play">
              </button>
              <button class="control-button pause" title="pause button" style="display:none;">
                <img src="assets/images/icons/pause.png" alt="pause">
              </button>
              <button class="control-button next" title="next button">
                <img src="assets/images/icons/next.png" alt="next">
              </button>
              <button class="control-button repeat" title="repeat button">
                <img src="assets/images/icons/repeat.png" alt="repeat">
              </button>
            </div>

            <div class="playbackBar">
              <span class="progressTime current">0.00</span>

              <div class="progressBar">
                <div class="progressBarBg">
                  <div class="myprogress"></div>
                </div>
              </div>

              <span class="progressTime remaining">0.00</span>
            </div>

          </div>

        </div>

        <div id="nowPlayingRight" class="col-4">
          <div class="volumeBar">

            <button class="control-button volume">
              <img src="assets/images/icons/volume.png" alt="">
            </button>

            <div class="progressBar">
              <div class="progressBarBg">
                <div class="myprogress"></div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>
