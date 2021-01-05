var currentPlaylist = [];
var audioElement;


//audio class
function Audio(){

  this.currentlyPlaying; //currently playing song
  this.audio = document.createElement('audio'); //audio object

  this.setTrack = function(src){
    this.audio.src = src;
  }

  this.play = function() {
    this.audio.play();
  }

  this.pause = function(){
    this.audio.pause();
  }

}
