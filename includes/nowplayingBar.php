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

    var newPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);
    updateVolumeBar(audioElement.audio);

    //prevent highlighting while dragging
    $("#nowPlayingContainerBar").on("mousedown touchstart mousemove touchmove", function(e){
      e.preventDefault();
    });


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


  function prevSong(){

    if(audioElement.audio.currentTime >=3 || currentIndex == 0){
      audioElement.setTime(0);
    } else {
      currentIndex--;
      setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }

  }


  function nextSong(){

    if (repeat == true){
      audioElement.setTime(0);
      playSong();
      return;
    }

    if (currentIndex == currentPlaylist.length - 1){
      currentIndex = 0;
    } else {
      currentIndex++;
    }

    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);

  }


  function setRepeat(){

    repeat = !repeat; //toggle repeat
    let imageName = repeat ? "assets/images/icons/repeat-active.png" : "assets/images/icons/repeat.png";
    $(".control-button.repeat img").attr("src", imageName);

  }

  function setMute(){

    audioElement.audio.muted = !audioElement.audio.muted; //toggle mute
    let imageName = audioElement.audio.muted ? "assets/images/icons/volume-mute.png" : "assets/images/icons/volume.png";
    $(".control-button.volume img").attr("src", imageName);

  }

  function setShuffle(){

    shuffle = !shuffle; //toggle mute
    let imageName = shuffle ? "assets/images/icons/shuffle-active.png" : "assets/images/icons/shuffle.png";
    $(".control-button.shuffle img").attr("src", imageName);

    if(shuffle == true){
      //randomize playlist order
      shufflePlaylist = shuffleArray(shufflePlaylist);
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    } else {
      //revert to normal playlist order
      currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }

  }

  //helper for setShuffle
  function shuffleArray(array) {
    var curIndex = array.length, temp, ranIndex;

    // While there remain elements to shuffle...
    while (0 !== curIndex) {

      // Pick a remaining element...
      ranIndex = Math.floor(Math.random() * curIndex);
      curIndex -= 1;

      // And swap it with the current element.
      temp = array[curIndex];
      array[curIndex] = array[ranIndex];
      array[ranIndex] = temp;
    }

    return array;
  }


  function setTrack(trackId, newPlaylist, play){

    if (newPlaylist != currentPlaylist){
      currentPlaylist = newPlaylist;
      shufflePlaylist = currentPlaylist.slice();
      shufflePlaylist = shuffleArray(shufflePlaylist);
    }

    if(shuffle == true){
      currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
      currentIndex = currentPlaylist.indexOf(trackId);
    }

    pauseSong();

    //ajax call with callback function to get song
    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data){

      var track = JSON.parse(data);   //  parse json for track object
      $(".trackName span").text(track.title);

      //ajax call to get artist object
      $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(artistdata){
        console.log(artistdata);
        var artist = JSON.parse(artistdata);
        $(".artistName span").text(artist.name);

      });

      $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(albumdata){

        var album = JSON.parse(albumdata);
        $(".albumLink img").attr("src", album.artworkPath);

      });

      audioElement.setTrack(track);

      //ajax call was asynchronous so this play call needed to be inside the block
      if (play == true){
        playSong();
      }
    });

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
          <button class="control-button shuffle" title="shuffle button" onclick="setShuffle()">
            <img src="assets/images/icons/shuffle.png" alt="Shuffle">
          </button>
          <button class="control-button previous" title="previous button" onclick="prevSong()">
            <img src="assets/images/icons/previous.png" alt="previous">
          </button>
          <button class="control-button play" title="play button" onclick="playSong()">
            <img src="assets/images/icons/play.png" alt="play">
          </button>
          <button class="control-button pause" title="pause button" onclick="pauseSong()" style="display:none;">
            <img src="assets/images/icons/pause.png" alt="pause">
          </button>
          <button class="control-button next" title="next button" onclick="nextSong()">
            <img src="assets/images/icons/next.png" alt="next">
          </button>
          <button class="control-button repeat" title="repeat button" onclick="setRepeat()">
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

        <button class="control-button volume" onclick="setMute()">
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
