<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                 <?php   if($_SESSION['user_role'] === 'Admin'){
                   echo  "<li>";
                      echo  "<a href='users.php'><i class='fa fa-fw fa-users'></i> Users</a>";
                    echo "</li>";
                } ?>
                    <li>
                        <a href="upload.php"><i class="fa fa-fw fa-upload"></i> Upload Photo</a>
                    </li>
                <?php   if($_SESSION['user_role'] === 'Admin'){
                   echo  "<li>";
                      echo  "<a href='photos.php'><i class='fa fa-fw fa-users'></i> Photos</a>";
                    echo "</li>";
                } else {
                    echo "<li>";
                    echo "<a href='user_photos.php'><i class='fa fa-fw fa-users'></i> My Photos</a>";
                    echo "<li>";
                }?>
                <?php   if($_SESSION['user_role'] === 'Admin'){
                   echo  "<li>";
                      echo  "<a href='comments.php'><i class='fa fa-fw fa-users'></i> Comments</a>";
                    echo "</li>";
                } else {
                    echo "<li>";
                    echo "<a href='user_comments.php'><i class='fa fa-fw fa-users'></i> My Comments</a>";
                    echo "<li>";
                }?>
                    <!-- DROPDOWN -->
                    <!-- <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>