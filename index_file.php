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
                <!-- slider start -->
                <div class="slider-wrap">
                    <div class="preview-2">
                        <div id="nivoslider" class="slides"> 
                            <img src="img/slider/image2.gif" alt="" title="#slider-direction-1"  />
                            <img src="img/slider/image1.gif" alt="" title="#slider-direction-2"  />
                        </div>
                        <!-- direction 1 -->
                        <div id="slider-direction-1" class="slider-direction">
                            <div class="banner-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="nivo_text">       
                                                <div class="nivo_text-wrapper">       
                                                    <div class="slider-content slider-text-1 text-left">
                                                        <div class="wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.3s">
                                                            <h2>MASENO UNIVERSITY </h2>
                                                        </div>
                                                    </div>     
                                                    <div class="slider-content slider-text-1 text-left hidden-xs">
                                                        <div class="wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.3s">
                                                            <h1>E Learning Portal </h1>
                                                        </div>
                                                    </div>     
                                                    <div class="slider-content slider-text-1 text-left hidden-xs">
                                                        <div class=" wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.3s">
                                                            <p> The eCampus of Maseno University is one of the latest innovations by Maseno University to facilitate online delivery of high-quality certificate, diploma and degree programmes to learners in various parts of the country<br> 

                                                                Maseno University is indeed in the lead in pioneering the use of modern technologies to not only realize equitable access to higher education through eLearning but also improve the quality of educational experience for our learners </p>
                                                        </div>
                                                    </div>
                                                    <div class="slider-content slider-text-1 text-left hidden-sm hidden-xs">
                                                        <div class="wow bounceInUp" data-wow-duration="3s" data-wow-delay="1s">
                                                            <a href='apply-now' class='slider-button'>Apply Now!</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>            
                                </div>    
                            </div>    
                        </div>
                        <!-- direction 2 -->
                        <div id="slider-direction-2" class="slider-direction">
                            <div class="banner-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="nivo_text">       
                                                <div class="nivo_text-wrapper">       
                                                    <div class="slider-content slider-text-2 text-left">
                                                        <div class="wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.3s">
                                                            <h2 class="text-uppercase">MASENO UNIVERSITY</h2>
                                                        </div>
                                                    </div>     
                                                    <div class="slider-content slider-text-2 text-left hidden-xs">
                                                        <div class="wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.3s">
                                                            <h1 class="text-uppercase">E Campus</h1>
                                                        </div>
                                                    </div>     
                                                    <div class="slider-content slider-text-2 text-left hidden-xs">
                                                        <div class="wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.3s">
                                                            <p>Maseno University is indeed in the lead in pioneering the use of modern technologies to not only realize equitable access to higher education</p>
                                                        </div>
                                                    </div>
                                                    <div class="slider-content slider-text-2 text-left hidden-sm hidden-xs">
                                                        <div class="wow bounceInUp" data-wow-duration="3s" data-wow-delay="1s">
                                                            <a href='apply-now' class='slider-button'>Apply Now!</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>  
                            </div>      
                        </div>
                    </div>
                </div>

                <!-- slider end -->
                <!-- blog area start -->
                <div class="blog-area ptb-35">
                    <div class="container">
                        <div class="tab-content row">
                            <div id="blog" role="tabpanel" class="active section-tab-item">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="single-blog">
                                        <div class="single-blog-img">
                                            <a href="#">
                                                <img src="img/collection/portal2_2.png" alt="blog">
                                            </a>
                                        </div>
                                        <div class="single-blog-info mt-25">
                                            <h4><a href="">Join the only first e campus in Kenya</a></h4>
                                            <p>The eCampus of Maseno University invites applications from suitably qualified candidates for certificate, diploma and degree programmes offered through eLearning. Several high quality modules leading to these programmes have been developed for roll out in the 2018 – 2019 Academic Year. </p>
                                            <div class="button-comments">
                                                <div class="read-button text-center">
                                                    <a class="read-more text-uppercase" href="javascript:void();">read More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                                <div class="comment-like">
                                                    <ul>
                                                        <li><a href="apply-now"><i class="fa fa-send-o"></i>Register Now! </a></li>
                                                    </ul>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="single-blog">
                                        <div class="single-blog-img">
                                            <a href="#">
                                                <img src="img/collection/intake.jpg" alt="blog">
                                            </a>
                                            <div class="blog-date text-center">
                                                <h2> <?php echo $formatted_year; ?> <span> <?php echo $formatted_month; ?></span></h2>    
                                            </div>
                                        </div>
                                        <div class="single-blog-info mt-25">
                                            <h4><a href="">Apply now for the <?php echo $formatted_month . ' ' . $formatted_year; ?> intake</a></h4>
                                            <p>We are currently receiving applications for the September 2018 Intake. Applications will be processed as they are received. Admissions will therefore be granted in the shortest time possible</p>
                                            <div class="button-comments">
                                                <div class="read-button text-center">
                                                    <a class="read-more text-uppercase" href="javascript:void();">read More <i class="fa fa-angle-double-right"></i></a>
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
                                <div class="col-md-4 hidden-sm col-xs-12">
                                    <div class="single-blog-list">
                                        <div class="blog-list-info single-blog-info mb-25">
                                            <h4><a href="javascript:void();">Our Vision</a></h4>
                                            <p>To be the leading provider of technology-based resources in order to expand opportunities for life-long learning</p>
                                        </div>
                                    </div>
                                    <div class="single-blog-list">
                                        <div class="blog-list-info single-blog-info mb-25">
                                            <h4><a href="javascript:void();">Our Mission</a></h4>
                                            <p>To realise a world where learners, lecturers, administrators, researchers and all stakeholders use Information and Communications Technologies (ICTs) to enhance the overall educational experience by improving flexibility and creativity, and by encouraging diverse, innovative and high-quality learning, teaching, research and management practices</p>
                                        </div>
                                    </div>
                                    <div class="single-blog-list">
                                        <div class="blog-list-info single-blog-info mb-25">
                                            <h4><a href="javascript:void();">About Maseno e Campus</a></h4>
                                            <p>The eCampus of Maseno University is one of the latest innovations by Maseno University to facilitate online delivery of high quality certificate, diploma and degree programmes to learners in various parts of the country, the East African region and beyond.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <hr>
                        <div class="row">
                            <!--News and events-->
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <div class="bg-ready">
                                    <h1 class="text-center">News and Events</h1>
                                    <div class="ja-box-ct clearfix">
                                        <div class="ja-sidenews-list clearfix">
                                            <div class="ja-slidenews-item">
                                                <!--iMAGE-->
                                                <img src="img/test/sam-12_140_100.jpg" alt="Proponents say Everyday Math adds up, though some don't understand how" title="Proponents say Everyday Math adds up, though some don't understand how" align="left">		  
                                                <!--TITLE-->
                                                <a class="ja-title" href="/index.php/news-and-events/103-proponents-say-everyday-math-adds-up-though-some-don-t-understand-how" style="font-family: vedana; font-size: 16px; margin-left: 10px; display: block;">Proponents say Everyday Math adds up, though some don't understand how</a>
                                                <!--CONTENT DATE-->
                                                <br><span class="ja-createdate" style="font-size: 10px; color: #666666; margin-left: 10px;">Monday, 13 August 2012</span><br>
                                                <br><p style=" font-family: serif; font-size: 14px; color: #333333; margin-left: 10px; display: block;">Vestibulum accumsan habitasse dictum id ut Curabitur amet libero mauris condimentum....</p>		  		  	  
                                            </div>
                                            <br>
                                            <div class="ja-slidenews-item">
                                                <!--IMAGE-->
                                                <img src="img/test/sam-13_140_100.jpg" alt="Forget about the mandate. Let’s fix health care" title="Forget about the mandate. Let’s fix health care" align="left">		  
                                                <!--TITLE-->
                                                <a class="ja-title" href="/index.php/news-and-events/102-forget-about-the-mandate-let-s-fix-health-care" style="font-family: vedana; font-size: 16px; margin-left: 10px; display: block; ">Forget about the mandate. Let’s fix health care</a>
                                                <!--CONTENT-->
                                                <br><span class="ja-createdate" style="font-size: 10px; color: #666666; margin-left: 10px;">Monday, 13 August 2012</span><br>
                                                <br><p style=" font-family: serif; font-size: 14px; color: #333333; margin-left: 10px; display: block;">Vestibulum accumsan habitasse dictum id ut Curabitur amet libero mauris condimentum....</p>		  		    
                                            </div>
                                            <br>
                                            <div class="ja-slidenews-item">
                                                <!--IMAGE-->
                                                <img src="img/test/sam-14_140_100.jpg" alt="Creative essay challenge inspires College community" title="Creative essay challenge inspires College community" align="left">		  
                                                <!--TITLE-->
                                                <a class="ja-title" href="/index.php/news-and-events/101-creative-essay-challenge-inspires-college-community" style="font-family: vedana; font-size: 16px; margin-left: 10px; display: block; ">Creative essay challenge inspires College community</a>
                                                <!--CONTENT-->
                                                <br><span class="ja-createdate" style="font-size: 10px; color: #666666; margin-left: 10px;">Monday, 13 August 2012</span><br>						
                                                <br><p style=" font-family: serif; font-size: 14px; color: #333333; margin-left: 10px; display: block;">Ut in lobortis Nulla Sed augue Morbi sem consequat a quis. Dui Quisque Aenean Vivamus...</p>		  		  		  
                                            </div>
                                        </div>		
                                    </div>
                                </div>
                            </div>
                            <!--End news and events-->
                            <!--Begin Features prof-->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="bg-ready">
                                    <h1 class="text-center">Featured professor</h1>
                                    <img src="img/test/Programme Coordinators Template-11.png" alt="" style="width: 150px; height: 150px;"/>
                                    <br>
                                    <img src="img/test/Programme Coordinators Template-04.png" alt="" style="width: 150px; height: 150px;"/>
                                </div>
                            </div>
                            <!--End Featured prof-->
                            <!--Begin Latest Upcoming Courses-->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="single-blog-list hidden-md">
                                    <div class="blog-date mr-25 text-center">
                                        <h2>09 <span>Sep</span></h2>    
                                    </div>
                                    <div class="blog-list-info single-blog-info mb-25">
                                        <h4><a href="javascript:void();">Latest Upcoming Course</a></h4>
                                        <p>This will be taught at our main campus ..</p>
                                        <ul class="list-group text-sm">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"><a href=""></i> Engineering Management Degrees</a></li>
                                            <hr class="divider">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"></i><a href="">Social Science Degrees</a></li>
                                            <hr class="divider">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"></i><a href="">Chemistry Degrees</a></li>
                                            <hr class="divider">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"></i><a href="">Engineering Degrees</a></li>
                                            <hr class="divider">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"></i><a href="">Computer Science Degrees</a></li>
                                            <hr class="divider">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"></i><a href="">Media Studies Degrees</a></li>
                                            <hr class="divider">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"></i><a href="">Biology Degrees</a></li>
                                            <hr class="divider">
                                            <li class=".list-group-item" style="font-size: 14px;"><i class="fa fa-angle-right" style="font-size:24px"></i><a href="">Business Degrees</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--End Latest Upcoming Courses-->
                        </div>
                        
                    </div>
                </div>
            </div>   
            <!-- blog area end -->
            <!-- testimonial area start -->
            <div class="testimonial-area pt-100 pb-45">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-sm-3 col-xs-12">
                            <div class="testimonial-left text-right">
                                <h2>From our Students</h2>
                                <p class="hidden-sm">We must take feedback from our students on their experience from our e-learning campuses</p>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-8 col-sm-9 col-xs-12">
                            <div class="testi-owl">
                                <div class="testimonial-right">
                                    <div class="testimonial-img">
                                        <img src="img/testimonial/1.jpg" alt="">
                                    </div>
                                    <div class="testimonial-info">
                                        <h3>Alinah Kiende, <span> Masters of Arts Degree in Social Development and Management </span></h3>
                                        <p>Maseno University eLearning is the best thing that ever happened to me. The orientation was a wonderful experience and I am excited to start my learning</p>
                                    </div>
                                </div>
                                <div class="testimonial-right">
                                    <div class="testimonial-img">
                                        <img src="img/testimonial/1.jpg" alt="">
                                    </div>
                                    <div class="testimonial-info">
                                        <h3>Aliu Aiyankhou Lucky, 
                                            <span> MA Monitoring and Evaluation Asaba, NIGERIA</span>
                                        </h3>
                                        <p>eLearning at the eCampus of Maseno University has given me the opportunity to go after my dream course while still keeping my job, as well as being with my family.</p>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <!-- testimonial area end -->
            <?php include_once('include/footerjs.php'); ?>
            <!-- footer start -->
            <?php include_once('include/footer.php'); ?>
            <!-- footer end -->
        </div>
    </div>    
    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="" src="img/product/static2.jpg">
                                </div>
                            </div><!-- .product-images -->

                            <div class="product-info">
                                <h1>Diam quis cursus</h1>
                                <div class="price-box">
                                    <p class="price"><span class="special-price"><span class="amount">$132.00</span></span></p>
                                </div>
                                <a href="javascript:void();" class="see-all">See all features</a>
                                <div class="quick-add-to-cart">
                                    <form method="post" class="cart">
                                        <div class="numbers-row">
                                            <input type="number" id="french-hens" value="3">
                                        </div>
                                        <button class="single-add-to-cart-button" type="submit">Add to cart</button>
                                    </form>
                                </div>
                                <div class="quick-desc">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum.
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
                                            <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .product-info -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>
    <!-- END QUICKVIEW PRODUCT -->
</body>
</html>