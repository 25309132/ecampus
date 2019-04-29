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
                            <!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Fee for eLearning Students</h2>

<table>
  <tr>
    <th colspan="4">UNDER-GRADUATE PROGRAMMES</th>
       </tr>
  <tr>
    <th></th>
    <th>Yearly Statutory Fee</th>
    <th>Per Module Fee</th>
    <th>Total for 56 Modules</th>
  </tr>
  <tr>
    <td>Tuition	</td>
    <td>	</td>
    <td>4500</td>
    <td></td>
    
   
  </tr>
    <tr>
    <td>Examination</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Registration	</td>
    <td>1000</td>
    <td></td>
        <td></td>

  </tr>
  <tr>
    <td>Student ID	</td>
    <td>400</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Material Development	</td>
    <td></td>
    <td>600</td>
    <td></td>

  </tr>
  <tr>
    <td>Library access fee	</td>
    <td>1000</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Online Orientation and support	</td>
    <td>500</td>
    <td></td>
    <td></td>

  </tr>
   <tr>
    <td></td>
    <td>2,900 OR
(USD($)) 50</td>
    <td>5,600 OR
(USD($)) 75</td>
    <td></td>

  </tr>
  <tr>
<td colspan="3"><b>Total (Excluding statutory fee):</b></td>
<td><span class="Tabletitles"><b>313,600 OR<br />
(USD($)) 4,200</b></span></td>
</tr>


</table><br><br>
Note:

ABA 330: Indusrial attachment is a mandatory unit for students taking Bachelor of Business Administration (BBA, with IT). b bv   The unit draws an extra fee of Kes 4, 400.<br><br>
<table>
  <tr>
    <th colspan="4">POST-GRADUATE PROGRAMMES</th>
       </tr>
  <tr>
    <th></th>
    <th>Yearly Statutory Fee</th>
    <th>Per Module Fee</th>
    <th>Total for 56 Modules</th>
  </tr>
  <tr>
    <td>Tuition	</td>
    <td>	</td>
    <td>3000</td>
    <td></td>
    
   
  </tr>
    <tr>
    <td>Examination</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Registration	</td>
    <td>1000</td>
    <td></td>
        <td></td>

  </tr>
  <tr>
    <td>Student ID	</td>
    <td>400</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Material Development	</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Library access fee	</td>
    <td>1000</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Online Orientation and support	</td>
    <td>500</td>
    <td></td>
    <td></td>

  </tr>
   <tr>
    <td></td>
    <td>2,900 OR
(USD($)) 50</td>
    <td>4,000 OR 
(USD($)) 60</td>
    <td></td>

  </tr>
  <tr>
<td colspan="3"><b>Total (Excluding statutory fee):</b></td>
<td><span class="Tabletitles"><b>76,000 OR 
(USD($)) 1, 140</b></span></td>
</tr>


</table><br><br>
<table>
  <tr>
    <th colspan="4">    Master of Science in Quantitative Research Methods (eRM)
</th>
MASTERS PROGRAMMES
       </tr>
  <tr>
    <th></th>
    <th>Yearly Statutory Fee</th>
    <th>Per Module Fee</th>
    <th>Total for 56 Modules</th>
  </tr>
  <tr>
    <td>Tuition	</td>
    <td>	</td>
    <td>11000</td>
    <td></td>
    
   
  </tr>
    <tr>
    <td>Examination</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Registration	</td>
    <td>1000</td>
    <td></td>
        <td></td>

  </tr>
  <tr>
    <td>Student ID	</td>
    <td>400</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Material Development	</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Library access fee	</td>
    <td>1000</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Online Orientation and support	</td>
    <td>500</td>
    <td></td>
    <td></td>

  </tr>
   <tr>
    <td></td>
    <td>2,900 OR
(USD($)) 50</td>
    <td>Ksh 12,500 OR 
(USD($)) 170</td>
    <td></td>

  </tr>
  <tr>
<td colspan="3"><b>Total (Excluding statutory fee):</b></td>
<td><span class="Tabletitles"><b>Ksh 200,000 OR 
(USD($)) 2,720</b></span></td>
</tr>


</table><br><br>
<table>
  <tr>
    <th colspan="4">    Master of Public Health (MPH)

</th>
MASTERS PROGRAMMES
       </tr>
  <tr>
    <th></th>
    <th>Yearly Statutory Fee</th>
    <th>Per Module Fee</th>
    <th>Total for 56 Modules</th>
  </tr>
  <tr>
    <td>Tuition	</td>
    <td>	</td>
    <td>15000</td>
    <td></td>
    
   
  </tr>
    <tr>
    <td>Examination</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Registration	</td>
    <td>1000</td>
    <td></td>
        <td></td>

  </tr>
  <tr>
    <td>Student ID	</td>
    <td>400</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Material Development	</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Library access fee	</td>
    <td>1000</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Online Orientation and support	</td>
    <td>500</td>
    <td></td>
    <td></td>

  </tr>
   <tr>
    <td></td>
    <td>2,900 OR 
(USD($)) 50</td>
    <td>Ksh 12,500 OR 
(USD($)) 170</td>
    <td></td>

  </tr>
  <tr>
<td colspan="3"><b>Total (Excluding statutory fee):</b></td>
<td><span class="Tabletitles"><b>256,000 OR 
(USD($)) 3,520</b></span></td>
</tr>


</table><br><br>
<table>
  <tr>
    <th colspan="4">    Master of Arts in Project Planning and Management<br>
Master of Arts in Monitoring and Evaluation

<!--/th>
MASTERS PROGRAMMES
       </tr-->
  <tr>
    <th></th>
    <th>Yearly Statutory Fee</th>
    <th>Per Module Fee</th>
    <th>Total for 56 Modules</th>
  </tr>
  <tr>
    <td>Tuition	</td>
    <td>	</td>
    <td>13 300</td>
    <td></td>
    
   
  </tr>
    <tr>
    <td>Examination</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Registration	</td>
    <td>1000</td>
    <td></td>
        <td></td>

  </tr>
  <tr>
    <td>Student ID	</td>
    <td>400</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Material Development	</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Library access fee	</td>
    <td>1000</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Online Orientation and support	</td>
    <td>500</td>
    <td></td>
    <td></td>

  </tr>
   <tr>
    <td></td>
    <td>2,900 OR 
(USD($)) 50</td>
    <td>14,300 OR 
(USD($)) 200</td>
    <td></td>

  </tr>
  <tr>
<td colspan="3"><b>Total (Excluding statutory fee):</b></td>
<td><span class="Tabletitles"><b>228,800 OR 
(USD($)) 3,200</b></span></td>
</tr>


</table><br><br>
<table>
  <tr>
    <th colspan="4">    Master of Arts in Social Policy
Master of Arts in Social Development and Management<br>
Master of Education in Educational Administration<br>
Master of Education in Guidance and Counselling<br>
Master of Education in Educational Psychology

<!--/th>
MASTERS PROGRAMMES
       </tr-->
  <tr>
    <th></th>
    <th>Yearly Statutory Fee</th>
    <th>Per Module Fee</th>
    <th>Total for 56 Modules</th>
  </tr>
  <tr>
    <td>Tuition	</td>
    <td>	</td>
    <td>11 500</td>
    <td></td>
    
   
  </tr>
    <tr>
    <td>Examination</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Registration	</td>
    <td>1000</td>
    <td></td>
        <td></td>

  </tr>
  <tr>
    <td>Student ID	</td>
    <td>400</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Material Development	</td>
    <td></td>
    <td>500</td>
    <td></td>

  </tr>
  <tr>
    <td>Library access fee	</td>
    <td>1000</td>
    <td></td>
    <td></td>

  </tr>
  <tr>
    <td>Online Orientation and support	</td>
    <td>500</td>
    <td></td>
    <td></td>

  </tr>
   <tr>
    <td></td>
    <td>2,900 OR 
(USD($)) 50</td>
    <td>12,500 OR 
(USD($)) 170</td>
    <td></td>

  </tr>
  <tr>
<td colspan="3"><b>Total (Excluding statutory fee):</b></td>
<td><span class="Tabletitles"><b>200,000 OR 
(USD($)) 2, 720</b></span></td>
</tr>


</table><br><br>
<table>
  <tr>
    <th colspan ="2">Certificate in Basic Statistics (eStats)</th>
   
   
  </tr>
  <tr>
    <td>Per Module Fees:</td>
    <td>25,000</td>

  </tr>
  <tr>
    <td>Number of Modules:</td>
    <td>1</td>
   
  </tr>
  <tr>
    <td>Total (Excluding statutory fee):</td>
    <td>25,000 OR 
(USD($)) 340</td>
   
  </tr>
  
</table><br><br>
<table>
  <tr>
    <th colspan ="2">Certificate in Bridging Mathematics</th>
   
   
  </tr>
  <tr>
    <td>Fees:</td>
    <td>25,000</td>

 
 
   
  </tr>
    
  </tr>
  <tr>
    <td>Total (Excluding statutory fee):</td>
    <td>25,000 OR 
(USD($)) 340</td>

 
 
   
  </tr>
  
</table>

</body>
</Fee Structure
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