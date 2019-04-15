<?php
if(!isset($_SESSION['UID'])){
  header("location: ../index");
}
$GetUAvatar = $common->GetRows("SELECT * FROM tbl_users WHERE id = '{$_SESSION['UID']}' ");
    foreach($GetUAvatar AS $sslin)
      {
        $YaProfilePhoto =$sslin['photo'];
        $YaProfileusername =$sslin['login'];
        $YaPu_fname =$sslin['names'];
        $YaPu_phone=$sslin['phone'];
        $YaPu_email=$sslin['email'];
        if(empty($YaProfilePhoto))
          {
            $YaProfilePhoto = 'user_avatar.png';
          }
?>
<!-- Logo -->
<a href="../index" class="logo">
  <img src="../img/<?php echo $coop_logo; ?>" height="50">
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="../img/users/<?php echo $YaProfilePhoto; ?>" class="user-image" alt="User Image">
          <span class="hidden-xs"><?php echo $YaPu_fname; ?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="../img/users/<?php echo $YaProfilePhoto; ?>" class="img-circle" alt="User Image">

            <p>
              <?php echo $YaPu_fname; ?>
              <small><?php echo $YaPu_email; ?></small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="index" class="btn btn-block btn-success"><i class="fa fa-user"></i>  Profile</a>
            </div>
            <div class="pull-right">
              <a href="<?php echo SITE_ROOT?>admin/logout" class="btn btn-danger btn-flat"><i class="fa fa-lock"></i> Sign out</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<?php  } ?>