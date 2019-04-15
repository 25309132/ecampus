<?php

include_once('sys/core/init.inc.php');
$common=new common();

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        
        <title>Home | Maseno E-Learning Portal</title>
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
                <div class="blog-area ptb-35">
                    <div class="container">
                        <div class="row">
                            <div class="tab-content row">
                                <div class="col-md-12 col-sm-12 col-lg-12 ptb-35 single-blog-info" style="margin: 0 0 0 95px;">
                                    <h4><b> APPLY NOW TO JOIN THE ECAMPUS </b></h4><hr />
                                    <p>
                                        Thank you for your interest in studying at the eCampus of Maseno University. <br/>
                                        Maseno University has intakes each year in January, May and September. Not all programmes admit students in all three intakes. <br/>
                                        You will be informed of the date of the next intake for your programme.<br/>
                                    </p>
                                    <p>
                                        To apply, click on the relevant link below, fill in your details and submit your application. <br/>
                                        <div <div style="margin: 0 0 0 -40px;">
                                            <span class="checkout-step-number">1</span>
                                            <h4 style="margin: -20px;" class="checkout-step-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >  E-Learning Student Registration </a></h4>
                                        </div>
                                            <ul>
                                                <li>
                                                    <a href="register-post-graduate"><i class="fa fa-send-o"></i> Application for Post Graduate Programmes </a>
                                                </li>
                                                <li>
                                                    <a href="register-under-graduate"><i class="fa fa-send-o"></i> Application for Undergraduate Programmes </a>
                                                </li>
                                                <li>
                                                    <a href="register-certificate-diploma"><i class="fa fa-send-o"></i> Application for Certificate Programmes </a>
                                                </li>
                                            </ul>
                                    </p>
                                    <p>
                                        <div style="margin: 0 0 0 -40px;">
                                            <span class="checkout-step-number">2</span>
                                            <h4 style="margin: -20px;" class="checkout-step-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" > Face to Face Student Registration </a></h4>
                                        </div>
                                            <ul>
                                                <li>
                                                    <a href="register-oncampus-students"><i class="fa fa-send-o"></i> Application On-Campus Students </a>
                                                </li>
                                            </ul>
                                    </p> <br />
                                    <h4><b> NOTE: </b></h4>
                                    <p> 
                                        Applications are processed as they are received. <br/> 
                                        You will be able to know the outcome of your application once a decision is made. <br/> <br/>

                                        To use the online application, you will need:<br/>
                                        1. Stable internet access <br/>
                                        2. A working email address where all communication regarding your application will be sent. <br/><br/>

                                        Tel: +254 57 2021013 <br/>
                                        Mobile: +254 711 432 244 <br/>
                                        Website: http://ecampus.maseno.ac.ke 
                                    </p>
                                </div>
                            </div>
                        </div>
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