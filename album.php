<?php include("includes/header.php");

  if(isset($_GET['id'])){
    $album_id = $_GET['id'];
  } else {
    header("Location: index.php");
  }

  $album = new Album($dbh, $album_id);

  $artist = $album->getArtist();



?>


<div class="entityInfo row">
  <div class="leftSection col-4">
    <img src="<?php echo $album->getArtworkPath(); ?>" alt="">
  </div>
  <div class="rightSection col-8">
    <h2><?php echo $album->getTitle(); ?></h2>
    <p><?php echo $artist->getName(); ?></p>
  </div>
</div>






<?php include("includes/footer.php"); ?>
