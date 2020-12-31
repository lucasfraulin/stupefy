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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Eagle+Lake&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">

</head>
<body>

  <div id="mainContainer" class="">

    <!--top container -->
    <div id="topContainer" >

        <!--navbar container -->
        <div id="navbarContainer" class="vh-100">

          <nav class="navBar">

            <a href="index.php" class="logo">
              <img src="assets/images/houses/slytherin.png" style="height: 100px; width: 100px;" alt="logo">
            </a>

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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
