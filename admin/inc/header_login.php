<header class="header" style="border-bottom: 12px solid #BBAC7C; ">
	<?php
	if(!isset($_SESSION['SESSION_EMAIL']))
	{
	?>
	<a href="index" class="logo">
    	<img src="assets/dest/images/smeafrica_logo.jpg" alt="" height="60px">
		</a>
		<!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color:#ffffff;">
        <span class="f_pass_r inline m_top_20 p_ryt_20"><i class="fa fa-globe"></i> <a href="<?php echo $isssl.$school_website; ?>" target="_blank"><?php echo $school_website; ?></a> </span>
    </nav>
		<?php
   	}
   	else
   	{
   	?>
   	<a href="Dashboard" class="logo">
   		<img src="assets/dest/images/smeafrica_logo.jpg" alt="" height="60px">
		</a>
		<!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color:#ffffff;">
        <span class="f_pass_r inline m_top_20 p_ryt_20"><i class="fa fa-user"></i> <?php echo $_SESSION['SESSION_NAMES']; ?> </span>
    </nav>
		<?php
   	}
   	?>
            
</header>