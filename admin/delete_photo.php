<?php include("includes/init.php"); ?>
<?php

if(empty($_GET['photo_id'])){
    redirect("photos.php");
}


$photo = Photo::find_by_id($_GET['photo_id']);

if($photo) {
    $photo->delete();
    redirect("photos.php");
} else {
    redirect("photos.php");
}










?>