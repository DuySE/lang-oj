<?php
	ob_start();
	include('control/configall.php');
	$_target_dir = "img_source/";
	$_target_file = $_target_dir . basename($_FILES['face']['name']);
	$_uploadOK = 1;
	$_fileType = pathinfo($_target_file, PATHINFO_EXTENSION);	
	$_errors = array();
	$_SESSION['err_img'] = $_errors;
	// Check if image file is a actual image or fake image
	if (isset($_POST['submit'])) {
		$_check = getimagesize($_FILES['face']['tmp_name']);
		if ($_check !== false) {
			echo "File is an image - " . $_check["mime"] . ".";
			$_uploadOK = 1;
		} else {
			$_SESSION['err_img'][0] = 'File is not an image.';
        	$_uploadOK = 0;
		}
	}
	// Check if file already exists
	if (file_exists($_target_file)) {
    	$_SESSION['err_img'][1] = 'File already exists.';
    	$_uploadOK = 0;
	}
	 // Check file size
	if ($_FILES['face']['size'] > 500000) {
    	$_SESSION['err_img'][2] = 'File is too large.';
    	$_uploadOK = 0;
	}
	// Allow certain file formats
	if($_fileType != "jpg" && $_fileType != "png" && $_fileType != "jpeg"
	&& $_fileType != "gif" ) {
    	$_SESSION['err_img'][3] = "Only JPG, JPEG, PNG & GIF files are allowed.";
    	$_uploadOK = 0;
	}
	// Check if $_uploadOK is set to 0 by an error
	if ($_uploadOK == 0) {
    	$_SESSION['err_img'] = 'Your file was not uploaded.';
	// if everything is ok, try to upload file
	} else {
		$_temp = explode('.', $_FILES['face']['name']);		
		$_username = $_SESSION['tmp_uname'];
		$_newFilename = $_username . '.' . end($_temp);
		$_imgURL = $_target_dir . $_newFilename;
    	if (move_uploaded_file($_FILES['face']['tmp_name'], $_imgURL)) {
        	// echo 'The file '. basename($_FILES['face']['name']). ' has been uploaded.';
        	updateImg($_imgURL, $_username);
        	$_SESSION['scc_img'] = 'Upload successfully';
        	$_profile_page = "http://<?php echo $_DOMAIN ?>/profile/" . $_SESSION['tmp_uname'];
        	header("Location: $_profile_page");
    	} else {
        	$_SESSION['err_img'][4] = 'There was an error uploading your file.';
    	}
	}
	ob_flush();
?>