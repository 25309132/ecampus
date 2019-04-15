<div class="header-top" style="border-bottom:1px solid #BBAD7C;">
	<div class="container t_deco_nil m_bottom_10 ">
		<div class="pull-left auto-width-left" style="padding-bottom:20px;">
			<ul class="top-menu menu-beta_2 l-inline ">
				<li><a href="index"><i class="fa fa-phone"></i> +254  20 804 8985/6. 0723 355 408&nbsp;&nbsp;&nbsp; |</a>  </li>
				<li><a href="mailto:sme@smeafrica.net">&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope"></i> sme@smeafrica.net</a></li>
			</ul>
		</div>
		<div class="pull-right auto-width-right">
			<ul class="top-details menu-beta_2 l-inline t_deco_nil ">
				<li><a href="http://smeafrica.net/who-we-are/" target="_blank"><i class="fa fa-cog"></i>About Us &nbsp;&nbsp;&nbsp;| </a></li>
				<li><a href="http://smeafrica.net/contact-us/" target="_blank">&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i> Contact Us &nbsp;&nbsp;&nbsp;| </a></li>
				<?php
					if(!isset($_SESSION['MD_user_email']))
					{
						echo '<li><a href="login">&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i> Manage Your Account </a></li>';
					}
					elseif(isset($_SESSION['MD_user_email']) && $_SESSION['MD_user_group_id'] == 1)
					{
						echo '<li><a href="Dashboard">&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i> My Profile &nbsp;&nbsp;&nbsp; | </a> </li> <li><a href="Logout">&nbsp;&nbsp;&nbsp;<i class="fa fa-lock"></i> Logout  </a> </li>';
					}
					else
					{
					echo '<li><a href="Profile">&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i> My Profile </a>&nbsp;&nbsp;&nbsp; | </a> </li> <li><a href="Logout">&nbsp;&nbsp;&nbsp;<i class="fa fa-lock"></i> Logout </li>';	
					}
				?>
				
			</ul>
		</div>
		<div class="clearfix"></div>
	</div> <!-- .container -->
</div>