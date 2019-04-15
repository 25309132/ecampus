<div class="box-body">
  <div class="col-lg-12">
	<?php
		session_start();
		$_SESSION['insert']='';
		include_once('../sys/core/init.inc.php');
		$common=new common();
		$RemoteIP = $_SERVER['REMOTE_ADDR'];
		$RemotePC = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
		$HCFileUploader = $_SESSION['UserEmail'];
		$YearID = $common->CCStrip($_POST['SelectYear']);
		$SemesterID = $common->CCStrip($_POST['SelectSemester']);
		$DayTodayIs = date('Y-m-d');

		$allowedTypes = array(
		'text/csv',
		'text/plain',
		'application/csv',
		'text/comma-separated-values',
		'application/excel',
		'application/vnd.ms-excel',
		'application/vnd.msexcel',
		'text/anytext',
		'application/octet-stream',
		'application/txt',
		'application/download',
		);
	if (in_array($_FILES["file"]["type"], $allowedTypes)) {
												
		if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
												
			//Process the CSV file
			$findings = "
			<form method=\"POST\" action=\"\" name=\"Submit_Lactoscope_Utility_Form\" id=\"Submit_Lactoscope_Utility_Form\">
			<table class='table' id='table'>
				<tr>
					<td colspan=\"12\"><div align=\"right\"><input type=\"submit\" value=\"Confirm File Upload\" class=\"btn btn-success btn_submit_data w_full\" /></div></td>
				</tr>
				<tr>
					<td><b></b></td>
					<td><b>#</b></td>
					<td><b>Students Registration</b></td>
					<td><b>Course Code</b></td>
					<td><b>CAT</b></td>
					<td><b>EXAM</b></td>
				</tr>";
			$handle = fopen($_FILES['file']['tmp_name'], "r");

			//Start Counting Columns
			$allowedColNum=5;
			$batchcount=0;
			$UploadedCols = count(fgetcsv($handle));
			if($UploadedCols <> $allowedColNum)  
			{
				//Columns Do Not Match
				echo '<div class="w_full">
						<center>
							<h4 class="t_align_c m_top_10" style="color: red;"> Possible File Parameter Mismatch! </h4>
							<div class="col-lg-12">
								<p></p>
								<p class="t_align_c">
								<b>NOTE:</b> <br /><br />The Uploaded CSV File Column Count Does NOT Match the Expected 3M Reader Data Column Count. <br /> Please Review and Re-Upload the Data again!</p>
							</div>
							<div class="col-lg-12">
								<h4 class="t_align_c">' . $UploadedCols . ' Columns Counted. Confirm the Data Provided on the .CSV File is Correct!
							</div>
						</center>
					</div>';
			} 
			else
			{
			// Run Query
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			$data = fgetcsv($handle, 1000, ","); // Remove if CSV file does not have column headings
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$att0 = $common->CCStrip($data[0]); 
				$att1 = $common->CCStrip($data[1]);
				$att2 = $common->CCStrip($data[2]);
				$att3 = $common->CCStrip($data[3]);
				$att4 = $common->CCStrip($data[4]);
				$att5 = $common->CCStrip($data[5]);
				
				// Check if row is in database already
				$count = $common->CCGetDBValue("SELECT COUNT(*) FROM tbl_uploaded_exams WHERE yearID = '{$YearID}' AND semesterID = '{$SemesterID}' AND studentRegNo = " . $att1 . "' AND courseCode '" . $att2 . "' AND isDeleted = 0");             
				if($count > 0){
				$findings = $findings . "
					<tr>
						<td id=\"duplicate\" bgcolor=\"#FF0000\">DB Duplicate</td>
							<td>" . $att0 . "</td>
							<td>" . $att1 . "</td>
							<td>" . $att2 . "</td>
							<td>" . $att3 . "</td>
							<td>" . $att4 . "</td>
							<td>" . $att5 . "</td>
					</tr>";
				}
													
				// Check if row is already in INSERT queue
				else if(strpos($_SESSION['insert'], " '{$att1}' ") != false){
					$findings = $findings . "
						<tr>
						<td bgcolor=\"#FF0000\">File Duplicate</td>
							<td>" . $att0 . "</td>
							<td>" . $att1 . "</td>
							<td>" . $att2 . "</td>
							<td>" . $att3 . "</td>
							<td>" . $att4 . "</td>
							<td>" . $att5 . "</td>
						</tr>";
				}
				//Row is unique
				else{
					//Add INSERT statement to INSERT queue 
					$_SESSION['insert'] .= "INSERT INTO tbl_uploaded_exams (yearID, semesterID, studentRegNo, courseCode, catScore, examScore, uploadedBy, UIP) VALUES ('{$YearID}', '{$SemesterID}', '{$att1}' ,'{$att2}', '{$att3}', '{$att4}', '{$HCFileUploader}', '{$RemoteIP}');" ;
					
					//Add row for row to findings table and mark unique  
					$findings = $findings . " 
					<tr>
					<td bgcolor=\"#00FF00\">OK!</td>
						<td>" . $att0 . "</td>
						<td>" . $att1 . "</td>
						<td>" . $att2 . "</td>
						<td>" . $att3 . "</td>
						<td>" . $att4 . "</td>
						<td>" . $att5 . "</td>
					</tr>";
				}
			}
												
			$findings = $findings . "  
			<tr>
				<div class='row'>
					<div class='col-md-6'>
						<td colspan=\"6\"><div align=\"right\"><input type=\"submit\" value=\"Confirm File Upload\" class=\"btn btn-success btn_submit_data w_full\" /></div></td>
					</div>
					<div class='col-md-6'>
						<td colspan=\"6\"><div align=\"right\"><input type=\"submit\" value=\"Confirm File Upload\" class=\"btn btn-success btn_submit_data w_full\" /></div></td>
					</div>
			</tr>
		</table>
		</form>";
			echo $findings;
		}
	} // Upload the Files if Column Count Match
		else{
			die("Unable to import Data");
		}
	}
	else {
		   //$FNSUPORTED = die("<h4 class='alert_info'>This is not a CSV file.<h4>");
	}
?>
</div>
  </div>
  <div class="col-lg-12">
	<button class="btn btn-danger w_full bccancel_edit_btn"> Cancel File Upload </button>
  </div>
  <center id="LoadingS_ID" class="d_none r_corners">
	<h4 class="m_top_20 m_bottom_20">Please wait... Importing your Data </h4>
	<img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
  </center>
  <div class="alert alert-success d_none" id="SuccessDivPage">
	<strong>Success!</strong> <i class="fa fa check-o"></i> Your CSV File has been successfully imported!.
  </div>
</div>
<script type="text/javascript">
  //duplicate
	$(document).ready(function() {
		var r = $("#table #duplicate").text();
		var s = substring = "Duplicate";
		//alert(r);
		if(r.includes(s))
		{
	  		$(".btn_submit_data").hide();
		}
  	});

	$(".bccancel_edit_btn").click(function(e) {
		e.preventDefault();
		$('.uploaded-data').hide('explode');
		$('#Upload_Exams_Form').show("fast");
		$('#LACT_MANUAL').show("fast");
		window.location.replace("upload-exam-results");
	});

	$("form#Submit_Lactoscope_Utility_Form").submit(function(e){
		e.preventDefault();
		$("#LoadingS_ID").show('fast');
	  	$('#Submit_Lactoscope_Utility_Form').hide("fast"); 
	  	$('.bccancel_edit_btn').hide("fast"); 
	  	var formData = new FormData($(this)[0]); 
		$.ajax({
			url: 'import-csv.php',
			type: 'POST',
			data: formData,
			async: true,
			success: function (data) {
				window.setTimeout(showsuccess, 500);
				window.setTimeout(close, 3000);
				function showsuccess() {
				  $("#LoadingS_ID").hide('explode');  
				  $("#SuccessDivPage").show("fast");
				}
				function close() {
				  $("#SuccessDivPage").hide('explode');  
				  $("#Upload_Exams_Form").show("fast");
				  $('#LACT_MANUAL').show("fast");
				  $('#PeopleTableContainer').jtable('load');
				}
			},
			cache: false,
			contentType: false,
			processData: false
		});
	});
</script>