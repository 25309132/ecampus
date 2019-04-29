<?php
include_once('sys/core/init.inc.php');
$common = new common();
$GetPC = $common->GetRows("SELECT * FROM tbl_semesters WHERE isActive = 1 AND isUpcoming = 1;");
foreach ($GetPC as $gsdata) {
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
                            <div class="col-md-2 col-sm-12 col-xs-12"></div>
                            <div class="col-md-8" style="font-family:Arial, Helvetica, sans-serif; color:#575757;">  
                                <div class="text-center">
                                    <h1 style="font-size: 25px; color:#29AB87;">About Maseno University eCampus</h1>
                                    <hr style=" background:#FFBF00; height: 5px; color:#FFBF00; width:12.5%;" >                                    
                                </div>
                                <p class="text-center">The eCampus of Maseno University is one of the latest innovations by Maseno University to facilitate 
                                    online delivery of high quality certificate, diploma and degree programmes to learners in various parts of the country, 
                                    the East African region and beyond. Maseno University is indeed in the lead in pioneering the use of modern technologies 
                                    to not only realise equitable access to higher education through eLearning but also improve the quality of educational 
                                    experience for our learners. The eCampus is modeled around a web-based Learning Management System (LMS), 
                                    electronic community and administrative centers for students and faculty. All programmes offered at the eCampus are primarily
                                    delivered through the internet, with students taking sit-in on-campus examinations at the end of each Semester.</p>

                                <div class="text-center">
                                    <h1 style="font-size: 25px; color:#29AB87;"> Teaching and Learning</h1>
                                    <hr style=" background:#FFBF00; height: 5px; color:#FFBF00; width:12.5%;" >
                                </div>
                                <p class="text-center">Besides learning and teaching activities, our eCampus facilitates interaction and collaboration between and among students, academic and administrative staff. The emphasis on eLearning and other blended approaches to learning and teaching allows for individual modules to be given in a variety of ways which may or may not include a face-to-face component.</p>
                                <div class="text-center">
                                    <h1 style="font-size: 25px; padding: 0 10px; color:#29AB87;">Target Clients</h1>
                                    <hr style=" background:#FFBF00; height: 5px; color:#FFBF00; width:12.5%;" >
                                </div>
                                <p class="text-center">The programmes offered at the eCampus enable professionals and other out-of-school people to further their education and realise career growth without having to attend physical classes. The modules offered at the eCampus are modular and flexible in nature, allowing students to register and pay for individual modules depending on their budget. These programmes are suitable for people who are in full time employment, have family commitments, live in remote areas, are taking other courses on a full time basis or would like to pay for the number of modules that they can afford each time.</p>
                               <div class="text-center">
                                   <h1 style="font-size: 25px; padding: 0 10px; color:#29AB87;"> Anywhere Anytime Learning</h1>
                                   <hr style=" background:#FFBF00; height: 5px; color:#FFBF00; width:12.5%;" >
                               </div>
                                <p class="text-center">Through the eCampus of Maseno University,learners are able to access high quality learning resources and collaborate with fellow learners on various learning tasks within the comfort of their workplace, homes, cybercafés or even while on business trips.</p>                                       
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12"></div>
                        </div>
                    </div>
                </div>
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
                                    <h4><a href="">Apply now for <?php echo $formatted_month . ' ' . $formatted_year; ?> Intake</a></h4>
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
                      <h4><a href="">Apply now for the <?php echo $formatted_month . '-' . $formatted_year; ?> intake</a></h4>
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

    $(document).ready(function () {
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