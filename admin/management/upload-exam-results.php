<?php
include_once('../sys/core/init.inc.php');
$common=new common();

?>
<!DOCTYPE html>

<html>

<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $_SESSION['UsersNames']; ?> | <?php echo $SystemName; ?></title>
	<?php include_once('../inc/inc.meta.php'); ?>
	<!-- Include one of jTable styles. -->
	<script src="<?php echo ASSETS_URL; ?>jtable/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS_URL; ?>jtable/jquery.jtable.js" type="text/javascript"></script>
	<link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.theme.css" rel="stylesheet" type="text/css" />
	<!-- Include one of jTable styles. -->
	<link href="<?php echo ASSETS_URL; ?>jtable/themes/jqueryui/jtable_jqueryui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ASSETS_URL; ?>jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ASSETS_URL; ?>css/sweetalert2.min.css" rel="stylesheet" type="text/css"></script>

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
	  <h1> Upload Students Exam Results </h1>
	  <ol class="breadcrumb">
		<li><a href="dashboard"><i class="fa fa-home"></i>Home/ Module Select</a></li>
		<li><a href="javascript:void(0);"><i class="fa fa-briefcase"></i>  Upload Students Exam Results </a></li>
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
		  <div class="nav-tabs-custom border_grey">
			<ul class="nav nav-tabs pull-right"> 
			  <li class="pull-left active"><a href="#Listing" data-toggle="tab"><h4><i class="fa fa-bars"></i> Upload Students Exam Results </h4></a></li>
			  <li class="pull-right"><a href="#AddNewBanks" data-toggle="tab"><h4><i class="fa fa-plus"></i> View Previously Uploaded Exam Results </h4></a></li>
			</ul>
			<div class="tab-content">
			  <div class="active tab-pane" id="Listing">
				  <fieldset>
					<div id="Raw_Lactoscope_Data row">
					  <form role="form" action="" method="POST" id="Upload_Exams_Form" name="Upload_Exams_Form" enctype="multipart/form-data">
						<div class="row">
						  	<div class="col-md-3"> 
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
			                <div class="col-md-3"> 
			                    <label> Select Semester </label> 
			                    <select class="form-control select2" name="SelectSemester" id="SelectSemester" style="width: 100%; border-radius: 0; height:36px;">
			                    </select>
			                </div> 
						  	<div class="col-md-3">
							  	<label for="file-upload" class="custom-file-upload w_full btn bg-purple" style="margin-top: 34px;"><i class="fa fa-cloud-upload"></i> Upload Exam Results
                                </label>
                                <input id="file-upload" accept=".csv" type="file" class="d_none" name="file"/>
						  </div>
						  <div class="col-md-3">
							  <div class="form-group">
								   <button type="submit" class="btn btn-info w_full m_top_20" name="Submit_Lactoscope_Advanced" style="float:center; margin-right: 2.6%; margin-top: 34px;"> Submit </button>
							  </div>
						  </div>
						</div>
					  </form>
				  </form>
				  <center id="LACT_MANUAL">
					<p class="t_align_c"> Ensure to Prepare your .csv files and upload as per the Manual Below </p>
						<a href="javascript:void(0);" data-toggle="modal" data-target="#Lactoscope_MODAL" >
							<p class="m_top_10 t_align_c"><i class="fa fa-info-circle fa-x"></i> Click Here for Exams Upload File Upload Help </p>
						</a>
				  </center>
				  <center  id="LoadingP_ID" class="d_none r_corners">
					<h4 class="m_top_20 m_bottom_20">Please wait... Processing Your Submission </h4>
					<img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
				  </center>
				  </div>
				</fieldset>
				<!--End Activity Content -->
				<div class="uploaded-data"></div> 
			  </div> 
			  <div class="tab-pane" id="AddNewBanks"> 
				 <form class="m_top_20 m_bottom_20">
					<div class="row"> 
						<div class="col-md-3"> 
		                	<label> Select Academic Year </label> 
		                    <select class="form-control select2" name="SearchYearID" id="SearchYearID" style="width: 100%; border-radius: 0; height:36px;">
		                    <option value=""> Select Academic Year </option>
		                      <?php foreach($common->GetRows("SELECT * FROM tbl_academic_years WHERE isActive = 1") as $A)
		                      	{ ?>
		                        	<option value="<?php echo $A["id"];?>"><?php echo $A["year"];?></option> 
		                    <?php } ?>
		                  </select>
		                </div>
		                <div class="col-md-3"> 
		                	<label> Select Semester </label> 
		                    <select class="form-control select2" name="SearchSemesterID" id="SearchSemesterID" style="width: 100%; border-radius: 0; height:36px;">
		                    <option value=""> Select Semester </option>
		                      <?php foreach($common->GetRows("SELECT * FROM tbl_semesters WHERE isActive = 1") as $A)
		                      	{ ?>
		                        	<option value="<?php echo $A["id"];?>"><?php echo $A["semester"];?></option> 
		                    <?php } ?>
		                  </select>
		                </div> 
		                <div class="col-md-3">
		                	<label>Search By Registration Number</label>
		                	<input type="text" class="form-control" id="SearchStudentReg" name="SearchStudentReg" placeholder="Search By Registration Number" />
		                </div>
					  	<div class="col-md-3">
					  		<button type="submit" id="LoadRecordsButton" class="btn btn-info btn-md w_full" style="float:center; margin-right: 2.6%; margin-top: 34px;"> <span class="glyphicon glyphicon-search"></span> Search </button>
					  	</div>
					</div>
				</form>
				<div id="StudentsTable"> <!--Start Students Table-->
				 <div id="PeopleTableContainer" style="width: 100%;"></div>
				  <script type="text/javascript">
					$(document).ready(function () {
					  $('#PeopleTableContainer').jtable({
						title: '<i class="fa fa-bars m_top_20 m_bottom_20"></i> Uploaded Students Results <button style="float: right; margin: 10px;" class="btn btn-danger" type="button" id="GenerateBarcodes"><i class="fa fa-trash-o"></i> Delete Selected </button>',
						paging: true,
						pageSize: 10,
						sorting: true,
						selecting: true, //Enable selecting
                        multiselect: true, //Allow multiple selecting
                        selectingCheckboxes: true, // Show checkboxes on first column
                        selectOnRowClick: true,
						defaultSorting: 'id DESC',
						actions: {
						  listAction: 'process-listings.php?action=uploadedresults'
						},
						fields: {
						  id: {
							key: true,
							create: false,
							edit: false,
							delete: true,
							list: false,
							title: 'ID',
							width: '5%'
						  },
						  yearID: {
							title: 'Year',
							width: '10%',
							options: 'process-listings.php?action=getyears'
						  },
						  semesterID:{
							title: 'Semester',
							width: '5%',
							options: 'process-listings.php?action=getsemesters'
						  },
						  studentRegNo: {
							title: 'Student_REG',
							width: '7%'
						  },
						  courseCode: {
							title: 'Course_Code',
							width: '5%'
						  },
						  catScore: {
							title: 'CAT',
							width: '7%'
						  },
						  examScore: {
							title: 'EXAM',
							width: '7%',
						  },
						  dateUploaded: {
							title: 'Upload Date',
							width: '10%'
						  },
						  MyButton: {
							title: 'Action',
							width: '5%',
							display: function(data) {
							var GetIfDeleted = data.record.iDeleted;
								if(GetIfDeleted == 1) {
									 return '<center> <h4 style="color:red;"> Deleted </h4></center>';
								}
								else {
								 return '<?php $EditButton=($CanDELETE==1) ? '<center><button class="btn btn-danger btn-sm w_full" onclick="LoadUpDeleteModal(\' + data.record.id + \')"> <span class="glyphicon glyphicon-trash"></span>  Delete </button></center>' : ''; echo $EditButton; ?>';
								}
							}
						 },
						}
					});

			  		// Re-load records when user click 'load records' button. 
				  	$('#LoadRecordsButton').click(function (e) {
					  e.preventDefault();
					  $('#PeopleTableContainer').jtable('load', {
						  SearchSemesterID: $('#SearchSemesterID').val(),
						  SearchYearID: $('#SearchYearID').val(),
						  SearchStudentReg: $('#SearchStudentReg').val()
					  });
				  	});

					  //Load person list from server
					  $('#PeopleTableContainer').jtable('load');
					  // Process Selects on click of the select Button
                        $('#GenerateBarcodes').on('click', function (e) {
                            e.preventDefault();
                            var $selectedRows = $('#PeopleTableContainer').jtable('selectedRows');
                            var TotalItems = $selectedRows.length; 
                            if ($selectedRows.length > 0){ 
	                            swal({
			                        title: "Are you sure?",
			                        text: "Do you really want to delete? This is irreversable!",
			                        type: "warning",
			                        showCancelButton: true,
			                        confirmButtonColor: "#fd302b",
			                        confirmButtonText: "Yes, delete",
			                        cancelButtonText: "No, do not delete",
			                        closeOnConfirm: false,
			                        closeOnCancel: true,
			                        customClass: 'custom-width'
			                        }).then(function () {
			                        	$selectedRows.each(function () { 
		                                  	varIID = $(this).data('record').id;
		                                  	dataPost = 'IWBID='+varIID;    
		                                  	TotalItems--;
					                        $.ajax({
		                                        url: 'delete-bulk-items.php?DeleteItems=1',
		                                        type: 'POST',
		                                        data: dataPost,
		                                        async: true
					                        }).done(function (data){
					                        //Reload Jtable
					                        $('#PeopleTableContainer').jtable('load');
					                        swal({
					                            title: "Success!",
					                            text: "Your selected item(s) have been deleted!",
					                            type: "success",
					                            animation: "slide-from-top",
					                            showConfirmButton: true,
					                            timer: 2500
					                        });
										});

			                        //Show delete error on fail
			                        }).fail(function (data) {
			                            swal({
			                                title: "Error!",
			                                text: "Sorry. There was a problem Submitting Your Entry. Please try again or contact Systems administrator if the problem persists.",
			                                type: "error",
			                                animation: "slide-from-top",
			                                showConfirmButton: true
			                          	});
			                      	});
			                   	}); // Swal question
                            }
                            else {
                                swal({
                                    title: "Alert!",
                                    text: "Please select item(s) to delete!",
                                });
                            }
                        });

					});
				  </script>
				</div> <!--End Students Table-->
			  </div><hr />
			</div>
			<!-- /.tab-content -->
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
	   
	  <!--End Confirm Approval Modal-->
	  <div class="modal fade" id="Lactoscope_MODAL" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"> Exams Upload File Upload Help Manual</h4>
				</div>
					<div class="modal-body">
						<ol>
							<li>Prepare your .csv file with the columns in the following order; 
								<ul>
									<li>Serial </li>   
									<li>Student Registration (e.g EGH/110009/2019)</li>
									<li>Course Code</li>
									<li>CAT</li>
									<li>EXAM</li>
								</ul>
								You can get a sample .csv file <code><a href="samples/ExamsUploadSample.csv" target="_blank">Here</a></code>
							</li>
							<li>Save the file as .csv, Click on Browse to select the file and upload it. </li>
							<li>Select the corresponding year and semester and submit the details</li>
							<li>Duplicate entries will be highlighted in Red for entries already submitted. <br />The Duplicate entries are based on the <b>Student Registration (Column 2)</b> and the <b>Course Code (Column 3)</b> for the chosen year and semester</li>
						</ol>
					</div>
					<div class="modal-footer clearfix">
						<button type="button" class="btn btn-success w_full" data-dismiss="modal"><i class="fa fa-times"></i> Close This Window!</button>
					</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	</section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--START MODAL -->
		<div class="modal fade" id="DefaultDeleteModal" role="dialog" aria-labelledby="DefaultDeleteModal">
		  <div class="modal-dialog">
			  <div class="modal-content">
				  <div class="modal-header">
					  <h4 class="t_aling_c"><i class="fa fa-circle-o-notch"></i> Confirm Delete Item </h4>
				  </div>
				  <div class="CPCModal-data"></div>
			  </div>
		  </div>
		</div>
		<!--FINISH MODAL -->
  <!--Footer Starts -->
  <?php include_once('../inc/inc.footertext.php'); ?>
<!--Footer Ends-->
<script type="text/javascript">
	function LoadUpDeleteModal(getCIID) {
		$('#DefaultDeleteModal').modal({backdrop: 'static', keyboard: false});
		$.ajax({
			type: 'post',
			url: 'delete-exam-result.php',
			async: true,
			data: 'getCIID='+getCIID,
			success: function (data) {
				$('.CPCModal-data').html(data);
			}
		});
	}
</script>
</div>
<!-- ./wrapper -->
<!-- AdminLTE App -->
<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js"></script>
<script src="<?php echo ASSETS_URL; ?>js/sweetalert2.min.js"></script>
<script src="../js/dependent-dropdown.min.js" type="text/javascript"></script>
<!--Post Form Data -->
<script type="text/javascript">
	
    $("#SelectSemester").depdrop({
        depends: ['SelectYear'],
        url: 'process-actions.php?GetSemester=1'
    });

    //File Upload preview
    $('#file-upload').change(function() {
    	var i = $(this).prev('label').clone();
    	var file = $('#file-upload')[0].files[0].name;
    	$(this).prev('label').text(file);
    });

	jQuery().ready(function() {
		//Select2
		$(function () {
			$(".select2").select2();
		});

		var v = jQuery("#Upload_Exams_Form").validate({              
			rules: {
				SelectYear: {
			  		required: true
				},
				SelectSemester: {
					required: true
				}
		  	}, 
			errorElement: "span",
		  	errorClass: "help-inline-error",  
		});
	});

  	$(document).ready(function() {
		$("form#Upload_Exams_Form").submit(function(e){
			e.preventDefault();
			if($('#Upload_Exams_Form').valid())  { 
			  $("#LoadingP_ID").show('fast');
			  $('#Upload_Exams_Form').hide("fast"); 
			  $('#LACT_MANUAL').hide("fast");
			  var formData = new FormData($(this)[0]); 
				$.ajax({
					url: 'view-confirm-exams-upload.php',
					type: 'POST',
					data: formData,
					async: true,
					success: function (data) {
						window.setTimeout(close, 1000);
						function close() {
							$("#LoadingP_ID").hide('explode');  
							$('.uploaded-data').html(data);
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}
		});
  	});

</script>
</body>
</html>