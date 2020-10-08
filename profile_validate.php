<?php	
	ob_start();
	include('dbcon.php');
	session_start();
	$_user = $_SESSION['tmp_uname'];	
	$_current = $_POST['oldPass'];
	$_new = $_POST['newPass'];
	$_confirm = $_POST['conPass'];	
	$_profile_page = "profile/" . $_user;
	// Change password
	if (!checkPassword($_user, $_current)) {
		$_SESSION['sys_msg'] = 'Password do not match.';
		header("Location: $_profile_page");
	} else {
		if ($_new == $_confirm) {
			changePassword($_user, $_confirm);
			$_SESSION['sys_msg'] = 'Change avatar successfully.';
			header("Location: $_profile_page");
		} else {
			$_SESSION['sys_msg'] = 'Change password failed.';
			header("Location: $_profile_page");
		}
	}
	ob_flush();
?>