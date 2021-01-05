function Audio(){

  this.currentlyPlaying; //currently playing song
  this.audio = document.createElement('audio'); //audio object

  this.setTrack = function(src){
    this.audio.src = src;
  }

}
