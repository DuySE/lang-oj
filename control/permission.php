<?php	
	if (!isset($_stt)) $_stt = true;
	// check login
	if (isset($_need_login)) $_stt = false;
	// check admin
	if (isset($_need_admin)) $_stt = false;
	// page load error
	if (isset($_page_error)) $_stt = false;
	if ($_stt == false) {
		header('Location: error');
	}	
?>