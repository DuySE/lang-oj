<?php 
	session_start();
	include('../dbcon.php');
	$_operation_stt = array('mess' => '', 'id' => '');

   	// MUST login first
	if (isset($_SESSION['tmp_uname'])) {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_conID = $_POST['conID'];
				$_parID = $_POST['parID'];
				$_cmt_cont = $_POST['cmt_cont'];
				$_username = $_SESSION['tmp_uname'];


			
				// if valid all => next
				if (isset($_conID) && isset($_parID) && isset($_cmt_cont) && isset($_username)) {
					
				

					// 1. check exist parent - protect data
					if ($_parID != -1) {
						if (checkExistCmt($_parID) == false) {
							$_operation_stt['mess'] = 'Invalid Request 1';
							echo json_encode($_operation_stt);
   							exit(0);
						}
					}	
					// 2. add to db
					addNewComment($_conID, $_parID, $_cmt_cont, $_username);
					// 3. return json
					$_operation_stt['id'] = getNextCommentID();
					$_operation_stt['mess'] = 'DONE';
			}
			else
				$_operation_stt['mess'] = "Invalid Request 2";
		}	
		else
			$_operation_stt['mess'] = "Invalid Request 3";
	}
	else 
		$_operation_stt['mess'] = "You must login to comment";

	// export json file
   echo json_encode($_operation_stt);
   exit(0);
?>
