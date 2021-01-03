<?php
  class Artist{

    private $dbh;
    private $id;

    public function __construct($dbh, $id){
      $this->dbh = $dbh;
      $this->id = $id;
    }

    public function getName(){
      $artist = $this->dbh->query("SELECT name FROM artists WHERE id='$this->id'")->fetch();
      return $artist['name'];
    }

  }


?>
