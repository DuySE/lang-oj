<?php
	session_start();
	if (!isset($_SESSION['tmp_uname'])) {
		header("Location: ");
		exit(0);
	}
	$_user = $_SESSION['tmp_uname'];
	unset($_SESSION['tmp_uname']);
	session_destroy();
	session_start();
	$_SESSION['sys_msg'] = 'Goodbye, ' . $_user;

	header("Location: ");
	exit(0);
?>