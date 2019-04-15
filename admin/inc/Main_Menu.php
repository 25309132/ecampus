<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less <li class="active"> to activate a menu link -->
    <ul class="sidebar-menu" style="margin-top:15px;">
        <li>
            <?php if (isset($_REQUEST['Reports']))
            {
                echo '<a href="../Dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>'; 
            }
            else
            {
                echo '<a href="Dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>';
            }
            ?>
        </li>
		<li>
            <?php if (isset($_REQUEST['Reports']))
            {
                echo '<a href="../smis_config">
                <i class="fa fa-th"></i> <span>System Configuration</span>
            </a>'; 
            }
            else
            {
                echo '<a href="smis_config">
                <i class="fa fa-th"></i> <span>System Configuration</span>
            </a>';
            }
            ?>
            
        </li>
		 <li class="treeview">
            <a href="#">
                <i class="fa fa-user-md"></i> <span>User Management</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            <?php if (isset($_REQUEST['Reports']))
            {
                echo '<li><a href="../Add SMERC User"><i class="fa fa-angle-double-right"></i> Register System User</a></li>
                <li><a href="../SMERC Users listing"><i class="fa fa-angle-double-right"></i> User Listing</a></li>'; 
            }
            else
            {
                echo '<li><a href="Add SMERC User"><i class="fa fa-angle-double-right"></i> Register System User</a></li>
                <li><a href="SMERC Users listing"><i class="fa fa-angle-double-right"></i> User Listing</a></li>';
            }
            ?>
            </ul>
        </li>
        <?php // Membership Management
        if (isset($_REQUEST['Reports']))
        {
	        echo '<li><a href="Members Management Edit Listing Report?Reports"> <i class="fa fa-folder-open-o"></i> <span>Members Management</span></a></li>';
        }
            else
        {
            echo '<li><a href="Server_Scripts/Members Management Edit Listing Report?Reports"> <i class="fa fa-folder-open-o"></i> <span>Members Management</span> </a></li>';
        }
        ?>
	
		<li>
            <?php if (isset($_REQUEST['Reports']))
            {
                echo '<a href="Business Coaching List?Reports">
                <i class="fa fa-home"></i> <span>Business Coaching</span>
            </a>'; 
            }
            else
            {
                echo '<a href="Server_Scripts/Business Coaching List?Reports">
                <i class="fa fa-home"></i> <span>Business Coaching</span>
            </a>';
            }
            ?>
        </li>

        <li>
            <?php if (isset($_REQUEST['Reports'])) // Segmentation / Analytics
            {
                echo '<a href="Analytics Report?Reports">
                <i class="fa fa-cog"></i> <span>Segmentation & Analytics</span>
            </a>'; 
            }
            else
            {
                echo '<a href="Server_Scripts/Analytics Report?Reports">
                <i class="fa fa-cog"></i> <span>Segmentation & Analytics</span>
            </a>';
            }
            ?>
        </li>
        <li>
        <?php if (isset($_REQUEST['Reports']))
            {
                echo '<a href="../Email Notifications">
                <i class="fa fa-envelope"></i> <span> Email Notifications</span>
            </a>'; 
            }
            else
            {
                echo '<a href="Email Notifications">
                <i class="fa fa-envelope"></i> <span> Email Notifications</span>
            </a>';
            }
            ?>
        </li>
        <!--
        <li>
        <?php if (isset($_REQUEST['Reports']))
            {
                echo '<a href="../Upload Files">
                <i class="fa fa-upload"></i> <span> Upload Files</span>
            </a>'; 
            }
            else
            {
                echo '<a href="Upload Files">
                <i class="fa fa-upload"></i> <span> Upload Files</span>
            </a>';
            }
            ?>
        </li>
        <!--       
		<li>
		<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/RMS/errorpage.php"><i class="fa fa-angle-double-right"></i> Error Page</a>
		</li> -->
    </ul>
</section>
