<?php

$songQuery = $dbh->query("SELECT id FROM songs ORDER BY RAND() LIMIT 10")->fetchAll();

$resultArray = array();
foreach ($songQuery as $song) {
  array_push($resultArray, $song['id']);
}

$jsonArray = json_encode($resultArray);

?>

<script type="text/javascript">

  $(document).ready(function(){

    currentPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);

  });

  function setTrack(trackId, newPlaylist, play){

    //ajax call with callback function
    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data){

      var track = JSON.parse(data);

      console.log(track);
      audioElement.setTrack(track.path);

    });

    if (play == true){
      audioElement.play();
    }

  };


  function playSong(){
    audioElement.play();
    $(".control-button.play").hide();
    $(".control-button.pause").show();
  };

  function pauseSong(){
    audioElement.pause();
    $(".control-button.pause").hide();
    $(".control-button.play").show();
  };

</script>



<div id="nowPlayingContainerBar" class="container-fluid">
  <div id="nowPlayingBar" class="row ">

    <div id="nowPlayingLeft" class="col">

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

    <div id="nowPlayingCenter" class="col-5">

      <div class="content player-controls">

        <div class="buttons">
          <button class="control-button shuffle" title="shuffle button">
            <img src="assets/images/icons/shuffle.png" alt="Shuffle">
          </button>
          <button class="control-button previous" title="previous button">
            <img src="assets/images/icons/previous.png" alt="previous">
          </button>
          <button class="control-button play" title="play button" onclick="playSong()">
            <img src="assets/images/icons/play.png" alt="play">
          </button>
          <button class="control-button pause" title="pause button" onclick="pauseSong()" style="display:none;">
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

    <div id="nowPlayingRight" class="col">
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
