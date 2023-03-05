<?php include("includes/init.php"); ?>
<?php

if(empty($_GET['id'])){
    redirect("comments.php");
}


$comment = Comment::find_by_id($_GET['id']);

if($comment) {
    $comment->delete_comment();
    redirect("user_comments.php");
} else {
    redirect("user_comments.php");
}










?>