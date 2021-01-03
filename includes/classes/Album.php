<?php
  class Album{

    private $dbh;
    private $id;
    private $title;
    private $artistId;
    private $artworkPath;
    private $genreId;

    public function __construct($dbh, $id){
      $this->dbh = $dbh;
      $this->id = $id;

      //album query
      $album = $this->dbh->query("SELECT * FROM albums WHERE id='$this->id'")->fetch();

      //set album fields
      $this->title = $album['title'];
      $this->artistId = $album['artist'];
      $this->artworkPath = $album['artworkPath'];
      $this->genreId = $album['genre'];

    }

    public function getTitle(){
      return $this->title;
    }

    public function getArtworkPath(){
      return $this->artworkPath;
    }

    public function getArtistId(){
      return $this->artistId;
    }

    public function getArtist(){
      return new Artist($this->dbh, $this->artistId);
    }

    public function getGenreId(){
      return $this->genreId;
    }

    public function getGenre(){
      $genre = $this->dbh->query("SELECT name FROM genres WHERE id='$this->id'")->fetch();
      return $genre['name'];
    }

  }


?>
