var currentPlaylist = [];
var shufflePlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;

//formatter
function formatTime(seconds){
  var time = Math.round(seconds);
  var min = Math.floor(time/60);
  var sec = time % 60;
  var xtraZero = (sec < 10) ? "0" : "";
  return min + ":" + xtraZero + sec;
}

function updateTimeProgressBar(audio){
  $(".progressTime.current").text(formatTime(audio.currentTime));
  $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

  var progress = audio.currentTime / audio.duration * 100;
  $(".playbackBar .myprogress").css("width", progress + "%");
}

function updateVolumeBar(audio){

  var volume = audio.volume * 100;
  $(".volumeBar .myprogress").css("width", volume + "%");
}

//audio class
function Audio(){

  this.currentlyPlaying; //currently playing song
  this.audio = document.createElement('audio'); //audio object

  this.audio.addEventListener("ended", function(){
    nextSong();
  })

  this.audio.addEventListener("canplay", function(){
    //this is refering to the audio object since it was called on the audio object
    //not referring to the instance of the class
    var dur = formatTime(this.duration);
    $(".progressTime.remaining").text(dur);
  });

  this.audio.addEventListener("timeupdate", function(){
    if(this.duration){
      //this is refering to the audio object since it was called on the audio object
      //not referring to the instance of the class
      updateTimeProgressBar(this);
    }
  });

  this.audio.addEventListener("volumechange", function(){
    updateVolumeBar(this);
  });

  this.setTrack = function(track){
    this.currentlyPlaying = track;
    this.audio.src = track.path;
  }

  this.play = function() {
    this.audio.play();
  }

  this.pause = function(){
    this.audio.pause();
  }

  this.setTime = function(seconds){
    this.audio.currentTime = seconds;
  }

}
