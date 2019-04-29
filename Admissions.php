<?php
include_once('sys/core/init.inc.php');
$common=new common();
$GetPC = $common->GetRows("SELECT * FROM tbl_semesters WHERE isActive = 1 AND isUpcoming = 1;"); 
foreach ($GetPC as $gsdata) 
{
    $get_date = $gsdata['start_date'];
    $formatted_month = date('F', strtotime($get_date));
    $formatted_year = date('Y', strtotime($get_date));
}
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title> Home | Maseno E-Learning Portal </title>
        <?php include_once('include/meta.php'); ?>

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
                <div class="blog-area ptb-50">
                    <div class="container">
                        <div class="row">
                            <div class="demo col-md-9 ptb-35"> 
                              <p><a href="http://elearning2.maseno.ac.ke/elearning/student_authentication.php"><img src="img/collection/sam-14_140_100.jpg" alt=""></a>

                            <h3><font color="jungle green">Admission Information</font></h3><br><br>
<p>All successful applicants will receive a provisional admission letter as soon as a decision is made on their application. Unsuccessful applicants will also receive a letter stating the reason for non-admission. Successful applicants will be enrolled for a mandatory 1 week Online Orientation to eLearning for students upon receipt of their tution fees. The applicant will immediately receive an e-mail acknowledging receipt of their application.
<br><br>
<font color="jungle green">Application Information </font><br><br>
 <p>Once your application is received at the eCampus and confirmed as complete, it will be forwarded to the Office of the Director, School of Graduate Studies for further action.
Contact<br><br>
	<h3>Contact Us:</h3>
								<p>
									<strong>
										Country:Kenya<br>
										City:Kisumu<br>
									
									</strong>
								</p>
								
								Address:	The eCampus of Maseno University,<br> P.O BOX 3275-40100 <br>
									Email: <a href="mailto:">ecampus@maseno.ac.ke</a><br>
									Tel: +25457-2021013, +254 711 432 244
								</p>                                  
                            
 
                                    </div>
                              </div>
                              <div class="blog-area ptb-35">
                    <div class="container">
                            <div class="tab-content row">
                                <div id="blog" role="tabpanel" class="active section-tab-item">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="single-blog">
                                            <div class="single-blog-img">
                                                <a href="#">
                                                    <img src="img/collection/intake.jpg" alt="blog" style="width:300px;height:150px;">
                                                </a>
                                            
                                            <div class="blog-date text-center">
                                                    <h2> <?php echo $formatted_year; ?> <span> <?php echo $formatted_month; ?></span></h2>    
                                                </div>
                                            </div>
                                            <div class="single-blog-info mt-25">
                                                <h4><a href="">Apply now for <?php echo $formatted_month.' '.$formatted_year; ?> Intake</a></h4>
                                                <p>We are currently receiving applications for the September 2018 Intake. Applications will be processed as they are received. Admissions will therefore be granted in the shortest time possible. </p>
                                                <div class="button-comments">
                                                    <div class="read-button text-center">
                                                        <!--a class="read-more text-uppercase" href="javascript:void();">read More <i class="fa fa-angle-double-right"></i></a-->
                                                    </div>
                                                    <div class="comment-like">
                                                         <ul>
                                                            <li><a href="apply-now"><i class="fa fa-send-o"></i>Apply Now! </a></li>
                                                        </ul>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </div>

                              </div>
                              </div>
                              <!--div class="col-md-3">
                              <div class="single-blog ptb-35">
                                    <div class="single-blog-img">
                                        <a href="#">
                                            <img src="img/collection/intake.jpg" alt="blog">
                                        </a>
                                        <div class="blog-date text-center">
                                            <h2><?php echo $formatted_year; ?> <span><?php echo $formatted_month; ?></span></h2>    
                                        </div>
                                    </div>
                              <div class="single-blog-info mt-25">
                                        <h4><a href="">Apply now for the <?php echo $formatted_month. '-' .$formatted_year; ?> intake</a></h4>
                                        <p>We are currently receiving applications for the September 2018 Intake. Applications will be processed as they are received. Admissions will therefore be granted in the shortest time possible</p>
                                        <div class="button-comments">
                                            <div class="read-button text-center">
                                                <a class="read-more text-uppercase" href="javascript:void();">read More <i class="fa fa-angle-double-right"></i></a>
                                            </div>
                                            <div class="comment-like">
                                                 <ul>
                                                    <li><a href="apply-now"><i class="fa fa-send-o"></i> Apply Now! </a></li>
                                                </ul>
                                            </div> 
                                            </div>
                                            </div-->
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
    jQuery().ready(function () {
        var v = jQuery("#RegisterFRM").validate({
            rules: {   
                Email: {
                    email: true
                },
                PhoneNumber: {
                    number: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });
        
    });

    $(document).ready(function() {
        $("form#RegisterFRM").submit(function (e) {
            e.preventDefault();
            if ($('#RegisterFRM').valid()) {
                $("#Loading_ID").show('fast');
                $('.form-wizard').hide("fast");
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'register-post-graduate.php',
                    type: 'POST',
                    data: formData,
                    async: true,
                    success: function (data) {
                        window.setTimeout(close, 500);
                        function close() {
                            $("#Loading_ID").hide('explode');
                            $('.form-wizard').show("fast");
                            $('#RegisterFRM')[0].reset();
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
        
        $(function () {
            $(".select2").select2();
        });
        
        var dateToday = new Date();
        $('.datepicker').datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: "yy-mm-dd",
          maxDate: dateToday
        });
    });

</script>