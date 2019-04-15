<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

// Retrieve SQL Data
if ($_POST['rowid']) {
    $postedid = $_POST['rowid'];
    $GetPCbcd = $common->GetRows("SELECT sm.*, sy.sys_name FROM tbl_sys_module_child sm LEFT JOIN tbl_sys_modules sy ON sy.id = sm.par_id WHERE `sm`.`id` = '{$postedid}'");
    foreach ($GetPCbcd as $InfoSc) {
        $SystemID = $InfoSc['par_id'];
        $SystemName = $InfoSc['sys_name'];
        $ModuleName = $InfoSc['name'];
        $group_access = $InfoSc['group_access'];
    }
}
?>
<form action="" method="post" id="Edit_System_Menu" name="Edit_System_Menu">
    <fieldset>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label> Choose System</label>
                        <select class="form-control select2" id="ESystem_Name" name="ESystem_Name" style="width: 100%;" required >
                            <option value="<?php echo $SystemID; ?>" selected><?php echo $SystemName; ?></option>
                        </select>
                        <input type="hidden" class="form-control" name="Hidden_ESystem_Module" id="Hidden_ESystem_Module" value="<?php echo $postedid; ?>" />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label> System Module</label>
                        <select class="form-control select2" id="ESystemModule" name="ESystemModule" style="width: 100%;" required>
                            <option value="<?php echo $postedid; ?>" selected><?php echo $ModuleName; ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="phoneno">Assigned User Groups</label>
                        <input name="Emenu_group_access" id="Emenu_group_access" class="form-control" placeholder="Enter one or multiple User Groups">
                        <input type="hidden" name="Emenu_group_accessE[]" id="Emenu_group_accessE" value="<?php echo $group_access; ?>"
                               class="form-control" placeholder="User Groups">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-info btn-lg w_full EditButton" name="EditButton" id="EditButton" style="float:center; margin-right: 2.6%;"
                        value="Edit/ Update Default Instituition Information"><span class="glyphicon glyphicon-check"></span> Edit System Module Access
                    </button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<!--Processing Submission -->
<div class="d_none" id="EditLoading_ID">
    <center class=" r_corners m_top_20">
        <h4 class="m_top_20 m_bottom_20">Please wait... Updating Module Details</h4>
        <img src="images/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
    </center>
</div>
<!--End Submission Processing -->
<!--Alert Successful -->
<div class="BCEditUpdateSuccessful d_none" style="margin: o auto;">
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-database"></i>Module Details has been successfully updated!</h4>
    </div>
</div>
<!--End Successful ALert -->
<script src="<?php echo ASSETS_URL; ?>/dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript">
    $(function () {
        $(".select2").select2();
    });
    // Deo Drops
    $(function () {
        $("#ESystemModule").depdrop({
            depends: ['ESystem_Name'],
            url: 'ajax-get-actions.php?GetModule=1'
        });
    });
    //Maggic Suggest
    var sp = $('#Emenu_group_accessE').val().split(',');
    var ms = $('#Emenu_group_access').magicSuggest({
        placeholder: 'Enter one or multiple User Groups',
        data: 'ajax-get-actions.php?UserGroups=1',
        valueField: 'usergroup_id',
        displayField: 'usergroup_name',
        dataUrlParams: {
            init: true,
            query: sp
        }
    });
    $(ms).on('load', function () {
        if (this._dataSet === undefined) {
            this._dataSet = true;
            ms.setValue(sp);
            ms.setDataUrlParams({});
        }
    });
</script>
<script type="text/javascript">
    //Start Form Validation
    jQuery().ready(function () {
        var v = jQuery("#Edit_System_Menu").validate({//Edit_System_Menu ESystem_Name ESystemModule Emenu_group_access Hidden_ESystem_Module
            rules: {
                ESystem_Module: {
                    required: true
                },
                ESystemModule: {
                    required: true
                },
                Emenu_group_access: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

    });
</script>
<script type="text/javascript">
    // Ajax Form Submission Starts
    $("form#Edit_System_Menu").submit(function (e) {
        e.preventDefault();
        if ($('#Edit_System_Menu').valid()) {
            $("#EditLoading_ID").show('fast');
            $('#Edit_System_Menu').hide("fast");
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'action.system-configuration.php',
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                    window.setTimeout(close, 1000);
                    window.setTimeout(showhome, 1000);
                    function close() {
                        $("#EditLoading_ID").hide('explode');
                        $('.BCEditUpdateSuccessful').show("fast");
                        $('.System_Menus_listing').show("fast");
                    }
                    function showhome() {
                        window.location.href = 'modules-access';
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
</script>