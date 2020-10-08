<?php 
	// ============= UPDATE ========================================================
  	 /* All update function place here */


  	function updateProviderQuiz($newQuizCnt) {
  		GLOBAL $db;
  		$sql = "UPDATE provider SET cntquiz = '$newQuizCnt' WHERE ID = 1 ";
  		mysqli_query($db, $sql);
  	}

  	function updateProviderMall($newMallCnt) {
  		GLOBAL $db;
  		$sql = "UPDATE provider SET cntmall = '$newMallCnt' WHERE ID = 1 ";
  		mysqli_query($db, $sql);
  	}


  	function updateMallContent($_id, $_cont) {
		GLOBAL $db;
		$_cont = addslashes($_cont);
		$_sql = "UPDATE mall SET cont = '$_cont' WHERE ID = '$_id'";
		$_rs = mysqli_query($db, $_sql);
	}

	function changeQA($_quizID) {
		GLOBAL $db;
		$_sql = "UPDATE mapqa SET active = false AND isAnswer = false WHERE quizID = '$_quizID'";
		$_rs = mysqli_query($db, $_sql);
	}


	function updateQAActive($_ansID, $_quizID, $_isActive) {
		GLOBAL $db;
		$_sql = "UPDATE mapqa SET active = $_isActive WHERE ansID = '$_ansID' AND quizID = '$_quizID'";
		
		mysqli_query($db, $_sql);
	}

	function updateQAAnswer($_ansID, $_quizID, $_isAnswer) {
		GLOBAL $db;
		$_sql = "UPDATE mapqa SET isAnswer = '$_isAnswer' WHERE ansID = '$_ansID' AND quizID = '$_quizID'";
		mysqli_query($db, $_sql);
	}

	function deactiveBelong($_conID) {
		GLOBAL $db;
		$_sql = "UPDATE belongcon SET active = 'false' WHERE conID = '$_conID'";
		mysqli_query($db, $_sql);
	}

	function changeActiveBelong($_conID, $_quizID) {
		GLOBAL $db;
		$_sql = "UPDATE belongcon SET active = true WHERE conID = '$_conID' AND quizID = '$_quizID'";
		mysqli_query($db, $_sql);
	}

  	function updateBank($conID, $ans) {
		GLOBAL $db;
		$_sql = "UPDATE bank SET ans = '$ans' WHERE conID = '$conID' ";
		mysqli_query($db, $_sql);
	}

	function confirmDoneContest($_conID, $_username) {
		GLOBAL $db;
		$_sql = "UPDATE activity SET done = true WHERE conID = '$_conID' AND username = '$_username' ";
		mysqli_query($db, $_sql);
	}

	function updateActivity($_conID, $_username, $_newans) {
		GLOBAL $db;
		$_sql = "UPDATE activity SET ans = '$_newans' WHERE conID = '$_conID' AND username = '$_username' ";
		mysqli_query($db, $_sql);	
	}
	function changePassword($_user, $_pass) {
		GLOBAL $db;
		$_sql = "UPDATE account SET password = '$_pass' WHERE username = '$_user'";
		mysqli_query($db, $_sql);
	}
	function updateImg($_imgURL, $_username) {
		GLOBAL $db;
		$_sql = "UPDATE account SET imgURL = '$_imgURL' WHERE username = '$_username'";
		mysqli_query($db, $_sql);
	}
	function setDoneJudge($_conID) {
		GLOBAL $db;
		$_sql = "UPDATE contest SET isJudged = true WHERE conID = '$_conID'";
		mysqli_query($db, $_sql);
	}
	function setPoint($_username, $_newPoint) {
		GLOBAL $db;
		$_sql = "UPDATE account SET point = '$_newPoint' WHERE username = '$_username'";
		mysqli_query($db, $_sql);
	}
	function updateBlog($_conID, $_blog) {
		GLOBAL $db;
		$_blog = addslashes($_blog);
		$_sql = "UPDATE contest SET blog = '$_blog' WHERE conID = '$_conID'";
		mysqli_query($db, $_sql);
	}
	function updatePrize($_user, $_prizeName, $_cntPrize) {
		GLOBAL $db;
		$_prizeName = addslashes($_prizeName);
		$_sql = "UPDATE achievement SET namePrize = '$_prizeName', cnt = '$_cntPrize' WHERE username = '$_user'";
		mysqli_query($db, $_sql);		
	}
?>