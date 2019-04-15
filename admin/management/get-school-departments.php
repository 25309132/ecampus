<?php
include_once('../sys/core/init.inc.php');
$common = new common();
$QID = $_POST['GFID'];

?>
<form class="contact-form cf-style-1 m_bottom_40" name="PVGDForm" id="PVGDForm" method="POST">
  <input type="hidden" class="form-control" name="Add_Department_To_School" id="Add_Department_To_School" value="<?php echo $QID; ?>">
  <fieldset>
    <div class="row">
        <div class="col-lg-8"> 
          <div class="form-group">
            <label>Select Department(s):</label>
            <select class="form-control select2" name="SelectDepartments" id="SelectDepartments" multiple="multiple" data-placeholder="Select One or More Department(s)" style="width: 100%;" required>
            <?php $UDSTT = $common->GetRows("SELECT id, department_name FROM `tbl_departments` WHERE isActive = 1;");
            foreach($UDSTT as $UDSsTT) { ?>   
            <option value="<?php echo $UDSsTT['id']; ?>"><?php echo $UDSsTT['department_name']; ?></option><?php  } ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-danger w_full" style="margin-top: 34px;" name="UpdateSOTBLID" id="UpdateSOTBLID"> <span class="glyphicon glyphicon-check"></span> Add Department(s) </button>
        </div>
    </div>
</fieldset>
</form>

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
              title: '<i class="fa fa-list m_top_20 m_bottom_20"></i> Departments ',
              paging: true,
              pageSize: 10,
              sorting: true,
              defaultSorting: 'id DESC',
              selecting: false, //Enable selecting
              actions: {
                  listAction: 'process-listings.php?GetMainProviderId=<?php echo $QID; ?>',
              },
              fields: {
                  id: {
                      title: 'ID',
                      width: '4%',
                      list: false
                  },
                  department_id: {
                      title: 'Department',
                      width: '20%',
                      options: 'process-listings.php?action=departments'
                  },
                  description: {
                      title: 'Description',
                      width: '25%'
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
                          return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-danger btn-small" onclick="LoadUpDeleteModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-remove"></span> Remove </button></center>' : ''; echo $CreateButton; ?>';
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
              url: 'ajax-add-department.php?ugrps='+SelectData,
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

</script>