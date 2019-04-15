<?php
if(isset($_GET['CurrentSnapShot'])){
		$File = $_GET['CurrentSnapShot'];
		$FPath = '../img/users/'.$File.'';
		chown($FPath, 666);
		unlink($FPath);
	}

	$dir_base = "../img/users/";
	$safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['webcam']['name']));
	$TheImageOne = strtotime("now") . $safe_filename;
	move_uploaded_file($_FILES['webcam']['tmp_name'], $dir_base . $TheImageOne);
	echo $dir_base.$TheImageOne;

?>
