<?php
	// ============== GET ========================================================
  	/* All get function place here */

  	function getNextQuizID() {
  		GLOBAL $db;
  		$sql = "SELECT cntquiz FROM provider WHERE ID = '1' ";
  		
  		$rs = mysqli_query($db, $sql);
		
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			$row = $rs->fetch_assoc();
			return $row["cntquiz"];	
		}
		mysqli_free_result($rs);
  	}

  	function getNextMallID() {
  		GLOBAL $db;
  		$sql = "SELECT cntmall FROM provider WHERE ID = '1' ";
  		$rs = mysqli_query($db, $sql);
		
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			$row = $rs->fetch_assoc();
			return $row["cntmall"];	
		}
		mysqli_free_result($rs);
  	}

	
	function getMaxValueMall() {
		GLOBAL $db;
		$_sql = "SELECT MAX(ID) AS 'maxMall' FROM mall";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			if ($_row = $_rs -> fetch_assoc()) return $_row['maxMall'];
		return 0;
		mysqli_free_result($_rs);
	}


	function getMaxValueQuiz() {
		GLOBAL $db;
		$_sql = "SELECT MAX(quizID) AS 'maxQuiz' FROM quiz";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			if ($_row = $_rs -> fetch_assoc()) return $_row['maxQuiz'];
		return 0;
		mysqli_free_result($_rs);
	}

  	function getListQuiz($_conID) {
		GLOBAL $db;		
		$_sql = "SELECT * FROM belongcon WHERE conID = '$_conID' AND active = true";

		$_rs = mysqli_query($db, $_sql);
		$_list_quiz = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc()) {
				$_list_quiz[] = $_row['quizID'];
			}

		return $_list_quiz;
		mysqli_free_result($_rs);
	}

	function getListAnswer($_quizID) {
		GLOBAL $db;
		$_sql = "SELECT ansID FROM mapqa WHERE quizID = '$_quizID' AND active = true ";
		$_rs = mysqli_query($db, $_sql);
		$_list_qa = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_qa[] = $_row['ansID'];
		return $_list_qa;
		mysqli_free_result($_rs);
	}

	function getQuestID($_quizID) {
		GLOBAL $db;
		$_sql = "SELECT questID FROM quiz WHERE quizID = '$_quizID'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row['questID'];
		}
		mysqli_free_result($_rs);
	}

	function getMallContent($_id) {
		GLOBAL $db;
		$_sql = "SELECT cont FROM mall WHERE ID = '$_id'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row['cont'];
		}
		mysqli_free_result($_rs);
	}

	function isAnswer($_quizID, $_ansID) {
		GLOBAL $db;
		$_sql = "SELECT isAnswer FROM mapqa WHERE quizID = '$_quizID' AND ansID = '$_ansID' AND active = true";
		
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row['isAnswer'];
		}
		mysqli_free_result($_rs);
	}

	function getAllContest() {
		GLOBAL $db;
		$_sql = "SELECT * FROM contest ORDER BY beginTime DESC";
		$_rs = mysqli_query($db, $_sql);
		$_list_time = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_time[] = $_row;
		return $_list_time;
		mysqli_free_result($_rs);
	}

	function getUpcomingContest() {
		GLOBAL $db;
		$_sql = "SELECT * FROM contest WHERE beginTime > (SELECT CURTIME())";
		$_rs = mysqli_query($db, $_sql);
		$_list_time = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_time[] = $_row;
		return $_list_time;
		mysqli_free_result($_rs);
	}

	function getPastContest() {
		GLOBAL $db;
		$_sql = "SELECT * FROM contest WHERE beginTime < (SELECT CURTIME())";
		$_rs = mysqli_query($db, $_sql);
		$_list_time = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_time[] = $_row;
		return $_list_time;
		mysqli_free_result($_rs);
	}


	function getContestByID($_conID) {
		GLOBAL $db;
		$_sql = "SELECT * FROM contest WHERE conID = '$_conID'";
		$_rs = mysqli_query($db, $_sql);
		
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row;
		}
		mysqli_free_result($_rs);
	}

	function getAllAction($_conID) {
		GLOBAL $db;
		$_sql = "SELECT * FROM activity WHERE conID = '$_conID' ";
		$_rs = mysqli_query($db, $_sql);
		$_list_ac = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_ac[] = $_row;
		return $_list_ac;
		mysqli_free_result($_rs);
	}


	function getSolutions($conID) {
		GLOBAL $db;
		$_sql = "SELECT * FROM bank WHERE conID = '$conID' ";
		
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row['ans'];
		}
		mysqli_free_result($_rs);
	}

	function getContestPoint($conID, $username) {
		GLOBAL $db;
		$_sql = "SELECT * FROM repoto WHERE conID = '$conID' AND username = '$username' ";
		
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row['point'];
		}
		mysqli_free_result($_rs);
	}

	function countCompetition($conID) {
		GLOBAL $db;
		$sql = "SELECT * FROM repoto WHERE conID = '$conID' ";
		
		$rs = mysqli_query($db, $sql);
		
		if (isset($rs)) 
			return mysqli_num_rows($rs);
		mysqli_free_result($rs);
	}

	function computeRank($conID, $username) {
		GLOBAL $db;
		$_myscore = getContestPoint($conID, $username);

		$sql = "SELECT * FROM repoto WHERE point > '$_myscore' AND conID = '$conID' ";
		
		$rs = mysqli_query($db, $sql);
		if (isset($rs)) 
			return mysqli_num_rows($rs) + 1;
		mysqli_free_result($rs);
	}



	function getListSaveAnswer($conID, $username) {
		GLOBAL $db;
		$_sql = "SELECT * FROM activity WHERE conID = '$conID' AND username = '$username' ";
		
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row['ans'];
		}
		mysqli_free_result($_rs);
	}

	
	// cmpPoint
	function cmpPoint($a, $b) {
		if ($a["point"] > $b["point"]) return -1;
		else if ($a["point"] < $b["point"]) return 1;
		else return 0;
	}
					
	// get list user for ranking
	function getListUserJoinContest($_conID) {
		GLOBAL $db;
		$sql = "SELECT * FROM repoto WHERE conID = '$_conID' ";
   		$rs = mysqli_query($db, $sql);
		$listUser = array();
		if (isset($rs)) {
			while($row = $rs->fetch_assoc()) {
				$listUser[] = $row;
			}
		}
		usort($listUser, "cmpPoint");
		return $listUser;
		mysqli_free_result($rs);	
	}

	function getFullName($_username) {
		GLOBAL $db;
		$_sql = "SELECT name FROM account WHERE username = '$_username'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['name'];
		mysqli_free_result($_rs);
	}

	function getContestName($_contestID) {
		GLOBAL $db;
		$_sql = "SELECT conName FROM contest WHERE conID = '$_contestID'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['conName'];
		mysqli_free_result($_rs);
	}

	function getLockStateContest($_conID) {
  		GLOBAL $db;
  		$sql = "SELECT islock FROM contest WHERE conID = '$_conID' ";
  		$rs = mysqli_query($db, $sql);
		
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			$row = $rs->fetch_assoc();
			return $row["islock"];	
		}
		mysqli_free_result($rs);
  	}
  	function getSingleUser($_user) {
		GLOBAL $db;
		$_sql = "SELECT * FROM account WHERE username = '$_user'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			return $_row;
		}
		mysqli_free_result($_rs);
	}
	function comparePoint($_a, $_b) {
		return $_a['point'] < $_b['point'];
	}	
	function getListUsers() {
		GLOBAL $db;
		$_sql = "SELECT * FROM account";
		$_rs = mysqli_query($db, $_sql);
		$_list_user = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_user[] = $_row;
		usort($_list_user, 'comparePoint');
		return $_list_user;
		mysqli_free_result($_rs);
	}
	function getPoint($_user) {
		GLOBAL $db;
		$_sql = "SELECT * FROM account WHERE username = '$_user'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			if ($_row = $_rs -> fetch_assoc()) return $_row['point'];
		return 0;
		mysqli_free_result($_rs);
	}
	function getRankColor($_point) {
		if ($_point >= 2000) return 'red';
		if ($_point >= 1000) return 'orange';
		if ($_point >= 500) return 'purple';
		if ($_point >= 200) return 'green';
		if ($_point >= 100) return 'blue';
		return 'gray';
	}
	function subDate($_beginTime) {
		GLOBAL $db;
		$_sql = "SELECT DATE_SUB('$_beginTime', INTERVAL time() MINUTE) AS 'lock_time'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['lock_time'];
		mysqli_free_result($_rs);
	}
	function getContest($_conID) {
		GLOBAL $db;
		$_sql1 = "SELECT * FROM contest WHERE conID = '$_conID'";
		$_rs1 = mysqli_query($db, $_sql1);
		$_list_contest = array();
		if (isset($_rs1))
			while ($_row = $_rs1 -> fetch_assoc())
				$_list_contest[] = $_row;
		for ($i = 0; $i < sizeof($_list_contest); $i++) { 
			$_time = subDate($_list_contest[$i]['beginTime']);
			$_sql2 = "UPDATE contest SET islock = true WHERE '$_time' < 5";
			mysqli_query($db, $_sql2);		
		}
		return $_list_contest;
		mysqli_free_result($_rs);
	}
	function getImg($_username) {
		GLOBAL $db;
		$_sql = "SELECT imgURL FROM account WHERE username = '$_username'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['imgURL'];
		mysqli_free_result($_rs);
	}
	function computeRanking($_username) {
		GLOBAL $db;
		$_myscore = getSingleUser($_username);
		$_score = $_myscore['point'];

		$sql = "SELECT * FROM account WHERE point > '$_score'";
		
		$rs = mysqli_query($db, $sql);
		if (isset($rs)) 
			return mysqli_num_rows($rs) + 1;
		mysqli_free_result($rs);
	}
	function getNextContestID() {
		GLOBAL $db;
		$_sql = "SELECT max(conID) AS 'maxID' FROM contest";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['maxID'] + 1;
		mysqli_free_result($_rs);
	}
	function getPriority($_prizeName) {
		GLOBAL $db;
		$_sql = "SELECT * FROM prize WHERE name = '$_prizeName'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['priority'];
		mysqli_free_result($_rs);
	}
	function comparePrize($_a, $_b) {
		$_var1 = getPriority($_a['namePrize']);
		$_var2 = getPriority($_b['namePrize']);
		return $_var1 > $_var2;
	}
	function getListPrize($_username) {
		GLOBAL $db;
		$_sql = "SELECT * FROM achievement WHERE username = '$_username'";
		$_rs = mysqli_query($db, $_sql);
		$_list_prize = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_prize[] = $_row;
		usort($_list_prize, 'comparePrize');
		return $_list_prize;
		mysqli_free_result($_rs);
	}
	function getPrizes($_prizeName) {
		GLOBAL $db;
		$_sql = "SELECT * FROM prize WHERE name = '$_prizeName'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row;
		mysqli_free_result($_rs);
	}
	function getTitle($_username) {
		$_user = getSingleUser($_username);
		$_point = $_user['point'];
		$_rank = computeRanking($_username);
		$_name = $_user['username'];
		$_color = getRankColor($_point);

		if ($_rank == 1 && $_point > 0) {
			$_title = "<font color = 'black'>" . substr($_name, 0, 1) . "</font>" .
			"<font color = '".$_color."'>".
			 substr($_name, 1)."</font>";
		}
		else
			$_title =  "<font color = '". $_color ."'>" . $_name . "</font>";
		return $_title;
	}
	function getVote($_user, $_cmtID) {
		GLOBAL $db;
		$_sql = "SELECT counter FROM vote WHERE username = '$_user' AND commentID = '$_cmtID'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['counter'];
		mysqli_free_result($_rs);
	}
	function getSumCounter($_cmtID) {
		GLOBAL $db;
		$_sql = "SELECT SUM(counter) AS 'sumVote' FROM vote WHERE commentID = '$_cmtID'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0) {
			$_row = $_rs -> fetch_assoc();
			if (!isset($_row['sumVote'])) return 0;
			else
				return $_row['sumVote'];
		}
	}
	function getRepoto($_conID) {
		GLOBAL $db;
		$_sql = "SELECT * FROM repoto WHERE conID = '$_conID'";
		$_rs = mysqli_query($db, $_sql);
		$_list_repoto = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_repoto[] = $_row;
		usort($_list_repoto, "cmpPoint");
		return $_list_repoto;
		mysqli_free_result($_rs);
	}
	function getListParentComment($_conID) {
		GLOBAL $db;
		$_sql = "SELECT * FROM comment WHERE conID = '$_conID' AND parID = -1 ";
		$_rs = mysqli_query($db, $_sql);
		$_listCom = array();

		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc()) {
				$_listCom[] = $_row;
			}
		return $_listCom;
		mysqli_free_result($_rs);
	}

	function getListSubCom($_parentID) {		
		GLOBAL $db;
		$_sql = "SELECT * FROM comment WHERE parID = '$_parentID' ";
		$_rs = mysqli_query($db, $_sql);
		$_listSubCom = array();

		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc()) {
				$_listSubCom[] = $_row;
			}
		mysqli_free_result($_rs);
		return $_listSubCom;
		mysqli_free_result($_rs);
	}

	function getComment($_comID) {
		GLOBAL $db;
		$_sql = "SELECT * FROM comment WHERE ID = '$_comID' ";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row;
		mysqli_free_result($_rs);
	}
	function getNextCommentID() {
		GLOBAL $db;
		$_sql = "SELECT max(ID) AS 'maxID' FROM comment";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		return $_row['maxID'];
		mysqli_free_result($_rs);
	}
	function getTitle2($_username) {
		$_user = getSingleUser($_username);
		$_point = $_user['point'];
		$_rank = computeRanking($_username);
		$_name = $_user['username'];
		$_color = getRankColor($_point);

		if ($_rank == 1 && $_point > 0) {
			$_title = '<font color = "black">' . substr($_name, 0, 1) . '</font>' .
			'<font color = "'.$_color.'"">'.
			 substr($_name, 1).'</font>';
		}
		else
			$_title =  '<font color = "'. $_color .'"">' . $_name . '</font>';
		return $_title;
	}
	function getCountPrize($_username, $_prizeName) {
		GLOBAL $db;
		$_sql = "SELECT cnt FROM achievement WHERE username = '$_username' AND namePrize = '$_prizeName'";
		$_rs = mysqli_query($db, $_sql);
		if (isset($_rs) && mysqli_num_rows($_rs) > 0)
			$_row = $_rs -> fetch_assoc();
		else return 0;
		mysqli_free_result($_rs);
	}
	function getAllContest2() {
		GLOBAL $db;
		$_sql = "SELECT * FROM contest ORDER BY beginTime";
		$_rs = mysqli_query($db, $_sql);
		$_list_time = array();
		if (isset($_rs))
			while ($_row = $_rs -> fetch_assoc())
				$_list_time[] = $_row;
		return $_list_time;
		mysqli_free_result($_rs);
	}
?>