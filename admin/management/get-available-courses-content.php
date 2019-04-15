<?php
include_once('../sys/core/init.inc.php');
$common = new common();
?>
<style type="text/css">
  .Editable-Cell-Bg 
  {
    background-color: #c4fcd0;
    border-bottom: 2px solid #ffffff !important;
  }
</style>
<div class="row m_top_25">
<div class="col-md-12">
    <!-- SP Listing -->
    <div class="filtering"> 
        <form id="GetInsurancePaymentsForm" name="GetInsurancePaymentsForm" method="POST">
        <fieldset> 
            <div class="row">
                <div class="col-md-4"> 
                    <label> Select Academic Year </label> 
                    <select class="form-control select2" name="SelectYear" id="SelectYear" style="width: 100%; border-radius: 0; height:36px;">
                     <option value="">Select Academic Year </option>
                      <?php                                                     
                      foreach($common->GetRows("SELECT * FROM tbl_academic_years WHERE isActive = 1") as $A)
                      {
                      ?>
                        <option value="<?php echo $A["id"];?>"><?php echo $A["year"];?></option> 
                      <?php
                        }
                      ?>
                  </select>
                </div>  
                <div class="col-md-4"> 
                    <label> Select Semester </label> 
                    <select class="form-control select2" name="SelectSemester" id="SelectSemester" style="width: 100%; border-radius: 0; height:36px;">
                    </select>
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" id="PRecordsButton" class="btn submitform btn-info w_full"  name="submit" style="float:center; margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Retrieve Information
                        </button>
                    </div> 
                </div>
            </div> 
        </fieldset> 
      </form>
      <form id="SaveChequeFrm" name="SaveChequeFrm" method="POST">
        <fieldset class="ChequeDetailsTab d_none">
            <div >
              <h4 class="text-green" style="background-color: #ecf0f5; padding: 0px 10px 15px 10px; margin-bottom: 20px; height: 40px; line-height: 40px;"><i class="fa fa-qrcode"></i> Retrieved Available Courses <span class="pull-right text-red" style="font-size: 0.8em"> Total Courses: <span class="TotalChequesTxt">0</span></h4>
            </div>
            
            <div class="col-md-12">
              <!-- Editable Grid --> 
                <!-- Patients Listing Starts -->
                <div class="row">
                  <input type="text" name="SearchPatientName"  id="SearchPatientName" placeholder="Search Course By Name / Code" class="form-control m_bottom_20">
                </div>
                <div id="articleArea_Accu"></div>
                <!-- /. Patients Listing Ends -->
                <!--Pagination Starts-->
                <div class="row">
                    <div class="col-md-12">
                        <div id="pagination_accu">
                            <div><a href="#" id="1" class="finya-hapa"></a></div>
                        </div>
                    </div>
                </div>
                <!--Pagination Ends-->
              <!-- End Editable Grid -->
            </div>

        </fieldset>
      </form>
    </div> 
 
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="../js/dependent-dropdown.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {
        $(".select2").select2();
    });

    //AddInsuranceSchemeID AddInsuranceSchemeID
    $("#SelectSemester").depdrop({
        depends: ['SelectYear'],
        url: 'process-actions.php?GetSemester=1'
    });

    $("form#GetInsurancePaymentsForm").submit(function (e) {
        e.preventDefault(); 
        
        if ($('#GetInsurancePaymentsForm').valid()) {
            $(".ChequeDetailsTab").show();
            $("#pagination_accu a.finya-hapa").trigger('click'); //  Trigger A click When Form Is Clicked
        }

        // Get Total Cheques TotalChequesTxt
        var SelectSemester = $("#SelectYear").val();
        var SelectYear = $("#SelectSemester").val();
        var mydata = 'SelectYear='+SelectYear+'&SelectSemester='+SelectSemester;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "get-courses-retrieved?GetCoursesCount=1",
            data: mydata,
            success: function(data) {
            if( data["type"] == "error" ){ 
                  // Do Nothing
                  $(".TotalChequesTxt").text(data["errormsg"]); 
                } 
            else { 
                  $(".TotalChequesTxt").text(data["stockAmount"]); 
                }    
            },
              error: function(xhr, textStatus, errorThrown) {
            }
        });

    }); 

    function PaginatorFx(id){
       // When click on a 'a' element of the pagination div 
        //var page = this.id; // Page number is the id of the 'a' element
        var page = id; // Page number is the id of the 'a' element
        var pagination = ''; // Init pagination
        $('#articleArea_Accu').html('<center id="DefaultLoaderID"><hr /><h4 class="t_align_c">Please wait... Fetching Available Courses </h4><br /><img src="../img/loading-bar.gif" alt="Loader" width="80"/></center>'); // Display a processing icon
        var SearchPatientName = $("#SearchPatientName").val();
        var data = {page: page, per_page: 9, SearchPatientName: SearchPatientName}; // Create JSON which will be sent via Ajax
        // We set up the per_page var at 6. You may change to any number you need.
        var SelectSemester = $("#SelectSemester").val();
        var SelectYear = $("#SelectYear").val();
        $.ajax({ // jQuery Ajax
            type: 'POST',
            url: 'paginator-get-available-courses?SelectYear=' + SelectYear + '&SelectSemester=' + SelectSemester,
            data: data, // We send the data string
            dataType: 'json', // Json format
            timeout: 10000,
            success: function (data) {
                if(data.numPage != 0) {
                    $('#articleArea_Accu').html('<div class="box-body- row table-responsive"><table id="IncomeTypesTable" class="table table-bordered table-hover dataTable"><thead><tr><th>Programme</th><th> Course </th><th> Code </th><th> Price </th><th> Available </th><th>Actions</th></tr></thead><tbody>' + data.articleList + '</tbody></table></div>');
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
                    $('#pagination_accu').html('<div><a href="#" id="1" class="finya-hapa"></a></div>' + pagination); // We update the pagination DIV
                } else {
                    $('#articleArea_Accu').html(data.articleList);
                    $('#pagination_accu').html('<div><a href="#" id="1" class="finya-hapa"></a></div>');
                }
            },
            error: function () {
            }
        });
        return false;
    }
    
    // Insurance Patients Listing Starts
    $('#pagination_accu').on('click', 'a', function (e) {
      var id = this.id;
      PaginatorFx(id);
    });

    // Live Search On Key Up
    $("#SearchPatientName").on('keyup', function (e) {
       var id = 1;
       PaginatorFx(id);
    });

    // Update Course Price
    $("#articleArea_Accu").on("blur", ".availableQuantityClass", function () {
        var field_userid = this.id;
        var value = $(this).text();
        $.post('app.update-course-price.php', field_userid + "=" + value, function (data) {
            if (data != '') {
              //alert('Updated');
            }
        });
    });

    // Make available/Unavailable
    $(function () {
        $('#IncomeTypesTable').dataTable();
        $(document).on("click", " .delactionsbtn", function (e) {//user click on remove text
            e.preventDefault();
            var id = $(this).attr("href");
            $.post("action.enable.disable.php", {MakeUnavailable: id});
            $(".DeleteEntry" + id).css({"display": "none"});
            $(".EnableEntry" + id).show();
            if ($("#Status" + id).html() == 'In-Active') {
                $("#Status" + id).html('Active');
            } else {
                $("#Status" + id).html('In-Active');
            }
        });
        $(document).on("click", " .enactionsbtn", function (e) { //user click on remove text
            e.preventDefault();
            var id = $(this).attr("href");
            $.post("action.enable.disable.php", {MakeAvailable: id});
            $(".EnableEntry" + id).css({"display": "none"});
            $(".DeleteEntry" + id).show();
            if ($("#Status" + id).html() == 'In-Active') {
                $("#Status" + id).html('Active');
            } else {
                $("#Status" + id).html('In-Active');
            }
        });
    });
    
</script>