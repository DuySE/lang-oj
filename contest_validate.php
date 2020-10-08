<?php
	ob_start();
	session_start();
	include ('dbcon.php');
	 date_default_timezone_set('Asia/Ho_Chi_Minh');
 	$_createDate = date('y/m/d h:i:s a', time());
	$stt = true;
	// check admin to acess this page
	if (!isset($_SESSION['tmp_uname']) || checkAdmin($_SESSION['tmp_uname']) == false)  $_need_admin = 1;
	include('control/permission.php');
	//

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_conName = $_POST['conName'];
		$_duration = $_POST['duration'];
		$_beginTime = $_POST['beginDate'] . ' ' .$_POST['beginTime'];
		$_blog = $_POST['blog'];
		
		echo $_POST['conName']."<br>";
		echo $_POST['duration']."<br>";
		echo $_POST['beginTime']."<br>";
		// $_createDate = strtotime($date);
		if (isset($_conName) && isset($_duration) && isset($_beginTime) && isset($_SESSION['tmp_uname'])) {
			$_conID = getNextContestID();
			saveContest($_conID, $_conName, $_duration, $_beginTime, $_SESSION['tmp_uname'], $_blog, $_createDate);
			$_string = "edit/" . $_conID;
			header("Location: $_string");
		} else header('Location: manage/');
	}
	ob_flush();
?>
