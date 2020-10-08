<?php
// ============= CREATE - INSERT ===============================================
  	/* All create function place here */
  	function createQuiz($quizID, $questID) {
		GLOBAL $db;	
		$sql = "INSERT INTO quiz(quizID, questID) VALUES('$quizID', '$questID')";
		mysqli_query($db, $sql);
	}

 	function createMall($mallID, $cont) {
 		GLOBAL $db;
 		$cont = addslashes($cont);
 		$sql = "INSERT INTO mall(ID, cont) VALUES('$mallID', '$cont')";
 		mysqli_query($db, $sql);
 	}

 	function addQA($_ansID, $_quizID, $_isAnswer, $_isActive) {
		GLOBAL $db;
		$_sql = "INSERT INTO mapqa (ansID, quizID, isAnswer, active) VALUES ('$_ansID', '$_quizID', '$_isAnswer', '$_isActive')";
		mysqli_query($db, $_sql);		
	}

	function createNewBelong($_conID, $_quizID, $_isActive) {
		GLOBAL $db;		
		$_sql = "INSERT INTO belongcon(conID, quizID, active) VALUES ('$_conID', '$_quizID', '$_isActive')";
		mysqli_query($db, $_sql);
	}

	function saveContest($_conID, $_conName, $_duration, $_beginTime, $_author, $_blog, $_createDate) {
		GLOBAL $db;
		$_conName = addslashes($_conName);
		$_blog = addslashes($_blog);
		$_sql = "INSERT INTO contest (conID, conName, duration, beginTime, author, blog, createDate) 
		VALUES ('$_conID', '$_conName', '$_duration', '$_beginTime', '$_author', '$_blog', '$_createDate')";
		mysqli_query($db, $_sql);		
	}

	function createBank($conID, $ans) {
		GLOBAL $db;
		$sql = "INSERT INTO bank(conID, ans) VALUES('$conID', '$ans')";
		mysqli_query($db, $sql);
	}

	function addToRepoto($_conID, $_user, $_point) {
		GLOBAL $db;
		$_sql = "INSERT INTO repoto (conID, username, point) VALUES ('$_conID', '$_user', '$_point')";
		mysqli_query($db, $_sql);
	}

	function createActivity($_conID, $_username, $_ans) {
		GLOBAL $db;	
		$sql = "INSERT INTO activity(conID, username, ans, done) VALUES('$_conID', '$_username', '$_ans', false)";
		mysqli_query($db, $sql);
	}
	function addNew($_conID, $_user, $_point) {
		GLOBAL $db;
		$_sql = "INSERT INTO repoto (conID, username, point) VALUES ('$_conID', '$_user', '$_point')";
		mysqli_query($db, $_sql);
	}
	function register($_user, $_pass, $_name) {
		GLOBAL $db;
		$_name = addslashes($_name);
		$_imgURL = addslashes("img/user.png");
		$_sql = "INSERT INTO account (username, password, name, point, role, imgURL) VALUES ('$_user', '$_pass', '$_name', 0, 0, '$_imgURL')";
		mysqli_query($db, $_sql);
	}
	function insertVote($_user, $_cmtID, $_counter) {
		GLOBAL $db;
		$_sql = "INSERT INTO vote (username, commentID, counter) VALUES ('$_user', '$_cmtID', '$_counter')";
		mysqli_query($db, $_sql);
	}
	function addNewComment($_conID, $_parID, $_cont, $_username) {
		GLOBAL $db;
		$_cont = addslashes($_cont);
		$_sql = "INSERT INTO comment(conID, parID, content, username) VALUES('$_conID', '$_parID', '$_cont', '$_username')";
		mysqli_query($db, $_sql);
	}
	function addPrize($_user, $_prizeName, $_cntPrize) {
		GLOBAL $db;
		$_prizeName = addslashes($_prizeName);
		$_sql = "INSERT INTO achievement (username, namePrize, cnt) VALUES ('$_user', '$_prizeName', '$_cntPrize')";
		mysqli_query($db, $_sql);
	}
?>					