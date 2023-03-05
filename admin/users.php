<?php include("includes/header.php"); ?>
<?php if($_SESSION['user_role'] != 'Admin'){
            redirect("user_index.php");
        }; 
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
                        Users
                    </h1>
                    <div class="col-md-12">
                    <a href="add_user.php" class="btn btn-success form-control">CREATE NEW USER</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>USER IMAGE</th>
                                    <th>USERNAME</th>
                                    <th>FIRSTNAME</th>
                                    <th>LASTNAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $users = User::find_all(); ?>
                                   <?php foreach($users as $user): ?>
                                        <tr>
                                            <td><?php echo $user->user_id; ?> </td>
                                            <td><img src="<?php echo $user->user_image() ?>" width='50px' height='50px'/></td>
                                            <td><?php echo $user->user_username; ?></td>
                                            <td><?php echo $user->user_firstname; ?></td>
                                            <td><?php echo $user->user_lastname; ?></td>
                                            <td><a class="btn btn-warning form-control" href="edit_user.php?user_id=<?php echo $user->user_id; ?>">EDIT</a></td>
                                            <td><a class="btn btn-danger form-control" href="delete_user.php?user_id=<?php echo $user->user_id; ?>"> DELETE</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

                                    

  <?php include("includes/footer.php"); ?>