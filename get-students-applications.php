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

?>

<div id="CoursesList" style="width: 100%;">
  
  <div class="row">
    <div class="col-lg-12">
      <h1 class="m_top_40"><b> Courses I have registered for: </b></h1>
      <hr />
    </div>
  </div>

  <div class="col-md-12">
    <!-- /. Courses Listing Starts -->
    <div class="row">
      <input type="text" name="SearchPatientName"  id="SearchPatientName" placeholder="Search Course By Name or Code" class="form-control m_bottom_20">
    </div>
    <div id="articleArea_Accu"></div>
    <!-- /. Courses Listing Ends -->
    <!--Pagination Starts-->
    <div class="row">
        <div class="col-md-12">
            <div id="LabTestsPagination">
                <div><a href="#" id="1" class="finya-hapa"></a></div>
            </div>
        </div>
    </div>
    <!--Pagination Ends-->
  </div>

</div>
<script src="js/sweetalert2.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() {
      //  Trigger A click When Form Is Clicked
      $("#LabTestsPagination a.finya-hapa").trigger('click'); 

      //Select 2
      $(function () {
        $(".select2").select2();
      });

    });
  
    function PaginatorFx(id){
       // When click on a 'a' element of the pagination div 
        //var page = this.id; // Page number is the id of the 'a' element
        var page = id; // Page number is the id of the 'a' element
        var pagination = ''; // Init pagination
        $('#articleArea_Accu').html('<center id="DefaultLoaderID"><hr /><h4 class="t_align_c">Please wait... Fetching Students Courses Registered </h4><br /><img src="img/collection/loading-bar.gif" alt="Loader" width="80"/></center>'); // Display a processing icon
        var SearchPatientName = $("#SearchPatientName").val();
        var data = {page: page, per_page: 9, SearchPatientName: SearchPatientName}; // Create JSON which will be sent via Ajax
        // We set up the per_page var at 6. You may change to any number you need.
        $.ajax({ // jQuery Ajax
            type: 'POST',
            async: true,
            url: 'paginator-get-student-courses.php',
            data: data, // We send the data string
            dataType: 'json', // Json format
            timeout: 10000,
            success: function (data) {
                if(data.numPage != 0) {
                    $('#articleArea_Accu').html('<div class="box-body- row table-responsive m_top_20"><table id="IncomeTypesTable" class="table table-bordered table-hover dataTable"><thead class="black-white-text"><tr><th>Course Name</th><th>Code</th><th>Price</th><th>Transaction Ref</th><th>Date</th></tr></thead><tbody>' + data.articleList + '</tbody></table></div>');
                    // Pagination system
                    if (page == 1) pagination += '<div class="cell_disabled"><span>First</span></div><div class="cell_disabled"><span>Previous</span></div>';
                    else pagination += '<div class="cell"><a href="#" id="1">First</a></div><div class="cell"><a href="#" id="' + (page - 1) + '">Previous</span></a></div>';

                    for (var i = parseInt(page) - 9; i <= parseInt(page) + 9; i++) {
                        if (i >= 1 && i <= data.numPage) {
                            pagination += '<div';
                            if (i == page) pagination += ' class="cell_active"><span>' + i + '</span>';
                            else pagination += ' class="cell"><a href="#" id="' + i + '">' + i + '</a>';
                            pagination += '</div>';
                        }
                    }
                    if (page == data.numPage) pagination += '<div class="cell_disabled"><span>Next</span></div><div class="cell_disabled"><span>Last</span></div>';
                    else pagination += '<div class="cell"><a href="#" id="' + (parseInt(page) + 1) + '">Next</a></div><div class="cell"><a href="#" id="' + data.numPage + '">Last</span></a></div>';
                    $('#LabTestsPagination').html('<div><a href="#" id="1" class="finya-hapa"></a></div>' + pagination); // We update the pagination DIV
                } else {
                    $('#articleArea_Accu').html(data.articleList);
                    $('#LabTestsPagination').html('<div><a href="#" id="1" class="finya-hapa"></a></div>');
                }
            },
            error: function () {
            }
        });
        return false;
    }

    // Insurance Patients Listing Starts
    $('#LabTestsPagination').on('click', 'a', function (e) {
      var id = this.id;
      PaginatorFx(id);
    });

    // Live Search On Key Up
    $("#SearchPatientName").on('keyup', function (e) {
       var id = 1;
       PaginatorFx(id);
    });
    
</script>