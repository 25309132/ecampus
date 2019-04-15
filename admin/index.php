<?php
// error_reporting(E_ALL);
//session_start();
header('Cache-control: private'); // IE 6 FIX
// always modified 
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1 
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0 
header('Pragma: no-cache');

/* Start Original Scripts */
include_once('sys/core/init.inc.php');
$common=new common();

$yasavedemail = $_COOKIE['emailyako'];
$yasavedepassword = $_COOKIE['ingiamsee'];

// Form User Login Submit    
if (filter_has_var(INPUT_POST, 'login')) {
    try {
        $Uname_Email= $_POST['Uname_Email'];
        $password =md5($_POST['password']);
        $autologin= $_POST['autologin'];

        $getALevel=$common->GetRows("SELECT * FROM tbl_users WHERE (uname ='".$Uname_Email."' OR email ='".$Uname_Email."')  AND pass='".$password."' and isActive=1");
        
        if(!$getALevel)
            {
                $IFloginerror='<div class="alert alert-danger alert-dismissable" style="margin-top:5px;"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Wrong User Name or Password</b></div>';
            }
        else
            {
                foreach($getALevel as $A)
                    {
                        $_SESSION['UID']=$A["id"];
                        $_SESSION['GrpID']=$A["group_id"];
                        $_SESSION['UName']=$A["uname"];
                        $_SESSION['UsersNames']=$A["names"];
                        $_SESSION['UsersPhoneNumber']=$A["phone_number"];
                        $_SESSION['UserImage']=$A["photo"];
                        $_SESSION['UserEmail']=$A["email"];
                    } 
                    // Set Login Cookies
                    if ($_POST['autologin'] == 1) {
                        $year = time() + 31536000;
                        setcookie('emailyako', $Uname_Email, $year);
                        setcookie('ingiamsee', $_POST['password'], $year);

                    } else {
                        if (isset($_COOKIE['emailyako'])) {
                            $past = time() - 100;
                            setcookie('emailyako', gone, $past);
                            setcookie('ingiamsee', gone, $past);
                        }
                    }
                    
            }
    } catch (Exception $e) {echo $e;}
}

/* End Original Scripts */

$GetUAvatar = $common->GetRows(" SELECT * FROM tbl_users WHERE id = '{$_SESSION['UID']}' ");
    foreach($GetUAvatar AS $sslin)
      {
        $YaProfilePhoto =$sslin['photo'];
        $YaProfileusername =$sslin['uname'];
        $YaPu_fname =$sslin['names'];
        $YaPu_phone=$sslin['phone'];
        $YaPu_email=$sslin['email'];
        $YaPUserTitle =$sslin['user_title'];
        if(empty($YaProfilePhoto))
          {
            $YaProfilePhoto = 'user_avatar.png';
          }
      }
// Start Facility Sessions
$_SESSION['HMISFacilityID'] = 1;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $SystemName; ?> | Login / Module Select </title>
  <?php include_once('inc/p-meta.php'); ?> 
  <link rel="stylesheet" href="assets/dist/css/accu.css">
</head>
<body class="hold-transition login-page">

<!--Start Header Section -->
 <header class="header" style="border-bottom: 1px solid #BBAC7C; background-color: #ffffff;">
  <div class="container">
    <?php
    if(!isset($_SESSION['UID']))
      {
    ?>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" style="background-color:#ffffff; margin-bottom: 0px;">
          <a href="index" class="logo pull-left">
            <img src="img/<?php echo $coop_logo; ?>" style="height:40px; margin-top: 5px;"> 
          </a>
          <span class="f_pass_r inline m_top_10 p_ryt_20 pull-right"><i class="fa fa-globe"></i> <a href="<?php echo $isssl.$PKWebsite; ?>" target="_blank"><?php echo $SystemName; ?>  &copy; <?php echo date('Y'); ?></a> </span>
        </nav>
    <?php
        }
      else
        {
      ?>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" style="background-color:#ffffff; margin-bottom: 0px;">
            <a href="index" class="logo">
              <img src="img/<?php echo $coop_logo; ?>" style="height:40px; margin-top: 5px;">
            </a>

            <span class="f_pass_r inline p_ryt_20"><i class="fa fa-user"></i> Welcome Back, <a href="javascript:void(0);" class="User-Names"><?php echo $_SESSION['UsersNames']; ?></a> | <i class="fa fa-lock"></i> <a href="logout">Logout</a> </span>
        </nav>

    <?php
        }
      ?>
    </div>         
</header>
<!--End Header Section -->
<?php
if(!isset($_SESSION['UID']))
    {
?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body" style="box-shadow: -5px 5px 20px #888888; width:440px;">
    <?php 
    if(isset($_POST['login']))
      {
        echo $IFloginerror; 
      }
    else
      {
    ?>
    <p class="login-box-msg"  style="background-color: #ffffff;">
      <img src="img/<?php echo $coop_logo; ?>"  height="80"/>
    <hr />
    </p>
    <?php
      }
    ?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <label>E-mail/ Username</label>
        <input type="text" class="form-control"  placeholder="Enter your E-mail/ Username" value="<?php if(isset($_REQUEST['mx'])){ echo $_REQUEST['mx']; } elseif (isset( $_COOKIE['emailyako'])) { echo $yasavedemail; } ?>" name="Uname_Email" autocomplete="off" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Password</label>
        <input type="password" class="form-control"  name="password"  id="password" autocomplete="off" required placeholder="Enter Your Password" value="<?php if (isset($_COOKIE['ingiamsee'])) { echo $yasavedepassword; } ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label class="">
              <div class="icheckbox_square-blue" style="position: relative;" aria-checked="false" aria-disabled="false">
                <input style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" type="checkbox" name="autologin" value="1" <?php if (isset($_COOKIE['ingiamsee'])) { echo 'checked'; } ?>><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-check"></i>  Sign In</button>
        </div>
        <!-- /.col -->
      </div>

    </form>

    <hr />
    <div class="row">
        <div class="col-xs-4">
        <a href="#" class=""><i class="fa fa-question"></i> Forgot Password?</a>
        </div>
        <div class="col-xs-8">
          <span class="pull-right"><?php echo $SystemName; ?> &copy; <?php echo date('Y'); ?></span>
        </div>
    </div>

    <br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php
}
else
{
?>
<!--Start Listing Agent Modules -->
<div class="content">
<div class="container Listed-System-Modules">
        <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 m_top_20">
                    <div class="row">
                        <?php foreach($common->GetRows("SELECT * FROM tbl_sys_modules WHERE isDeleted = 0 ORDER BY display_id ASC ") as $M) {?>
                        <div class="col-md-3 m_bottom_20">
                            <!-- small box -->
                            <div class="small-box <?php echo $M["sys_color"];?>">
                                <div class="inner">
                                    <center><p style="margin-top:12px; text-align: center;"><?php echo $M["sys_name"];?></p>
                                    </center>
                                </div>
                                <!--Add Links to Accesible Modules-->
                                <?php 
                                $gaurl = $common->GetRows("SELECT * FROM tbl_sys_modules where group_access like  '%".$_SESSION['GrpID']."%'  AND isActive=1 AND url = '{$M["url"]}' AND isDeleted = 0 ");
                                if($gaurl)
                                    { foreach ($gaurl as $gum) 
                                        {
                                        echo '<a href="'.$gum["url"].'" class="small-box-footer"><center class="hvr-shutter-out-vertical "><img src="img/'.$gum["sys_icon"].'" style="width:100%; padding: 0px !important; border-radius: 0px;" class="img-thumbnail hvr-wobble-horizontal"><p style="margin-top:12px;">Click to Access Module</p></center></a>';
                                        }
                                    } 
                                else 
                                    { 
                                        echo '<a href="javascript:void(0);" class="small-box-footer"><center style="filter: grayscale(1); background-color:#899C02"><img src="img/'.$M["sys_icon"].'"style="width:100%;  opacity: 0.2; padding: 0px !important; border-radius: 0px;" class="img-thumbnail"></center><p style="margin-top:12px; text-align: center;">Module In-accessible!</p></a>'; 
                                    } 
                                ?>
                                <!--End Add Links to Accesible Modules-->
                            </div>
                        </div><!-- ./col -->
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
</div>

<div class="SpeechNextPatientInQueue d_none">
  Welcome <?php echo $_SESSION['UsersNames']; ?>, Please Select a Module To Proceed!
</div>

<?php
}
?>
<!--End Listing Agent Modules -->

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="js/articulate.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  function speak(obj) { $(obj).articulate('setVoice','name','Daniel').articulate('rate', 1.0).articulate('speak'); }
  // speak('.SpeechNextPatientInQueue'); 

</script>

</body>
</html>
