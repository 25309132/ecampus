<?php
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['UsersNames']; ?> | <?php echo $SystemName; ?></title>
    <?php include_once('../inc/inc.meta.php'); ?>
    <script src="<?php echo ASSETS_URL; ?>jtable/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL; ?>jtable/jquery.jtable.js" type="text/javascript"></script>
    <link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>

    <!-- Include one of jTable styles. -->
    <link href="<?php echo ASSETS_URL; ?>jtable/themes/jqueryui/jtable_jqueryui.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo ASSETS_URL; ?>jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .tisaini-tisaini {
            width: 98%;
        }
        .m_top_25 {
            margin-top: 25px;
        }
        label {
            margin-top: 10px;
        }
        .help-inline-error {
            color: red !important;
        }
        .pan_bg_accu {
            background-color: #8CC85C;
        }
    </style>
    <link rel="stylesheet" href="../css/formValidation.css"/>
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <header class="main-header">
        <?php include_once('../inc/inc.topheader.php'); ?>
    </header>
    
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include_once('../inc/stars-management-menu.php'); ?>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Students Applications </h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i> Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Students Applications </a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!--Lock User From Accessing This Page -->
                    <?php
                    if($CanVIEW == 1){
                    ?>
                    <!--Lock User From Accessing This Page -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#FacilitiesListTab" data-toggle="tab"><h4><i class="fa fa-bars"></i> Applications (Search &amp; Approve)</h4></a></li>
                        </ul>
                        <div class="tab-content">
                            
                            <div class="active tab-pane" id="FacilitiesListTab">
                                
                                <div class="d_none member-data-retrieval">
                                    <div class="row">
                                        <div class="col-md-6"><h4><i class="fa fa-check-circle-o"></i> Approve Students Application </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn  btn-success btn-md pull-right select-another-member">
                                                <span class="glyphicon glyphicon-check"></span> Select Another Application
                                            </button>
                                        </div>
                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                    </div>
                                    <!--Load Up Data -->
                                    <center id="RMDLoading_ID" class="d_none r_corners">
                                        <h4 class="m_top_20 m_bottom_20">Please wait... Fetching Students Application Details </h4>
                                        <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                    </center>
                                    <!--End Loading Up Data -->
                                    <div class="retrived-member-data"></div>
                                </div>

                                <!--Start Listing Facilities -->
                                <div class="filtering">
                                    <form>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-4"> 
                                                    <div class="form-group">
                                                        <label>Select Programme Type </label>
                                                        <select id="SelectProgramme" name="SelectProgramme" class="form-control select2" style="width: 100%;"><option value="" selected> Select Programme Type </option>
                                                        <?php 
                                                            $UDS = $common->GetRows("SELECT * FROM tbl_programme_types WHERE isActive = 1 ");
                                                            foreach($UDS as $UDSs)
                                                            {
                                                        ?>                          
                                                            <option value="<?php echo $UDSs['id']; ?>"><?php echo $UDSs['type']; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Search Students Details </label>
                                                        <input type="text" class="form-control" name="SearchFNameP" id="SearchFNameP" placeholder="Search Faclity Name/ Email/ Phone / Registration Number" autocomplete="OFF">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <button type="submit" id="LoadRecordsButton" class="btn  btn-info btn-md w_full" style="margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Search Records
                                                    </button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    
                                    <div id="PeopleTableContainer" style="width: 100%;"></div>
                                    <script type="text/javascript">

                                        $(document).ready(function () {
                                            $('#PeopleTableContainer').jtable({
                                                title: '<i class="fa fa-users m_top_20 m_bottom_20"></i> Completed Applications',
                                                paging: true,
                                                pageSize: 10,
                                                sorting: true,
                                                defaultSorting: 'id DESC',
                                                selecting: false, //Enable selecting
                                                //multiselect: true, //Allow multiple selecting
                                                //selectingCheckboxes: true, //Show checkboxes on first column
                                                //selectOnRowClick: false,
                                                actions: {
                                                    listAction: 'process-listings.php?action=GetStudentsList'
                                                },
                                                fields: {
                                                    id: {
                                                        key: true,
                                                        create: false,
                                                        edit: false,
                                                        list: false
                                                    },
                                                    student_image: {
                                                        title: 'Photo',
                                                        width: '5%',
                                                        display: function (data) {
                                                            var sphoto = data.record.facilityLogo;
                                                            if (sphoto == null || sphoto === '') {
                                                                sphoto = 'user_avatar.png';
                                                            }
                                                            else {
                                                                sphoto = data.record.facilityLogo;
                                                            }
                                                            return '<img src="../img/students/' + sphoto + '" width="50" class="img-thumbnail">';
                                                        }
                                                    },
                                                    surname: {
                                                        title: 'Surname',
                                                        width: '9%'
                                                    },
                                                    othernames: {
                                                        title: 'Othernames',
                                                        width: '9%'
                                                    },
                                                    personal_email: {
                                                        title: 'Email',
                                                        width: '9%'
                                                    },
                                                    phone_number: {
                                                        title: 'Phone',
                                                        width: '9%'
                                                    },
                                                    gender: {
                                                        title: 'Gender',
                                                        width: '5%'
                                                    },
                                                    application_status: {
                                                        title: 'Status',
                                                        width: '5%',
                                                        options: { '0': 'Pending', '1': 'Approved', '2': 'Declined' }
                                                    },
                                                    MyButton: {
                                                        title: 'Action',
                                                        width: '5%',
                                                        display: function (data) {
                                                            var GetStatus = data . record . application_status;
                                                            if(GetStatus == 0)
                                                            {
                                                                return '<?php $CreateButton=($CanUPDATE==1) ? '<center><button class="btn btn-success btn-small w_full" onclick="LoadUpModal(\' + data . record . id + \')"> Approve <span class="glyphicon glyphicon-chevron-right"></span></button></center>' : ''; echo $CreateButton; ?>';
                                                            }
                                                            else {
                                                                return '<?php $CreateButton=($CanVIEW==1) ? '<center><button class="btn btn-info btn-small w_full" onclick="LoadUpModal(\' + data . record . id + \')"> View <span class="glyphicon glyphicon-chevron-right"></span></button></center>' : ''; echo $CreateButton; ?>'; 
                                                            } 
                                                        }
                                                    },
                                                }
                                            });
                                            // Re-load records when user click 'load records' button.
                                            $('#LoadRecordsButton').click(function (e) {
                                                e.preventDefault();
                                                $('#PeopleTableContainer').jtable('load', {
                                                    SearchFNameP: $('#SearchFNameP').val(),
                                                    SelectProgramme: $('#SelectProgramme').val()
                                                });
                                            });
                                            //Load person list from server
                                            $('#PeopleTableContainer').jtable('load');
                                        });

                                    </script>
                                    <!--End Listing Facilities -->
                                </div>
                            </div>
                            </div>
                            </fieldset>
                            </form>
                            <!--End Adding Subjects -->
                            <!--Processing Submission -->
                            <center id="Loading_ID" class="d_none r_corners">
                                <h4 class="m_top_20 m_bottom_20"> Please wait... Processing Your Submission </h4>
                                <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                            </center>
                            <!--End Submission Processing -->

                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                    <?php
                        }
                    else
                        {
                    ?>
                      <div class="box box-danger box-solid">
                        <div class="box-header">
                          <h3 class="box-title">You Have No Access to the Contents of this Page</h3>
                        </div>
                        <div class="box-body">
                          Please Contact Systems Administrator!
                        </div>
                        <!-- /.box-body -->
                        <!-- Loading (remove the following to stop the loading)-->
                        <div class="overlay">
                          <i class="fa fa-database fa-spin"></i>
                        </div>
                        <!-- end loading -->
                      </div>
                    <?php
                      }
                    ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
        
        <!--Footer Starts -->
            <?php include_once('../inc/inc.footertext.php'); ?>
        <!--Footer Ends-->

    </div>
    <!-- /.content-wrapper -->
    
</div>

<!-- Footer JS  -->
<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript">

    $(".select-another-member").click(function (e) {
        e.preventDefault();
        $('.filtering').show();
        $('#RMDLoading_ID').hide();
        $('.member-data-retrieval').hide();
    });

    function LoadUpModal(GetFDID) {
        $('.filtering').hide();
        $('#RMDLoading_ID').show();
        $('.member-data-retrieval').show();
        // Load Up Member Data
        $.ajax({
            type: 'post',
            url: 'get-application-details',
            async: true,
            data: 'GFID='+GetFDID,
            success: function (data) {
                $('#RMDLoading_ID').hide();
                $('.retrived-member-data').html(data);
            }
        });
    }

    $(function () {
        $(".select2").select2();
    });

</script>
</body>
</html>