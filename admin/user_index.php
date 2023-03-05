<?php include("includes/header.php"); ?>

<?php


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
                        Index
                        <small>Subheading</small>
                    </h1>
            
                    <div class="row">

                     <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-photo fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php 
                                        echo Photo::count_photo($session_id); ?>
                                        </div>
                                        <div>Photos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="user_photos.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Photos in Gallery</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                      <div class="col-lg-6 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Comment::count_comment($session_id); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="user_comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                        </div> <!--First Row-->

                        <div class="row">
                            <div class="col-lg-12 center">
                            <div id="piechart" style="width: 900px; height: 500px;"></div>
                            </div>
                        </div>
                

                </div>
            </div>
            <!-- /.row -->
        </div>
    <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

            <!-- Google Charts   -->
                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Photos',      <?php echo Photo::count_photo($session_id); ?>],
                    ['Comments', <?php echo Comment::count_comment($session_id); ?>]
                    ]);

                    var options = {
                    legend: 'none',
                    pieSliceText: 'label',
                    backgroundColor: 'transparent',
                    title: 'Website activities'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                }
                </script>


  <?php include("includes/footer.php"); ?>