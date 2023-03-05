<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
                if($_SESSION['user_role'] === 'Admin'){
                  echo "<a class='navbar-brand' href='index.php'>DASHBOARD</a>";
                } else {
                  echo "<a class='navbar-brand' href='user_index.php'>DASHBOARD</a>";
                }
                ?>
            </div>
            
            <!-- Top Menu Items -->

            <ul class="nav navbar-right top-nav">
            <li>
                <a href="../index.php"><i class="fa fa-fw fa-home"></i>Home page</a>
            </li>
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome <?php echo $_SESSION['user_firstname'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="edit_user.php?user_id=<?php echo $_SESSION['user_id']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>