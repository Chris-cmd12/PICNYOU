<?php include("includes/header.php"); ?>
<?php 
if(isset($_GET['photo_id'])){
    $photo = Photo::find_by_id($_GET['photo_id']);
    if($photo->photo_u_id != $_SESSION['user_id'] && $_SESSION['user_role'] != 'Admin'){
        redirect("user_index.php");
    }
}

  
?>


<?php

if(empty($_GET['photo_id'])){
    if($_SESSION['user_role'] === "Admin"){
        redirect ("photos.php");
    } else {
        redirect("user_photo.php");
    }

} else {
    $photo = Photo::find_by_id($_GET['photo_id']);

    if(isset($_POST['update'])){       
        if($photo) {     
            $photo->photo_title = $_POST['title'];
            $photo->set_file($_FILES['filename']);
            $photo->upload_photo();
            $photo->save();
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
                        Photos
                        <small>Subheading</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="form-group">
                        <label for="caption">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->photo_title ?>">
                        </div>
                        <div class="form-group">
                        <label for="caption">Change your image</label>
                            <input type="file" name="filename" class="form-control" >
                           <a class="thumbnail" href=""> <img src="<?php echo $photo->picture_path(); ?> " width="300px" height="300px" alt=""></a>
                        </div>
                    </div>
                
                    <div class="col-md-4" >
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                    <h4>&nbsp; PHOTO DETAILS </h4>
                                    </div>
                                <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        FILENAME: <span class="data"><?php echo $photo->photo_filename ?></span>
                                    </p>
                                    <p class="text">
                                    FILE TYPE: <span class="data"><?php echo $photo->photo_type ?></span>
                                    </p>
                                    <p class="text">
                                    FILE SIZE: <span class="data"><?php echo $photo->photo_size ?> byte</span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a  href='delete_photo.php?photo_id=<?php echo $photo->photo_id; ?>' class="btn btn-danger btn-lg">Delete</a>   
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                </div>
                                </div>          
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>