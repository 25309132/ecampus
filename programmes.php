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
                              <div id="accordion" class="checkout">
                                <div class="panel checkout-step">
                                    <div> <span class="checkout-step-number">1</span>
                                        <h4 class="checkout-step-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >  Post-Graduate Programmes </a></h4>
                                    </div>
                                    <div id="collapseOne" class="collapse in">
                                        <div class="checkout-step-body">
                                            <p>We need your phone number so that we can update you about your order.</p>
                                            <a class="btn btn-default " role="button" data-toggle="collapse" href="#otp-verifaction"> Details </a>
                                            <div class="collapse" id="otp-verifaction">
                                                <div class="otp-verifaction">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <label class="col-md-12 control-label sr-only" for="Phone">Phone</label>
                                                                    <div class="col-md-3">
                                                                        <input id="number" name="number" type="text" placeholder="0" class="form-control input-md" required="">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input id="number" name="number" type="text" placeholder="0" class="form-control input-md" required="">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input id="number" name="number" type="text" placeholder="0" class="form-control input-md" required="">
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <input id="number" name="number" type="text" placeholder="0" class="form-control input-md" required="">
                                                                    </div>
                                                                </div>
                                                                <!-- Button -->
                                                                <div class="form-group">
                                                                    <label class="control-label sr-only" for="next">next</label>
                                                                    <div class="col-md-12">
                                                                        <a class="collapsed btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Next</a>
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
                                <div class="panel checkout-step">
                                    <div role="tab" id="headingTwo"> <span class="checkout-step-number">2</span>
                                        <h4 class="checkout-step-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" > Under-Graduate Programmes </a> </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="checkout-step-body">
                                            <div class="checout-address-step">
                                                <div class="row">
                                                    <form class="">
                                                        <!-- Multiple Radios (inline) -->
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label" for="address"></label>
                                                            <div class="col-md-12 ">
                                                                <label class="radio-inline" for="address-0">
                                                                    <input type="radio" name="address" id="address-0" value="Home" checked="checked"> Home </label>
                                                                <label class="radio-inline" for="address-1">
                                                                    <input type="radio" name="address" id="address-1" value="Office"> Office </label>
                                                                <label class="radio-inline" for="address-2">
                                                                    <input type="radio" name="address" id="address-2" value="Other"> Other </label>
                                                            </div>
                                                        </div>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label class="control-label" for="name">Name</label>
                                                                <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required="">
                                                            </div>
                                                        </div>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label" for="flat">Flat / House / Office No.</label>
                                                            <div class="col-md-12">
                                                                <input id="flat" name="flat" type="text" placeholder="address" class="form-control input-md" required="">
                                                            </div>
                                                        </div>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label" for="street">Street / Society / Office Name</label>
                                                            <div class="col-md-12">
                                                                <input id="street" name="street" type="text" placeholder="Street Address" class="form-control input-md">
                                                            </div>
                                                        </div>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label" for="Locality">Locality</label>
                                                            <div class="col-md-12">
                                                                <input id="Locality" name="Locality" type="text" placeholder="Ahmedabad" class="form-control input-md" required="">
                                                            </div>
                                                        </div>
                                                        <!-- Button -->
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <a class="collapsed btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> Next </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel checkout-step">
                                    <div role="tab" id="headingThree"> <span class="checkout-step-number">3</span>
                                        <h4 class="checkout-step-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"  > Time & Date </a> </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="checkout-step-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label" for="time">Time</label>
                                                    <div class="col-md-12">
                                                        <div class="radio">
                                                            <label for="time-0">
                                                                <input type="radio" name="time" id="time-0" value="8:00 - 9:00" checked="checked"> 8:00 - 9:00 </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="time-1">
                                                                <input type="radio" name="time" id="time-1" value="10:00 - 11:00"> 10:00 - 11:00 </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="time-2">
                                                                <input type="radio" name="time" id="time-2" value="12:00 - 1:00"> 12:00 - 1:00 </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label for="time-3">
                                                                <input type="radio" name="time" id="time-3" value="1:00 - 2:00"> 1:00 - 2:00 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="collapsed btn btn-default" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> Next </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel checkout-step">
                                    <div role="tab" id="headingFour"> <span class="checkout-step-number">4</span>
                                        <h4 class="checkout-step-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"  > Payment </a> </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse">
                                        <div class="checkout-step-body">
                                            Payment Mode
                                            <a href="#" class="btn btn-default">Proccess to payment</a>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
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
                                    </div>
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