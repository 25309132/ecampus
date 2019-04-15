<?php
//error_reporting(0);
include_once('sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: index");
}

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$LoggedUserID = $_SESSION['UID'];
$LoggedUserName = $_SESSION['UName'];
$StudentID = $common->CCGetDBValue("SELECT id FROM tbl_students WHERE admission_number =  '".$LoggedUserName."' ");
$AvailableBalance = $common->CCGetDBValue("SELECT floatAmount FROM tbl_students_float WHERE studentFID =  '".$StudentID."' ");
$HasPaidStatutory = $_REQUEST["HasPaidStatutory"];

?>

<div id="CoursesList" style="width: 100%;">
<!--Applications Listing starts -->
<div class="row">

  <div class="col-lg-12">

      <h1 class="m_top_40">Current Account Balance <span class="text-red" ><b> KES <?php echo number_format($AvailableBalance,2); ?></b></span> | Total Selected Courses Amount <span class="text-red"><b>KES <span class="TotalCoursesAmount"> 0.00 </span> </b></span></h1>
    <form id="CoursesForm" method="POST">
      <input type="hidden" name="studentFloatAmount" id="studentFloatAmount" value="<?php echo str_replace('.00', '',  $AvailableBalance); ?>">
      <input type="hidden" name="TotalCoursesAmount" id="TotalCoursesAmount" value="0">
      <input type="hidden" name="studentFID" id="studentFID" value="<?php echo $StudentID; ?>">
    </form>
    <hr />
  </div>
</div>

<div class="tab-pane active" id="LabTestsTab">
    <div class="row"> 

        <div class="col-md-7">
          <!--Start Patient Treatment Pagination Scripts -->
          <form class="contact-form d_none " name="LabTestsSearchForm" id="LabTestsSearchForm" action="" method="POST">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Course Name</label>
                    <input type="text" class="form-control" name="SearchLabTests" id="SearchLabTests"  value="" placeholder="Search Course Name" autocomplete="OFF">
                  </div>
                </div>
                <div class="col-md-4"> 
                  <div class="form-group" style="padding-top: 24px;">
                      <button type="submit" class="btn btn-primary w_full" name="submit" id="submit"><i class="fa fa-search"></i> Search Course</button>
                  </div>
                </div>
              </div>
          </form>
          <div id="LabTestsTabInfo"></div>
        </div>

        <div class="col-md-5 m_top_20"> 
            <!--POS Start -->
            <div class="col-md-12 m_top_10">
              <h4 class="pull-right">Selected Courses</h4>
            </div>
            
            <!--Start Session Listing -->
              <div id="DisplayLabTestCartItems"></div>
            <!--End Session Listing -->

            <div id="botbuttons" class="col-xs-12 text-center">
                  <div class="row">
                      <div class="col-xs-12" style="padding: 0;">
                        <div id="NoCorrection" class="">
                          <input type="hidden" name="SubmitLabTestsCartIN" id="SubmitLabTestsCartIN" value="1">
                          <button type="button" class="btn btn-success btn-block btn-flat SubmitLabTestsCart" id="SubmitLabTestsCart" style="height:67px;">Submit Course(s)</button>
                        </div>

                        <div id="AddCorrection" class="d_none"> 
                          <span class="btn btn-info btn-block btn-flat" style="height:67px;">Please Top Up Your Account Balance <br />or Reduce No of Courses!</button>
                        </div>

                      </div>
                  </div>
            </div>
            <!--POS Ends -->
        </div>

    </div> 
    <div class="row">
          <div class="col-md-12">
              <div id="LabTestsPagination" class="PaginationAccu">
                  <div><a href="#" id="1" class="LabTestsBtnPress"></a></div>
              </div>
          </div>
    </div> 
</div>

</div>
<script src="js/sweetalert2.min.js"></script>  
<script type="text/javascript">
  $(document).ready(function() {
    var HasPaidStatutory = '<?php echo $HasPaidStatutory; ?>';
    if(HasPaidStatutory === 0){
      var action = "add";
      var pid = "0";
      var ItemQty = "1";
      queryString = 'action=' + action + '&ItemID=' + pid + '&quantity=' + ItemQty;
      jQuery.ajax({
        url: "process-courses-cart.php",
        data: queryString,
        type: "POST",
        success: function (LoadUpProcCart) {
          $('#DisplayLabTestCartItems').html(LoadUpProcCart); 
          //  NoCorrection AddCorrection    studentFloatAmount TotalCoursesAmount
          var studentFloatAmount = $('#studentFloatAmount').val();
          var TotalCoursesAmount = $('#TotalCoursesAmount').val();
          if(parseFloat(studentFloatAmount) >= parseFloat(TotalCoursesAmount)){
            $('#NoCorrection').removeClass('d_none');
            $('#AddCorrection').addClass('d_none');
          }
          else{
            $('#NoCorrection').addClass('d_none');
            $('#AddCorrection').removeClass('d_none');
          } 
        },
        error: function () {
        }
    });
    }

  labTestsCartActionAdd('0')

  });
  // Process Search Form Scripts
  $("form#LabTestsSearchForm").submit(function (e) {
      e.preventDefault();
      if ($('#LabTestsSearchForm').valid()) {
        GetLabTestsPagination(1); 
      }
  });
  $('#LabTestsPagination').on('click', 'a', function (e) { // When click on a 'a' element of the pagination div
        GetLabTestsPagination(this.id); 
  });

  // Start Cart Scripts 
  function GetLabTestsPagination(GetPageID){
      var page = GetPageID;
      var SearchLabTests = $("#SearchLabTests").val();  
      
      var pagination = '';
      var data = {page: page, per_page: 8 };
      $.ajax({
          type: 'POST',
          url: 'fetch-courses-listing?SearchTSProcedure='+SearchLabTests,
          data: data,
          dataType: 'json', 
          success: function (data) {
              $("#LabTTabLoader").hide( "explode", {pieces: 4 }, 500 );
              $('#LabTestsSearchForm').show(); 
              if (data.numPage != 0) {
                  $('#LabTestsTabInfo').html('<div class="table-responsive"><table id="OtherProceduresTable" class="table table-bordered table-hover dataTable"><thead class="black-white-text"><th>Course</th><th><center>Code</center></th><th class="d_none"><center>Quantity</center></th><th><center>Fee</center></th><th><center>Action</center></th></tr></thead><tbody>' + data.LabTestsList + '</tbody></table></div>');
                  // Pagination system
                  if (page == 1) pagination += '<div class="cell_disabled"><span>First</span></div><div class="cell_disabled"><span>Previous</span></div>';
                  else pagination += '<div class="cell"><a href="#" id="1">First</a></div><div class="cell"><a href="#" id="' + (page - 1) + '">Previous</span></a></div>';

                  for (var i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {
                      if (i >= 1 && i <= data.numPage) {
                          pagination += '<div';
                          if (i == page) pagination += ' class="cell_active"><span>' + i + '</span>';
                          else pagination += ' class="cell"><a href="#" id="' + i + '">' + i + '</a>';
                          pagination += '</div>';
                      }
                  }
                  if (page == data.numPage) pagination += '<div class="cell_disabled"><span>Next</span></div><div class="cell_disabled"><span>Last</span></div>';
                  else pagination += '<div class="cell"><a href="#" id="' + (parseInt(page) + 1) + '">Next</a></div><div class="cell"><a href="#" id="' + data.numPage + '">Last</span></a></div>';
                  $('#LabTestsPagination').html('<div><a href="#" id="1" class="LabTestsBtnPress"></a></div>' + pagination);
              } else {

                  $('#LabTestsTabInfo').html(data.LabTestsList);
                  $('#LabTestsPagination').html('<div><a href="#" id="1" class="LabTestsBtnPress"></a></div>');
              }
          },
          error: function () {
          }
      });
      return false;
  }

  function labTestsCartAction(action, pid, ItemQty) {
    var queryString = "";
    if (action != "") {
      switch (action) {
          case "add":
              queryString = 'action=' + action + '&ItemID=' + pid + '&quantity=' + ItemQty;
              break;
          case "remove":
              queryString = 'action=' + action + '&ItemID=' + pid +'&quantity=' + ItemQty;
              break;
          case "empty":
              queryString = 'action=' + action;
          break;
      }
    }
    jQuery.ajax({
        url: "process-courses-cart.php",
        data: queryString,
        type: "POST",
        success: function (LoadUpProcCart) {
          $('#DisplayLabTestCartItems').html(LoadUpProcCart); 
          //  NoCorrection AddCorrection    studentFloatAmount TotalCoursesAmount
          var studentFloatAmount = $('#studentFloatAmount').val();
          var TotalCoursesAmount = $('#TotalCoursesAmount').val();

          if(parseFloat(studentFloatAmount) >= parseFloat(TotalCoursesAmount)){
            $('#NoCorrection').removeClass('d_none');
            $('#AddCorrection').addClass('d_none');
          }
          else{
            $('#NoCorrection').addClass('d_none');
            $('#AddCorrection').removeClass('d_none');
          }
        },
        error: function () {
        }
    });
}

var FstudentFloatAmount = $('#studentFloatAmount').val();
var FTotalCoursesAmount = $('#TotalCoursesAmount').val();

if(parseFloat(FstudentFloatAmount) >= parseFloat(FTotalCoursesAmount))
{
  $('#NoCorrection').removeClass('d_none');
  $('#AddCorrection').addClass('d_none');
}
else{
  $('#NoCorrection').addClass('d_none');
  $('#AddCorrection').removeClass('d_none');
}
function labTestsCartActionAdd(GItemID, GItemQty){
  // Get Procedure Quantity
  //var ItemQty = $('.LTqtyval'+GItemID).val();
    
  labTestsCartAction('add', GItemID, 1);
}

GetLabTestsPagination(1); 
labTestsCartAction('add', '0000' );
// Complete Cart Scripts


// Start SWAL Laboratory Tests Submission Scripts      
$(".SubmitLabTestsCart").click(function(e){
e.preventDefault();  
  var SubmitLabTestsCartIN = $("#SubmitLabTestsCartIN").val();
  swal({
      title: "Are you sure?",
      text: "Do you really want to Submit This Entry?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#fd302b",
      confirmButtonText: "Submit Data!",
      cancelButtonText: "Cancel Submission!",
      closeOnConfirm: false,
      closeOnCancel: true,
      customClass: 'custom-width'
  }).then(function () {
      var formData = $('#CoursesForm').serialize();
      $.ajax({
          type: 'POST',
          url: 'crud-processor?SubmitLabTestsCartIN='+SubmitLabTestsCartIN,
          data: formData,
          async: true

      }).done(function (data) {
        labTestsCartAction('empty');
        swal({
            title: "Success!",
            text: "Submission successfully logged.",
            type: "success",
            animation: "slide-from-top",
            showConfirmButton: true,
            timer: 2000
        });
    
      }).fail(function (data) {
          swal({
              title: "Error!",
              text: "Sorry. There was a problem Submitting Your Entry. Please try again or contact Systems administrator if the problem persists.",
              type: "error",
              animation: "slide-from-top",
              showConfirmButton: true
          });
      });
    }); 
});

</script>