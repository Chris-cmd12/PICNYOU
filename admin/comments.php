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
                        Comments
                        <small>Subheading</small>
                    </h1>
       

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Body</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $comments = Comment::find_all(); ?>
                                   <?php foreach($comments as $comment): ?>
                                            <tr>
                                                <td><?php echo $comment->comment_id; ?> </td>
                                                <td><?php echo $comment->comment_author; ?></td>
                                            <td>
                                                <?php echo $comment->comment_body; ?>
                                            </td>
                                            <td><a class="btn btn-info form-control" href='../photo_view.php?id=<?php echo $comment->comment_p_id; ?>'> VIEW</a></td>
                                            <td><a class="btn btn-danger form-control" href="delete_comment.php?id=<?php echo $comment->comment_id; ?>"> DELETE</a></td>

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