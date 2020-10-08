<?php
	ob_start();
	include('dbcon.php');
	session_start();
	$_reg_op = array('mess' => '');
	$_reg_op['mess'] = "";
	$_reg_user = $_POST['user'];
	$_reg_pass = $_POST['pass'];
	$_reg_con = $_POST['conPass'];
	$_reg_name = $_POST['firstName'] . ' ' . $_POST['lastName'];
	$_reg_valid = false;
	// Validation
	$pat = '/^[a-zA-Z0-9_]{4,12}$/';
	if (strlen($_reg_pass) < 6 || strlen($_reg_pass) > 20)
		$_reg_op['mess'] = 'Password length must be in range 6 - 20';
	else if (!preg_match($pat, $_reg_user, $mat))
		$_reg_op['mess'] = "Username contains only letter, number and underscore.";
	else if ($_reg_pass !== $_reg_con)
		$_reg_op['mess'] = 'Password and Confirm password do not match.';
	else if ($_reg_user === getSingleUser($_reg_user)['username'])
		$_reg_op['mess'] = 'Username is used, choose another username.';
	else {
		register($_reg_user, $_reg_pass, $_reg_name, 0, 0);
		$_reg_op['mess'] = 'OK';
	}
	echo json_encode($_reg_op);
	ob_flush();
	exit(0);
?>