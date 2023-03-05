<?php include("includes/header.php"); ?>

<?php
$message = "";
if(isset($_POST['submit'])){
    $photo = new Photo();
    $photo->photo_title = $_POST['title'];
    $photo->set_file($_FILES['file_upload']);
    $photo->photo_u_id = $_SESSION['user_id'];

    if($photo->save()){
        $message = "Photo uploaded";
    } else {
        $message = join("<br>", $photo->errors);
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
                        Upload
                    </h1>
                        <div class="col-lg-6">
                        <?php echo $message; ?>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="title">File</label>
                                    <input class="form-control" type="file" name="file_upload"></input>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" name="submit" value="SUBMIT"></input>
                                    <a href="photos.php" class="btn btn-danger " >RETURN</a>
                                </div>
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