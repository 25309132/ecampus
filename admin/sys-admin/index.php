<?php
include_once('../sys/core/init.inc.php');
$common=new common();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_SESSION['UsersNames']; ?> | <?php echo $SystemName; ?></title>
  <?php include_once('../inc/inc.meta.php'); ?>
  <style type="text/css">
    .tisaini-tisaini
    {
      width: 98%;
    }
    label{margin-top: 10px;}
          .help-inline-error{color:red;}
    .pan_bg_accu{
      background-color: #8CC85C;
    }
  </style>
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <?php include_once('../inc/inc.topheader.php'); ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include_once('../inc/inc.system-admin-menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Management Reports Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="../index"><i class="fa fa-home"></i>Home/ Module Select</a></li>
        <li><a href="javascript:void(0);">Management Reports   Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">  
              <img class="profile-user-img img-responsive img-circle" src="../img/users/<?php echo $YaProfilePhoto; ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo$_SESSION['UsersNames']; ?></h3>

              <p class="text-muted text-center"><?php echo $_SESSION['UserEmail']; ?></p>
              <hr />
                <div class="row">
                    <div class="col-lg-12">
                     <a class="btn btn-block btn-social btn-dropbox" data-toggle="modal" ><i class="fa fa-calendar"></i> <?php echo date('d-M-Y'); ?></a>
                    </div>
                </div>
            </div>
            <!-- /.box-body --> 
          </div>
          <div class="box box-success">
            <div class="box-body box-profile">
              <center> 
                <a href="http://www.acculynksystems.com" target="_blank">
                <img src="../img/Accu_logo.png" alt="" width="220" height="50"></a>
                <br /><br /> Powered by Acculynk Systems Ltd &copy <?php echo date("Y"); ?> | <b><?php echo $sys_version; ?></b>
            </center>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs nav-justified">
              <li class="active"><a href="#SystemQLinksTab" data-toggle="tab"><i class="fa fa-users"></i> Core System Quick Links</a></li>
              
              <li><a href="#HRMISDashboardTab" data-toggle="tab"><i class="fa fa-clone"></i>  Management Reports  Dashboard</a></li>
              <li><a href="#HRMISNotificationsTab" data-toggle="tab"><i class="fa fa-envelope"></i> Messages/  Notifications</a></li>
              
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="SystemQLinksTab">
                <div class="row m_top_20">
                  <?php foreach($common->GetRows("SELECT * FROM tbl_sys_modules WHERE isDeleted = 0 ORDER BY display_id ASC ") as $M) {?>
                  <div class="col-md-3 m_bottom_20 ">
                      <?php 
                      $gaurl = $common->GetRows("SELECT * FROM tbl_sys_modules where group_access like  '%".$_SESSION['GrpID']."%'  AND isActive=1 AND url = '{$M["url"]}' AND isDeleted = 0 ");
                      if($gaurl)
                          { foreach ($gaurl as $gum) 
                              {
                              echo '<a href="../'.$gum["url"].'" class="btn btn-app- w_full" style="width:100%; padding: 5px !important; border-radius: 0px; margin-top: 0 px !mportant;" >
                                <center><img src="../img/'.$gum["sys_icon"].'" class="img-thumbnail"><p class="text-black">'.$gum["sys_name"].'</p></center></a>';
                              }
                          }
                      ?>
                      <hr style="margin: 3px 0px 3px 0px;" />
                  </div><!-- ./col -->
                  <?php } ?>
                </div>
              </div>

              <div class="tab-pane" id="HRMISDashboardTab">
                Management Reports  Dashboard
              </div>
              <div class="tab-pane" id="HRMISNotificationsTab">
                Management Reports  Messages &amp; Notifications
              </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  <!--Footer Starts -->
    <?php include_once('../inc/inc.footertext.php'); ?>
  <!--Footer Ends-->

</div>
<!-- ./wrapper -->
<?php include_once('../inc/inc.footerjs.php'); ?>
</body>
</html>
