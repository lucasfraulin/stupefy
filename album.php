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

        $albumSong = new Song($dbh, $songId);

        echo "<li class='trackListRow'>

                <div class='trackCount'>
                  <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                  <span class='trackNumber'>". $trackcounter ."</span>
                </div>

                <div class='trackInfo'>
                  <span class='trackName'>".$albumSong->getTitle()."</span>
                  <span class='trackArtist'>".$albumSong->getArtist()."</span>
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

     <script>
			var tempSongIds = '<?php echo json_encode($songIds); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
      console.log(tempPlaylist);
		</script>


  </ul>

</div>





<?php include("includes/footer.php"); ?>
