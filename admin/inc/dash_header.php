<header class="header">
    <?php if (isset($_REQUEST['Reports']))
    {
    ?>
    <a href="../Dashboard" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               <img src="../assets/dest/images/smeafrica_logo.jpg" width="" height="60"/>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
                                <?php echo $_SESSION['SESSION_NAMES']; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img name="<?php echo $_SESSION['SESSION_NAMES']; ?>" src="../Users_Avatars/<?php echo $_SESSION['SESSION_AVATAR']; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        Email: <?php echo $_SESSION['SESSION_EMAIL']; ?>
                                        <br />
                                        <small>Phone: <?php echo $_SESSION['SESSION_PHONE']; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                               <div class="pull-left">
                               <a data-toggle="modal" data-target="index#SID_MODAL"><button class="btn btn-success t_align_c w_full">My Profile</button></a>
                               </div>
                                    <div class="pull-right">
                                        <a href="../logout" class="btn btn-danger">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
    <?php
    }
    else
    {
    ?>
<a href="Dashboard" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               <img src="assets/dest/images/smeafrica_logo.jpg" width="" height="60"/>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
                                <?php echo $_SESSION['SESSION_NAMES']; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img name="<?php echo $_SESSION['SESSION_NAMES']; ?>" src="Users_Avatars/<?php echo $_SESSION['SESSION_AVATAR']; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        Email: <?php echo $_SESSION['SESSION_EMAIL']; ?>
                                        <br />
                                        <small>Phone: <?php echo $_SESSION['SESSION_PHONE']; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                               <div class="pull-left">
                               <a data-toggle="modal" data-target="#SID_MODAL"><button class="btn btn-success t_align_c w_full">My Profile</button></a>
                               </div>
                                    <div class="pull-right">
                                        <a href="logout" class="btn btn-danger">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

    <?php
    }
    ?>
            
        </header>