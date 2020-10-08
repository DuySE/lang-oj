<?php 
    ob_start();
	  date_default_timezone_set('Asia/Ho_Chi_Minh');
	  $date = date('m/d/Y h:i:s a', time());

	  session_start();
	  // database
	  include('../dbcon.php');

	  // not login yet
	  if (!isset($_SESSION['tmp_uname']))
	  	header("Location: error");
	  // get current username
	  $_username = $_SESSION['tmp_uname'];

	  // when recieve submit request
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['numAns']) && isset($_POST['bnAction'])) {

        	$_contestID = $_POST['conID'];

        	// contest not exist
        	if (!checkExistContest($_contestID)) {
        		header("Location: error");
        		exit(0);
        	}

        	// get all infor of contest
        	$_contest = getContestByID($_contestID);
        	$_deltime = (strtotime($_contest['beginTime']) + $_contest['duration'] * 60) - strtotime($date);
        	

        	// contest is end
        	if ($_deltime < 0) {
        		header("Location: error");
        		exit(0);
        	}

        	// User have submitted -- prohibit submit
        	
        	$_done = isDoneContest($_contestID, $_username);
        	if ($_done) {
        		header("Location: error");
        		exit(0);
        	} 

            // make new list answer
            $_ansSTR = '';
            $_cntAns = intval($_POST['numAns']);
            for ($_i = 1; $_i <= $_cntAns; $_i++) {
                
                $_cntSTR = '000';

                if (isset($_POST['ans'.$_i])) {
                    $_userAns = $_POST['ans'.$_i];                 
                    // make tuples size 3 
                    $_cntSTR = ''.$_userAns;
                    $_need = 3 - strlen($_cntSTR);
                    for ($i = 1; $i <= $_need; $i++) $_cntSTR = "0".$_cntSTR;
                }
            //  if (isset($_POST['ans'.$_i])) echo $_POST['ans'.$_i];
                $_ansSTR = $_ansSTR.$_cntSTR;
            }
            // Save the answer
            if (checkExistActivity($_contestID, $_username)) {
                updateActivity($_contestID, $_username, $_ansSTR);
            }
            else {
              createActivity($_contestID, $_username, $_ansSTR);
            }
            // If click Submit
            if ($_POST['bnAction'] == 'Submit') {
                confirmDoneContest($_contestID, $_username);
            }

            $_backPage = "contest/".$_contestID;
            header("Location: $_backPage");
        }
        else
        	header("Location: error");
    }
    else
    	header("Location: error");
    ob_flush();
?>