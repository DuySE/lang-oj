<?php
	include('control/configall.php');
	include('gui/resource.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Analyze contest </title>
	</head>
	
	<?php
		
		function getQuizID($quizID) {
			return	intval(substr($quizID, 1));
		}
		function getMallID($mallID) {
			return	intval(substr($mallID, 2));
		}
		function getMallChkID($mallID) {
			return intval(substr($mallID, 4));
		}
	?>
	<body class="fonts1">
		<div id="body-wrapper">
			<?php include('gui/header.php') ?>
			<div id="" class="section" style="background-color: #f0f0f0">
				<div id="" class = "container">
					<!-- BEGIN BODY CONTENT -->
					<?php
					// ACCESS CONTROL
					$_stt = true;
					/* place command & setting flag */
					if (!isset($_SESSION['admin'])) $_need_admin = 1;
					else
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							
							// get contest ID
							$contestID = $_POST['contestID'];
							if (checkExistContest($contestID)) {
								// list all data in here
								$listQuizID = $_POST['listID'];
								// we will work with database in here
								foreach ($listQuizID as $quiz) {
								// get checked answer
								$_answerID = -1;
								if (isset($_POST['chk'.$quiz]))
									$_answerID = $_POST['chk'.$quiz];
								// add all mall
								$mallList = $_POST['ansID'.$quiz];
								$mallContent = $_POST['ans'.$quiz];
								$mallList[] = $_POST['questID'.$quiz]; // the same push method
								$mallContent[] = $_POST['quest'.$quiz];
								$sz = sizeof($mallList);
								for ($i = 0; $i < $sz; $i++) {
									
									$mallID =  $mallList[$i];
									if (checkExistMall( $mallID )) {
										// create new mall
										updateMallContent($mallID, $mallContent[$i]);
									}
									else {
										// update mall content
										createMall($mallID, $mallContent[$i]);
									}
									
								} /**/
								
									// add Quiz
								$quizID = getQuizID($quiz);
								//echo "we have id = ".$quizID."<br>";
								if (!checkExistQuiz($quizID)) createQuiz($quizID, $_POST['questID'.$quiz]);
								
								// UPDATE ALL QUIZ
								changeQA($quizID); // deactive all
								for ($i = 0; $i < $sz; $i++) {
									$mallID =  $mallList[$i];
									$_isActive = true;
									$_isAns = false;
									if ($_answerID == $mallID) $_isAns = true;
									if (!checkQA($quizID, $mallID)) {
										// create
										addQA($mallID, $quizID, $_isAns, $_isActive);
									}
									else {
										// update
										updateQAActive($mallID, $quizID, $_isActive);
											updateQAAnswer($mallID, $quizID, $_isAns);
									}
								}
							}
							// UPDATE QUIZ BELONG CONTEST
							deactiveBelong($contestID);
							foreach ($listQuizID as $quiz) {
								$quizID = getQuizID($quiz);
								//echo "CONTEST & QUIZ: ".$contestID." ==> ".$quizID."<br>";
								if (checkBelong($contestID, $quizID)) {
									changeActiveBelong($contestID, $quizID);
								}
								else {
									createNewBelong($contestID, $quizID, true);
								}
							}
							// UPDATE PROVIDER
							$_newMallID = intval(getMaxValueMall());
							$_newQuizID = intval(getMaxValueQuiz());
							updateProviderQuiz($_newQuizID);
							updateProviderMall($_newMallID);
							// CREATE BANK ANSWER FOR CONTEST
							$_listQuiz = getListQuiz($contestID);
							
							$_ansSTR = "";
							foreach ($_listQuiz as $_quiz) {
								
								$_listAns = getListAnswer($_quiz);
								$_cnt = 0;
								$_questID = getQuestID($_quiz);
								// no answer ==> cnt = 0
								foreach ($_listAns as $_ans)
								if ($_ans != $_questID) {
									$_cnt = $_cnt + 1;
									if (isAnswer($_quiz, $_ans)) {
										break;
										}
									}
								$_cntSTR = ''.$_cnt;
								
								$_need = 3 - strlen($_cntSTR);
								//echo "len = ".strlen($_cntSTR);
								for ($i = 1; $i <= $_need; $i++) $_cntSTR = "0".$_cntSTR;
								//echo $_cntSTR."<br>";
								$_ansSTR = $_ansSTR.$_cntSTR;
								
							}
							// check if exist bank (conID)
							if (!checkExistBank($contestID)) {
								// add new bank (conID)
								createBank($contestID, $_ansSTR);
							}
							else {
								// create new bank(conID)
								updateBank($contestID, $_ansSTR);
							}
					?>
					<div class="container" style="text-align: center;">
						<br><br>
						<h1>
						<font color="green"> <strong> UPDATE SUCCESSFULLY </strong>
						<img src="img/success.png" width="30" height="30">
							<br><br>
						</font>						
						</h1>
						<h3>Update configuration: <a href="edit/<?php echo $contestID?>"> Edit contest </a> <br></h3>
						<h3>View all contest: <a href="contests/"> Contest page </a></h3>
						<br><br>
					</div>
					<?php
					}
					else {
						$_page_error = 1;
					}
					}
					else {
					$_page_error = 1;
					}
					// END ACESS CONTROLL
					include('control/permission.php');
					?>
				</div>
			</div>
		</div>		
		<?php include('gui/footer.php') ?>
	</body>
</html>