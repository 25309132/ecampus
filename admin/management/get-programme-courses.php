<?php
include_once('../sys/core/init.inc.php');
$common = new common();
$QID = $_POST['GFID'];

$GetPC2 = $common->GetRows("SELECT * FROM tbl_programmes WHERE id = '{$QID}' ");
foreach ($GetPC2 as $gsdata2) 
{
    $programme_name = $gsdata2['programme_name'];
}
$GetTotalPrice = $common->CCGetDBValue("SELECT sum(`tc`.`course_price`) FROM tbl_courses `tc` INNER JOIN lookup_programmes_courses `tp` ON `tp`.`course_id` = `tc`.`id` WHERE `tp`.`programme_id` = '{$QID}' AND `tc`.`isActive` = 1;");
?>
<form class="contact-form cf-style-1" name="PVGDForm" id="PVGDForm" method="POST">
  <input type="hidden" class="form-control" name="Add_Programme_Course" id="Add_Programme_Course" value="<?php echo $QID; ?>">
  <input type="hidden" class="form-control" name="ItemId" id="ItemId">
  <fieldset>
    <div class="row">
      <div class="col-md-4">
        <label> Search Course By Name / Code  </label>
        <input type="text" id="SelectCourse" name="SelectCourse" class="form-control item-name" placeholder="Search Course By Name / Code" autocomplete="OFF">
      </div>
      <div class="col-lg-6"> 
        <div class="form-group">
          <label> Select Course Type: </label>
          <select class="form-control select2" name="SelectDepartments" id="SelectDepartments" multiple="multiple" data-placeholder="Select One or More Course Type" style="width: 100%;" required>
          <?php $UDSTT = $common->GetRows("SELECT id, course_type_name FROM `tbl_course_types` WHERE isActive = 1;");
          foreach($UDSTT as $UDSsTT) { ?>   
          <option value="<?php echo $UDSsTT['id']; ?>"><?php echo $UDSsTT['course_type_name']; ?></option><?php  } ?>
          </select>
        </div>
      </div>
      <div class="col-md-2">
          <button type="submit" class="btn btn-danger w_full" style="margin-top: 34px;" name="UpdateSOTBLID" id="UpdateSOTBLID"> <span class="glyphicon glyphicon-check"></span> Add Course </button>
      </div>
    </div>
</fieldset>
</form><hr />

<!--Load Up Data -->
<center id="PatientVitalsFSLoader" class="d_none r_corners m_bottom_20">
  <h4 class="m_top_20 m_bottom_20">Please wait... Processing your submission </h4>
  <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
</center>
<!--End Loading Up Data -->

<!-- /. Start Vitals Listing -->
<div id="PPNVitalsJTable"></div>
  <script type="text/javascript">
      $(document).ready(function () {
          $('#PPNVitalsJTable').jtable({
              title: '<i class="fa fa-list m_top_20 m_bottom_20"></i> <?php echo $programme_name; ?> | TOTAL PRICE: <?php echo number_format($GetTotalPrice, 0); ?>/=',
              paging: true,
              pageSize: 10,
              sorting: true,
              defaultSorting: 'id DESC',
              selecting: false, //Enable selecting
              actions: {
                  listAction: 'process-listings.php?GetMainProgrammeId=<?php echo $QID; ?>',
              },
              fields: {
                  id: {
                      title: 'ID',
                      width: '4%',
                      list: false
                  },
                  course_name: {
                      title: 'Course',
                      width: '25%'
                  },
                  course_code: {
                      title: 'Code',
                      width: '10%'
                  },
                  course_price: {
                    title: 'Price',
                      width: '10%'
                  },
                  isActive: {
                      title: 'Status',
                      width: '8%',
                      options: 'process-listings.php?action=status'
                  },
                  BtnDelete: {
                      title: 'Action',
                      width: '8%',
                      display: function (data) {
                          return '<?php $CreateButton = ($CanUPDATE == 0) ? '<center><button class="btn btn-danger btn-small" onclick="LoadUpDeleteModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-remove"></span> Remove </button></center>' : ''; echo $CreateButton; ?>';
                      }
                  },			  
              }
          });
          // Re-load records when user click 'load records' button.
          $('#LoadRecordsButton').click(function (e) {
              e.preventDefault();
              $('#PPNVitalsJTable').jtable('load', {
                  SearchUName: $('#SearchUName').val()
              });
          });
          //Load person list from server
          $('#PPNVitalsJTable').jtable('load');
      });
  </script>
<!-- /. End Vitals Listing -->
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
    
    $(function () {
        $(".select2").select2();
    });

    jQuery().ready(function() {
      var v = jQuery("#PVGDForm").validate({         
        rules: {  
            SelectDepartments: {
                required: true
            },
            SelectCourse: {
              required: true
            }
          }, 
          errorElement: "span",
          errorClass: "help-inline-error",
      });

    });

  jQuery(document).ready(function () {
      $("#PVGDForm").submit(function (e) {
        e.preventDefault();
        if($('#PVGDForm').valid()){  
          $("#PatientVitalsFSLoader").show('fast');
          $('#PVGDForm').hide("fast");
          var SelectData = $('#SelectDepartments').val();
          var formData = $("#PVGDForm").serialize();
          $.ajax({
              url: 'ajax-add-programme-courses.php?ugrps='+SelectData,
              //url: 'ajax-add-department.php',
              type: 'POST',
              data: formData,
              success: function (data) {
                  $("#PatientVitalsFSLoader").hide('fast');
                  $("#PVGDForm").show('fast');
                  $('#PPNVitalsJTable').jtable('load');
			            $('#PVGDForm')[0].reset(); 
              }
          });
        }
      });
  });
  // Start On Change Scripts
  $(document).on('keydown.autocomplete', '.item-name', function (e) {
      $(this).autocomplete({
          source: 'get-prerequisite-course.php', // The source of the AJAX results
          minLength: 2, // The minimum amount of characters that mu*!/st be typed before the autocomplete is triggered
          focus: function (event, ui) { // What happens when an autocomplete result is focused on
              $(this).val(ui.item.name);
              return false;
          },
          select: function (event, ui) { 
              // What happens when an autocomplete result is selected 
              $(this).val(ui.item.name);
              $('#ItemId').val(ui.item.id);
          }
      });
  });
  // End On Change Scripts
  function LoadUpDeleteModal(getProgrammeId) {
        $('#LoadUpDeletePCourseModal').modal({backdrop: 'static', keyboard: false});
        $.ajax({
            url: 'ajax-delete-prcourse.php?getProgrammeId=' + getProgrammeId,
            async: true,
            success: function (data) {
                $('.delete-pcourse-data').html(data);
            }
        });
    }
</script>