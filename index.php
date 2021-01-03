<?php include("includes/header.php"); ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">


    <?php

      $albumQuery = $dbh->query("SELECT * FROM albums LIMIT 10")->fetchAll();

      foreach ($albumQuery as $row) {

        echo "<div class='gridViewItem'>
                <a href='album.php?id=".$row['id']."'>
                <img class='' src='".$row['artworkPath']."'>
              "."
              <div class='gridViewInfo'>".$row['title']." </div>
              </a>
            </div>";
      }

     ?>



</div>

<?php include("includes/footer.php"); ?>
