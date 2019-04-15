<?php
include_once('sys/core/init.inc.php');
$common=new common();

if(filter_has_var(INPUT_POST, "PCInfoID")) 
{ 
  try
  {                  
        $PCInfoID = $common->CCStrip($_POST['PCInfoID']);
        $Var = "UPDATE tbl_fee_upload_log SET isDeleted = 1 WHERE id = '{$PCInfoID}' ";
		//echo $Var;
        $common->Insert($Var);
  } catch (Exception $e) {echo $e; }
}

if(filter_has_var(INPUT_POST, "getCIID")) {
      $getCIID = $_REQUEST['getCIID'];
?>

<!-- // Assign Form Variables -->
<script type="text/javascript">
    // Cancel Edit Button
    $(".CancelPCOBtn").click(function(e) {
        e.preventDefault();
        $('#DefaultDeleteModal').modal('hide');
    });
</script>
<!--Start Students Update Form -->

<form role="form" action="" method="POST" name="PCConfirmForm" id="PCConfirmForm" enctype="multipart/form-data">
<div class="box-body">
    <div class="row m_top_20">
        <div class="col-lg-12">
            <input type="hidden" class="form-control" name="PCInfoID" id="PCInfoID"  value="<?php echo $getCIID; ?>" readonly>
            <h4 class="t_align_c" style="font-size: 16px;"> Confirm Delete Payment Record! This is Irreversible </h4>
        </div>
    </div><hr/>
</div>
<div class="box-footer">
    <div class="row m_bottom_20">
        <div class="col-lg-6">
            <span class="btn btn-info w_full CancelPCOBtn"><i class="fa fa-cogs" data-dismiss="modal"></i> Close </span>
        </div>
		<div class="col-lg-6">
            <button class="btn btn-danger w_full"  type="submit" name="Submit"><i class="fa fa-trash"></i> Delete Record </button>
        </div>
    </div>
</div><hr/>
</form>
<center id="EditLoading" class="d_none">
    <h4 class="m_top_10 m_bottom_20">Please wait... Processing your Request </h4>
    <img src="img/collection/loading-bar.gif" alt="Loading" style="max-width:160px;">
</center>
<?php
}
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#PCConfirmForm").submit(function (e) {
            e.preventDefault();
                $("#EditLoading").show('fast');
                $('#PCConfirmForm').hide("fast");
                var formData = $("#PCConfirmForm").serialize();
                $.ajax({
                    url: 'delete-payment-record.php',
                    type: 'POST',
                    data: formData,
                    success: function (data) {
						window.setTimeout(close, 1000);
						function close() {
							$('#PCConfirmForm')[0].reset();
							$("#EditLoading").hide('fast');
							$('#DefaultDeleteModal').modal('hide');
							$('#PeopleTableContainer').jtable('load');
						}
                    }
                });
            return false;
        });
    });
</script>
