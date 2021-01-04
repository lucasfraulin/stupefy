<?php include("includes/header.php");

  if(isset($_GET['id'])){
    $album_id = $_GET['id'];
  } else {
    header("Location: index.php");
  }

  $album = new Album($dbh, $album_id);

  $artist = $album->getArtist();



?>


<div class="entityInfo">
  <div class="leftSection ">
    <img src="<?php echo $album->getArtworkPath(); ?>" alt="">
  </div>
  <div class="rightSection ">
    <h2><?php echo $album->getTitle(); ?></h2>
    <p>By: <?php echo $artist->getName(); ?></p>
    <p><?php echo $album->getNumberOfSongs(); ?> songs</p>
  </div>
</div>

<div class="trackListContainer">

  <ul class="tracklist">

    <?php
      $songIds = $album->getSongIds();
      $trackcounter = 1;
      foreach ($songIds as $songId) {

        $albumSong = new Song($dbh, $songId['id']);

        echo "<li class='trackListRow'>

                <div class='trackCount'>
                  <img class='play' src='assets/images/icons/play-white.png'>
                  <span class='trackNumber'>". $trackcounter ."</span>
                </div>

                <div class='trackInfo'>
                  <span class='trackName'>".$albumSong->getTitle()."</span>
                  <span class='trackArtist'>".$artist->getName()."</span>
                </div>

                <div class='trackOptions'>
                  <img class='optionsButton' src='assets/images/icons/more.png'>
                </div>

                <div class='trackDuration'>
                  <span class='duration'>".$albumSong->getDuration()."</span>
                </div>

              </li>";

        $trackcounter++;
      }
     ?>

  </ul>

</div>





<?php include("includes/footer.php"); ?>
