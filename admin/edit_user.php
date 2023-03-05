<?php include("includes/header.php"); ?>
<?php if($_SESSION['user_id'] != $_GET['user_id'] && $_SESSION['user_role'] != 'Admin'){
    redirect("user_index.php");
}  
?>


?>



<?php
$message = "";
if(empty($_GET['user_id'])){
    redirect ("users.php");
} else {
    $user = User::find_by_id($_GET['user_id']);

    $db_password = $user->user_password;

    if(isset($_POST['update'])){
        if($user){
            $user->user_username = $_POST['username'];
            $user->user_password = $_POST['password'];
            $user->user_firstname = $_POST['first_name'];
            $user->user_lastname = $_POST['last_name'];

            if(empty($user->user_password)){
                $user->user_password = $db_password;
            } else {
                $user->user_password = password_hash($user->user_password, PASSWORD_BCRYPT, array('cost' => 10));
            }

            $user->set_file($_FILES['user_image']);
            $user->upload_user_image();
            if($user->save()){
                $message = "User edited.<a href='users.php'>RETURN TO USERS</a>";
            } else {
                $message = join("<br>", $user->errors);
            }
        }
    }
}

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php") ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/sidebar_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <small>Edit the user</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-lg-8">
                        <?php echo $message ?>
                        <div class="form-group">
                        <label for="title">Title</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->user_username ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="*********">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->user_firstname ?>">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input class="form-control" name="last_name" value="<?php echo $user->user_lastname ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_image">Update Image</label>
                                <input type="file" name="user_image" class="form-control">
                            </div>
                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                        </div>
                    </div>
                
                    <?php if($_SESSION['user_role'] === "User"):?>
                        <div class="col-md-4 center" >
                            <img src="<?php echo $user->user_image(); ?> " width="400px" height="300px" alt="">
                        </div>
                    <?php elseif($_SESSION['user_role'] === "Admin"): ?>
                    <div class="col-md-4" >
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                    <h4> USER DETAILS</h4>
                                    </div>
                                <div class="inside">
                                <div class="box-inner">
                                <div class="thumbnail" href=""> <img src="<?php echo $user->user_image(); ?> " width="400px" height="300px" alt=""></div>
                                    <p class="text ">
                                        USER ID: <span class="data photo_id_box"><?php echo $user->user_id ?></span>
                                    </p>
                                    <p class="text">
                                        USER ROLE: <span class="data"><?php echo $user->user_role ?></span>
                                    </p>
                                    <p class="text">
                                    USERNAME: <span class="data"><?php echo $user->user_username ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a  href='delete_user.php?user_id=<?php echo $user->user_id; ?>' class="btn btn-danger btn-lg">Delete</a>   
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                </div>
                                </div>          
                            </div>
                        </div>
                    <?php endif ?>
                        </form>
                    </div>
                </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>