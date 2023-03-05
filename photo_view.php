<?php include("includes/header.php"); ?>

<?php 

if(empty($_GET['id'])){
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])){
    $comment = new Comment();
    $comment->comment_u_id = $_SESSION['user_id'];
    $comment->comment_p_id = $_GET['id'];
    $comment->comment_author = $_SESSION['user_username'];
    $comment->comment_body = trim($_POST['comment_body']);

    if($comment->save()){
      $message = "";
  } else {
      $message = "";
  }
}

?>
    <!-- MAIN -->
    <main>
      <!-- SECTION HERO -->
      <section class="photo-section">
        <div class="photo-grid">
          <div class="photo-box">
            <h3 class="photo-title"><?php echo $photo->photo_title ?></h3>
            <img class="photo-properties" src="admin/images/<?php echo $photo->photo_filename ?>" alt="">
            <?php
            $sql = "SELECT user_username FROM users LEFT JOIN photos ON photos.photo_u_id = users.user_id WHERE photo_u_id = user_id";
            $authors = User::find_by_query($sql);
            foreach($authors as $user){
              $author = $user->user_username;
            }
            ?>
            <h3 class="photo-author">Author : <?php echo $author ?></h3>
          </div>
          <div class="photo-comment-box">
            <?php if(isset($_SESSION['user_id'])): ?>
            <form class="center" action="" method="post">
              <textarea class="custom-tarea" name="comment_body" id="" cols="70" rows="2"></textarea>
              <input type="submit" name="submit" value="Add comment &plus;" class="btn btn-comment">
            </form>
            <?php else: ?>
              <h3 class="text-center">Sorry, You have to be logged in to post a message.</h3>
            <?php endif ?>
            <?php $comments = Comment::find_the_comment($photo->photo_id); ?>
            <?php if(!empty($comments)): ?>
              <?php foreach($comments as $comment): ?>
                    <div class="comment">
                      <div class="comment-profile">
                        <h4 class="comment-author"><?php echo strtoupper($comment->comment_author); ?></h4>
                        <?php 
                        $sql2 = "SELECT user_image FROM users LEFT JOIN comments ON comments.comment_u_id = users.user_id WHERE {$comment->comment_u_id} = user_id";
                        $image = User::find_by_query($sql2);
                        ?>
                        <?php foreach($image as $user){
                          $user_image = $user->user_image;
                        }?>
                        <img class="comment-image" src="admin/images/<?php echo $user_image ?>" alt="">
                      </div>
                      <div class="comment-user">
                        <p> <?php echo $comment->comment_body; ?> </p>
                      </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
