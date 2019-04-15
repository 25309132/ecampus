<?php
include_once('sys/core/init.inc.php');
$common=new common();

if(!isset($_SESSION['UID'])){
    header("location: login");
}

$LoggedUserID = $_SESSION['UID'];
$LoggedUserAdmission = $_SESSION['UName'];
$CurrentYearId = $common->CCGetDBValue("SELECT id FROM tbl_academic_years WHERE is_curent =  '1' ");
$CurrentSemesterId = $common->CCGetDBValue("SELECT id FROM tbl_semesters WHERE year_id =  '".$CurrentYearId."' AND isCurrent = '1'");
$StudentID = $common->CCGetDBValue("SELECT id FROM tbl_students WHERE admission_number =  '".$LoggedUserAdmission."' ");
$AvailableBalance = $common->CCGetDBValue("SELECT floatAmount FROM tbl_students_float WHERE studentFID =  '".$StudentID."' ");
$HasPaidStatutory = $common->CCGetDBValue("SELECT amount FROM fin_statutory_fee_payments WHERE student_id =  '".$StudentID."' ");
if(empty($HasPaidStatutory))
{
    $HasPaidStatutory = 0;
}
else {
  $HasPaidStatutory = 1;
}

$CoursesTotal = $common->CCGetDBValue("SELECT count(`ts`.`id`) FROM tbl_student_registered_courses ts JOIN tbl_users `us` ON `us`.`id` = `ts`.`UID` WHERE `us`.`id` = '{$LoggedUserID}' ");

$result = $common->GetRows("SELECT `ts`.*, `pt`.`programme_name`, `pt`.`programme_code` FROM tbl_students ts LEFT JOIN tbl_programmes pt ON `pt`.`id` = `ts`.`programme` WHERE `ts`.`admission_number` = '".$LoggedUserAdmission."' ");

  foreach ($result AS $row) {
        //Students Details
        $UID = $row['id'];
        $GetfirstName = $row['surname'];
        $GetmiddleName = $row['othernames'];
        $GetpatientPhone = $row['phone_number'];
        $GetpatientEmail = $row['personal_email'];
        $GetpatientDateOfirth = $row['date_of_birth'];
        $GetpatientIPOPNumber = $row['idpassport'];
        $Getgender = $row['gender'];
        $CPhoto = $row['student_image'];
        $GetAddress = $row['postal_address'];
        $GetCountry = $row['country'];
        $GetCitizenship = $row['citizenship'];
        $GetMaritalStatus = $row['marital_status'];
        $GetPermanentAddress = $row['permanent_address'];
        $DateToday = new DateTime();
        $DateCreated = $row['date_registered'];
        $ApplicationDate = new DateTime($DateCreated);
        $difference = $DateToday->diff($ApplicationDate);
        $ApplicationDuration = format_interval($difference);
        $GetProgrammeAppliedFor = $row['programme_name'];
        $GetProgrammeCode = $row['programme_code'];
        $GetCity = $row['city'];
        $GetFax = $row['fax'];
        $GetApplicationType = $row['application_type'];
        
        if(empty($GetpatientPhone)){
          $GetpatientPhone = '-';
        }

        if(empty($GetpatientEmail)){
          $GetpatientEmail = '-';
        }

        if(empty($CPhoto)){
            $CPhoto = 'user_avatar.png';
        }
    }
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
       
        <title> Home | Maseno E-Learning Portal </title>
        <?php include_once('include/meta.php'); ?>
        <link rel="stylesheet" href="js/sweetalert2.min.css">
        
    </head>
    <body>
        <!-- Pre Loader
        ============================================ -->
        <div class="preloader">
            <div class="loading-center">
                <div class="loading-center-absolute">
                    <div class="object object_one"></div>
                    <div class="object object_two"></div>
                    <div class="object object_three"></div>
                </div>
            </div>
        </div>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="as-mainwrapper">
            <div class="bg-white">
                <!-- header start -->
                <header class="header-area">
                    <?php include_once('include/topheader.php'); ?>
                    <?php include_once('include/header.php'); ?>
                    <?php include_once('include/mainmenu.php'); ?>
                </header>
                <!-- header end -->
                <div class="blog-area ptb-35 m_top_40">
                    <div class="container bootstrap snippet" style="font-size: 13px;">
                            <div class="row">
                                <div class="col-sm-3"><!--left col-->
                                  <div>
                                    <h4 class="t_align_c"><b> <?php echo $_SESSION['UName']; ?> </b> </h4>
                                  </div>
                                  <div class="text-center">
                                    <img src="admin/img/students/<?php echo $CPhoto; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                                    <h6> Upload a different photo... </h6>
                                    <input type="file" class="text-center center-block file-upload">
                                  </div></hr><br>
                                       
                                  <div class="panel panel-default">
                                    <div class="panel-heading"> Student Since <i class="fa fa-link fa-1x"></i> <?php echo $DateCreated;?> </div>
                                    <div class="panel-body"><a href="javascript:void();"> <?php echo $GetProgrammeAppliedFor. ' ('.$GetProgrammeCode.')'; ?></a></div>
                                  </div>

                                  <ul class="list-group m_top_20">
                                    <li class="list-group-item text-muted"> Students Activity <i class="fa fa-dashboard fa-1x"></i></li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong> Last Login: </strong></span> 1:25PM</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong> Courses Subscribed: </strong></span> <?php echo $CoursesTotal;?> </li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong> Exams Taken: </strong></span> 37 </li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong> Results: </strong></span> 78 </li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong> Student Available Float: </strong></span> <?php echo number_format($AvailableBalance, 0); ?> </li>
                                  </ul> 
                                       
                                </div><!--/col-3-->
                                <div class="col-sm-9">
                                    <ul class="nav nav-tabs">
                                        
                                        <li class="active" id="getStudentsCourses"><a data-toggle="tab" href="#courses"> Register for Modules </a></li>
                                        <li id="getStudentsApplications"><a data-toggle="tab" href="#messages"> My Module Registrations </a></li>
                                        <li id="getStudentsFinances"><a data-toggle="tab" href="#settings"> Fee Payment</a></li>
                                        <li id="getNotifictions"><a data-toggle="tab" href="#notifications">Correspendence</a></li>
                                        <li id="getExamResults"><a data-toggle="tab" href="#results">Exam Results</a></li>
                                        
                                        <li><a data-toggle="tab" href="#profile"> Update My Profile </a></li>
                                        
                                    </ul>
                                    <div class="tab-content">
                                    <div class="tab-pane" id="profile">
                                          <form class="form" action="" method="post" id="registrationForm">
                                                <div class="row ptb-10">
                                                  <div class="form-group">
                                                    <div class="col-md-4">
                                                          <label for="students_surname"><h4>Surname</h4></label>
                                                          <input type="text" class="form-control" name="students_surname" id="students_surname" placeholder="Surname" value="<?php echo $GetfirstName;?>" autocomplete="off">
                                                      </div>
                                                      <div class="col-md-4">
                                                          <label for="other_names"><h4>Other Names </h4></label>
                                                          <input type="text" class="form-control" name="other_names" id="other_names" placeholder="first name" title="enter your first name if any." value="<?php echo $GetmiddleName;?>" autocomplete="off">
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label for="last_name"><h4> Students Mobile: </h4></label>
                                                          <input type="text" class="form-control" name="students_mobile" id="students_mobile" placeholder="last name" title="enter your last name if any." value="<?php echo $GetpatientPhone;?>" autocomplete="off">
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="row ptb-10">
                                                    <div class="form-group">
                                                      <div class="col-md-4">
                                                          <label for="email"><h4> Student's Email</h4></label>
                                                          <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email." value="<?php echo $GetpatientEmail;?>" autocomplete="off">
                                                      </div>
                                                      <div class="col-md-4">
                                                          <label for="email"><h4> Student's ID Number </h4></label>
                                                          <input type="text" class="form-control" name="id_number" id="id_number" placeholder="ID Number" title="enter your email." value="<?php echo $GetpatientIPOPNumber;?>" autocomplete="off">
                                                      </div>
                                                      <div class="col-md-4">
                                                          <label for="postal_address"><h4> Student's Postal Address </h4></label>
                                                          <input type="text" class="form-control" name="postal_address" id="postal_address" placeholder="Postal Address" title="enter your postal_address." value="<?php echo $GetAddress;?>" autocomplete="off">
                                                      </div>
                                                  </div>
                                                </div> <hr />
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-4">
                                                          <label for="username"><h4> Username </h4></label>
                                                          <input type="text" class="form-control" id="username" placeholder="username" value="<?php echo $_SESSION['UName']; ?>" readonly >
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="password"><h4> Password </h4></label>
                                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your new Password" title="Enter your new Password." autocomplete="off">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="password2"><h4> Confirm Password </h4></label>
                                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Password Again" title="enter your password again" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row m_top_20">
                                                    <div class="form-group pull-right">
                                                      <div class="col-md-12">
                                                        <button class="btn btn-lg btn-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Submit </button>
                                                        </div>
                                                    </div>
                                                </div><hr />
                                            </form>
                                     </div><!--/tab-pane-->
                                    <div class="tab-pane" id="messages">
                                        <center  id="Loading_ID" class="r_corners">
                                          <h4 class="ptb-35">Please wait... Processing Your Request </h4>
                                          <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                        </center>
                                    </div>
                                    <!--/tab-pane-->
                                    <div class="tab-pane active" id="courses">
                                        <center  id="Loading_ID2" class="r_corners">
                                          <h4 class="ptb-35">Please wait... Processing Your Request </h4>
                                          <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                        </center>
                                    </div>
                                    <!--/tab-pane-->
                                    <!--/tab-pane-->
                                    <div class="tab-pane" id="settings">
                                        <center  id="Loading_ID3" class="r_corners">
                                          <h4 class="ptb-35">Please wait... Processing Your Request </h4>
                                          <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                        </center>
                                    </div>
                                    <!--/tab-pane-->
                                    <div class="tab-pane" id="results">
                                        <center  id="Loading_ID4" class="r_corners">
                                          <h4 class="ptb-35">Please wait... Processing Your Request </h4>
                                          <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                        </center>
                                    </div>
                                    <!--/tab-pane-->
                                    <div class="tab-pane" id="notifications">
                                        <div class="row m_top_10"><div class="alert alert-danger m_top_10 accu-f-md" role="alert"><center><h4 class="t_align_c"><i class="fa fa-shield"></i><hr /><strong>Ooops!</strong> Currently there are no Comunication Items from the University </h4></center></div></div>
                                    </div>
                                  </div><!--/tab-content-->

                                </div><!--/col-9-->
                            </div><!--/row-->
                    </div>
                </div>
                <!-- Form Ends -->
                <?php include_once('include/footerjs.php'); ?>
                <!-- footer start -->
                 <?php include_once('include/footer.php'); ?>
                <!-- footer end -->
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    
  $(document).ready(function() {
      var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
      }
      
      $(".file-upload").on('change', function(){
          readURL(this);
      });

      //get Students Applications
      $("#getStudentsApplications").click(function(){
      var DefaultFormData = $("#DefaultForm").serialize();
          $.ajax({
              url: 'get-students-applications.php',
              type: 'POST',
              async: true,
              data: DefaultFormData,
              success: function (data) {  
                  $("#Loading_ID").hide();
                  $('#messages').html(data);
              }
          });
      });

      //get Students Results
      $("#getExamResults").click(function(){
      var DefaultFormData = $("#DefaultForm").serialize();
          $.ajax({
              url: 'getStudentsResults.php',
              type: 'POST',
              async: true,
              data: DefaultFormData,
              success: function (data) {  
                  $("#Loading_ID4").hide();
                  $('#results').html(data);
              }
          });
      });

      //get Students Courses
      var DefaultFormData = $("#DefaultForm").serialize();
      var HasPaidStatutory = '<?php echo $HasPaidStatutory; ?>';
      $.ajax({
          url: 'get-students-courses.php?HasPaidStatutory='+HasPaidStatutory,
          type: 'POST',
          async: true,
          data: DefaultFormData,
          success: function (data) {  
              $("#Loading_ID2").hide();
              $('#courses').html(data);
          }
      }); 

      //get Students Finances
      $("#getStudentsFinances").click(function(){
      var DefaultFormData = $("#DefaultForm").serialize();
          $.ajax({
              url: 'get-students-finances.php',
              type: 'POST',
              async: true,
              data: DefaultFormData,
              success: function (data) {  
                  $("#Loading_ID3").hide();
                  $('#settings').html(data);
              }
          });
      });
  });

</script>
