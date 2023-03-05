<?php include("includes/header.php"); ?>
<?php if($_SESSION['user_role'] != 'Admin'){
            redirect("user_index.php");
        }; 
?>

<?php
$message = "";
if(isset($_POST['create'])){
$user = new User();
$user->user_username = $_POST['username'];
$user->user_password = $_POST['password'];
$user->user_password = password_hash($user->user_password, PASSWORD_BCRYPT, array('cost' => 10));
$user->user_role = $_POST['user_role'];
$user->user_firstname = $_POST['first_name'];
$user->user_lastname = $_POST['last_name'];
$user->set_file($_FILES['user_image']);
$user->upload_user_image();

if($user->save()){
    $message = "User created.<a href='users.php'>SEE ALL USERS </a>";
} else {
    $message = join("<br>", $user->errors);
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
                        <small>CREATE NEW USER</small>
                    </h1>
                        <div class="col-lg-6">
                        <?php echo $message; ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="user_role" class="form-control" required>
                                        <option value="">Select a role...</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="user_image">User Image</label>
                                    <input type="file" name="user_image" class="form-control"></input>
                                </div>
                                    <input class="btn btn-success " type="submit" name="create" value="CREATE"></input>
                                    
                            </form>
                        </div>
                </div>
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>