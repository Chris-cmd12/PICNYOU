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
                        Photos
                    </h1>

                    <div class="col-md-12">
                    <a href="upload.php" class="btn btn-success form-control">UPLOAD A PHOTO</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $photos = Photo::find_all(); ?>
                                   <?php foreach($photos as $photo): ?>
                                        <tr>
                                            <td><?php echo $photo->photo_id; ?> </td>
                                            <td>
                                                <img src="<?php echo $photo->picture_path(); ?>" width='50px' height='50px'/>
                                            </td>
                                            <td><?php echo $photo->photo_title; ?></td>
                                            <td><a href='../photo_view.php?id=<?php echo $photo->photo_id; ?>'>
                                            <?php 
                                            
                                            $comments = Comment::find_the_comment($photo->photo_id);
                                            echo count($comments);
                                            
                                            ?>
                                            </a>
                                            </td>
                                            <td><a class="btn btn-info form-control" href='../photo_view.php?id=<?php echo $photo->photo_id; ?>'> View</a></td>
                                            <td><a class="btn btn-warning form-control" href="edit_photo.php?photo_id=<?php echo $photo->photo_id; ?>"> Edit</a></td>
                                            <td><a class="btn btn-danger form-control" href="delete_photo.php?photo_id=<?php echo $photo->photo_id; ?>"> Delete</a></td>
                                            </a>
                                            </td>
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