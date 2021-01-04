<?php
  class Song{

    private $dbh;
    private $id;
    private $songQueryData;
    private $title;
    private $artistId;
    private $albumId;
    private $genreId;
    private $duration;
    private $path;

    public function __construct($dbh, $id){
      $this->dbh = $dbh;
      $this->id = $id;

      //song query
      $this->songQueryData = $this->dbh->query("SELECT * FROM songs WHERE id='$this->id'")->fetch();

      //set variables
      $this->title = $this->songQueryData['title'];
      $this->artistId = $this->songQueryData['artist'];
      $this->albumId = $this->songQueryData['album'];
      $this->genreId = $this->songQueryData['genre'];
      $this->duration = $this->songQueryData['duration'];
      $this->path = $this->songQueryData['path'];
    }

    public function getTitle(){
      return $this->title;
    }

    public function getArtistId(){
      return $this->artistId;
    }

    public function getArtist(){
      $artist = new Artist($this->dbh, $this->artistId);
      return $artist->getName();
    }

    public function getAlbumId(){
      return $this->albumId;
    }

    public function getGenreId(){
      return $this->genreId;
    }

    public function getGenre(){
      $genre = $this->dbh->query("SELECT name FROM genres WHERE id='$this->genreId'")->fetch();
      return $genre['name'];
    }

    public function getDuration(){
      return $this->duration;
    }

    public function getPath(){
      return $this->path;
    }

    public function getSongQueryData(){
      return $this->songQueryData;
    }


  }


?>
