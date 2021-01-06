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
    updateVolumeBar(audioElement.audio);

/*   progress bar dragging   */
    $(".playbackBar .progressBar").mousedown(function(){
      mouseDown = true;
    });

    $(".playbackBar .progressBar").mousemove(function(e){
      if(mouseDown == true){
        //set time of song depending on position of mouse
        timeFromOffset(e, this);
      }
    });

    $(".playbackBar .progressBar").mouseup(function(e){
      //set time of song depending on position of mouse
      timeFromOffset(e, this);
    });


/*   volume bar dragging   */
    $(".volumeBar .progressBar").mousedown(function(){
      mouseDown = true;
    });

    $(".volumeBar .progressBar").mousemove(function(e){
      if(mouseDown == true){

        var percentage = e.offsetX / $(this).width();

        if(percentage >= 0 && percentage <=1){
          audioElement.audio.volume = percentage;
        }
      }

    });

    $(".volumeBar .progressBar").mouseup(function(e){

      var percentage = e.offsetX / $(this).width();

      if(percentage >= 0 && percentage <=1){
        audioElement.audio.volume = percentage;
      }

    });


    $(document).mouseup(function(){
      mouseDown = false;
    });


  });

  function timeFromOffset(mouse, progressBar){
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage/100);
    audioElement.setTime(seconds);
  }

  function setTrack(trackId, newPlaylist, play){

    //ajax call with callback function to get song
    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data){

      var track = JSON.parse(data);   //  parse json for track object
      $(".trackName span").text(track.title);

      //ajax call to get artist object
      $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(artistdata){

        var artist = JSON.parse(artistdata);
        $(".artistName span").text(artist.name);

      });

      $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(albumdata){

        var album = JSON.parse(albumdata);
        $(".albumLink img").attr("src", album.artworkPath);

      });

      audioElement.setTrack(track);
      console.log(audioElement);
    });

    if (play == true){
      audioElement.play();
    }

  };


  function playSong(){

    //update plays
    if(audioElement.audio.currentTime == 0){
      $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
    }

    //show and hide pause/play
    $(".control-button.play").hide();
    $(".control-button.pause").show();
    audioElement.play();

  };

  function pauseSong(){

    $(".control-button.pause").hide();
    $(".control-button.play").show();
    audioElement.pause();

  };

</script>



<div id="nowPlayingContainerBar" class="container-fluid">
  <div id="nowPlayingBar" class="row ">

    <div id="nowPlayingLeft" class="col">

      <div class="content">
        <span class="albumLink">
          <img src="" alt="" class="album-footer-img">
        </span>

        <div class="trackInfo container-fluid">
          <span class="trackName row">
            <span></span>
          </span>
          <span class="artistName row">
            <span></span>
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

          <div class="" style="width:50px; padding: 0; margin: 0;">
            <span class="progressTime current">0.00</span>
          </div>

          <div class="progressBar">
            <div class="progressBarBg">
              <div class="myprogress"></div>
            </div>
          </div>

          <div class="" style="width:50px; padding: 0; margin: 0;">
            <span class="progressTime remaining">0.00</span>
          </div>

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
