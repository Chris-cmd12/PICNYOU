<?php include("includes/init.php"); ?>
<?php

if(empty($_GET['user_id'])){
    redirect("users.php");
}


$user = User::find_by_id($_GET['user_id']);

if($user) {
    $user->delete();
    redirect("users.php");
} else {
    redirect("users.php");
}










?>