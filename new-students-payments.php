<?php

include_once('sys/core/init.inc.php');
$common=new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
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
                                    <h4><b>APPLY NOW TO JOIN THE E-CAMPUS: <i style="font-style: italic;"> Please indicate your payment information and upload receipts if any. </i> </b></h4><hr />
                                    <p>
                                        Thank you for your interest in studying at the eCampus of Maseno University. <br/>
                                        Maseno University has intakes each year in January, May and September. Not all programmes admit students in all three intakes. <br/>
                                        You will be informed of the date of the next intake for your programme.<br/>
                                    </p>
                                    <p>
                                        To make payments, complete the form below with your payment details, upload receipts if any and submit. <br/>
                                    </p>
                                </div>
                                <div class="col-md-10" style="margin: -30px 0 -20px 80px;">
                                    <form class="contact-form cf-style-1" name="RaisePPOFormID" id="RaisePPOFormID" method="POST" action="" enctype="multipart/form-data" action="">
                                        <fieldset style="background: #F3F3F3;">
                                            <div class="row ptb-10">
                                                <div class="col-md-3">
                                                    <input id="StudentEmailAddress" type="email" class="form-control" name="StudentEmailAddress" placeholder="Registration Email Address" />
                                                    <input id="LogNewStudentPay" type="hidden" name="LogNewStudentPay" value="1" />
                                                </div>
                                                <div class="col-md-3">
                                                    <select id="AddPaymentTypeID" name="AddPaymentTypeID" class="form-control select2" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Choose Payment Type </option>
                                                        <?php $UDSTT = $common->GetRows("SELECT * FROM tbl_payment_options WHERE isActive = 1");
                                                        foreach ($UDSTT as $uatt) { ?>
                                                        <option value="<?php echo $uatt['id']; ?>"><?php echo $uatt['paymentOptionName']; ?></option>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="AddAmount" type="text" class="form-control" name="AddAmount" placeholder="Fee Amount" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="PaymentReference" type="text" class="form-control" name="PaymentReference" placeholder="Payment Reference" />
                                                </div> 
                                            </div>
                                            <div class="row ptb-10">
                                                <div class="col-md-6">
                                                    <label style="margin:0;" for="file-upload" class="custom-file-upload w_full btn bg-purple btn-info">
                                                        <i class="fa fa-cloud-upload"></i> Upload Receipt
                                                    </label>
                                                    <input id="file-upload" class="d_none" type="file" name="DocumentName"/>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <button type="submit" class="btn btn-success w_full submitBtn" name="submit"> <i class="fa fa-check-circle-o"></i> Submit Fee Payment Details</button>
                                                    </div>
                                                </div>
                                              </div>
                                        </fieldset>
                                    </form>
                                    <!--Load Up Data -->
                                    <center id="GetLoader" class="d_none r_corners m_bottom_20">
                                        <h4 class="m_top_20 m_bottom_20">Please wait... Submitting your Details</h4>
                                        <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                             style="max-width:160px;">
                                    </center>
                                    <!--End Loading Up Data -->
                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-12 ptb-35 single-blog-info" style="margin: 0 0 0 95px;">
                                    <h4><b> NOTE: </b></h4>
                                    <p> 
                                        Payments are processed as they are received. <br/> 
                                        Your payment will reflect into your student account after approval. <br/>
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
                <script type="text/javascript">
                  //Select 2
                  $(function () {
                    $(".select2").select2();
                  });

                  //File Upload preview
                  $('#file-upload').change(function() {
                    var i = $(this).prev('label').clone();
                    var file = $('#file-upload')[0].files[0].name;
                    $(this).prev('label').text(file);
                  });

                  jQuery().ready(function () {
                    var v = jQuery("#RaisePPOFormID").validate({
                        rules: {   
                            AddPaymentTypeID: {
                                required: true
                            },
                            AddAmount: {
                                number: true,
                                required: true
                            },
                            StudentEmailAddress: {
                                email: true,
                                required: true
                            }
                        },
                        errorElement: "span",
                        errorClass: "help-inline-error",
                    });
                  });

                  $("form#RaisePPOFormID").submit(function (e) {
                        e.preventDefault();
                        if ($('#RaisePPOFormID').valid()) {
                            $("#GetLoader").show('fast');
                            $('#RaisePPOFormID').hide("fast");
                            var formData = new FormData($(this)[0]);
                            $.ajax({
                                url: 'new-students-payments',
                                type: 'POST',
                                data: formData,
                                async: true,
                                success: function (data) {
                                    window.setTimeout(close, 500);
                                    function close() {
                                        $("#GetLoader").hide('explode');
                                        $('#RaisePPOFormID').show("fast");
                                        $('#RaisePPOFormID')[0].reset();
                                    }
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                        }
                    });
                </script>

                <?php
                  if(filter_has_var(INPUT_POST, "LogNewStudentPay"))
                  {
                    try  
                      {    
                      $AddPaymentTypeID =$common->CCStrip($_POST['AddPaymentTypeID']); 
                      $PaymentReference =$common->CCStrip($_POST['PaymentReference']); 
                      $StudentEmailAddress =$common->CCStrip($_POST['StudentEmailAddress']); 
                      $AddAmountF =$common->CCStrip($_POST['AddAmount']);  
                      $AddAmount = str_replace( ',', '', $AddAmountF ); 
                      $folderName = "img/payment/";

                      $AllowedFileTypes = array('image/png', 'image/jpeg','image/pjpeg','image/gif', 'application/csv', 'application/excel','application/vnd.ms-excel','application/vnd.msexcel','application/mspowerpoint','application/msword', 'application/pdf', 'application/rtf', 'application/vnd.ms-powerpoint', 'application/x-mspowerpoint', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.openxmlformats-officedocument.wordprocessingml.template' );
                       
                      if (in_array($_FILES["DocumentName"]["type"], $AllowedFileTypes))
                      {
                        $UploadedFile = is_uploaded_file($_FILES['DocumentName']['tmp_name']);
                        if ($UploadedFile){
                              $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['DocumentName']['name']));
                              $TheImageOne= strtotime("now").$safe_filename;
                              move_uploaded_file($_FILES['DocumentName']['tmp_name'], $folderName.$TheImageOne);
                            }
                        else {
                            
                            $TheImageOne = 'add.png';
                        }
                      } 
                      else
                      {
                          $TheImageOne = 'add.png';
                      }
                      $common->Insert("INSERT INTO fin_new_students_payments (studentEmail, paymentTypeID, paymentAmount, receiptFile, UIP, UPC, paymentReference) VALUES ('{$StudentEmailAddress}', '{$AddPaymentTypeID}','{$AddAmount}', '{$TheImageOne}','{$Remote}','{$RemoteBrowser}', '{$PaymentReference}' )");

                    } catch (Exception $e){echo $e;} 

                  } 
                ?>
            </div>
        </div>
    </body>
</html>