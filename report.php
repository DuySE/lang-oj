<?php
// DATABASE
include('control/configall.php');
include('gui/resource.php');
// ACCESS CONTROL
$_stt = true;
/* place command & setting flag */
include('control/requireContestID.php');
/* end command */
// required user
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
if (isset($_GET['user'])) {
$_username = $_GET['user'];
}
else
$_page_error = 1;
}
else {
$_page_error = 1;
}


include('control/permission.php');
// END ACESS CONTROL
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// get current date
$date = date('m/d/Y h:i:s a', time());
?>
  <head>
    <title> View user performance </title>
  </head>
  <!-- CSS -->
  <style>
  #rcorners {
  border-radius: 25px;
  border: 2px solid #73AD21;
  padding: 20px;
  margin-bottom: 10px;
  width: 100%;
  }
  </style>
  <?php
  // count CORRECT
  function countCorrect($_answer, $_solution) {
  $sz = strlen($_answer);
  $_me = 0;
  for ($i = 0; $i < $sz; $i += 3) {
  if (substr($_answer, $i, 3) == substr($_solution, $i, 3))
  $_me++;
  }
  return $_me;
  }
  // get point
  function Judge($_answer, $_solution) {
  $sz = strlen($_answer);
  
  $_tot = 0;
  $_me = 0;
  for ($i = 0; $i < $sz; $i += 3) {
  $_tot++;
  if (substr($_answer, $i, 3) == substr($_solution, $i, 3))
  $_me++;
  }
  if ($_tot == 0) return 0;
  else
  return ($_me * 100 / $_tot);
  }
  ?>
  <body class="fonts1">
    <div id="body-wrapper">
      <?php include('gui/header.php') ?>
      <div id="" class="section" style="background-color: #f0f0f0">
        <div class="container" style="text-align: center;">
          <!-- BEGIN BODY -->
          <?php
          $_this_contest = getContestByID($_contestID);
          ?>
          <font color="green">
          <h2><?php echo $_this_contest['conName'] ?> </h2>
          </font>
          <h1>  Report of <?php echo $_username ?>  </h1> <br>
          <!-- SHOW ANSWER -->
          <?php
          // check if user join that contest by tbl_activity
          if (!checkExistActivity($_contestID, $_username)) {
          ?>
          No data found.
          <?php
          }
          else {
          // show them score / rank
          
          ?>
          
          <img src="img/ico1.PNG" />
          <img src="img/ico2.PNG" />
          <img src="img/ico3.PNG" />
          <br>
          <?php
          // get list quiz
          $_listQuiz = getListQuiz($_contestID);
          $_cnt = 0;
          // get all answer if saved
          $_saveAns = getListSaveAnswer($_contestID, $_username);
          // get solutions
          $_sol = getSolutions($_contestID);
          ?>
          <div style="text-align: center;">
            <h3>Correct: <font color="orange"><?php echo countCorrect($_saveAns, $_sol)?>/<?php echo (strlen($_sol) / 3) ?></font>
            
            &nbsp;&nbsp;&nbsp;Point: <font color="red"><?php echo round(Judge($_saveAns, $_sol), 2, PHP_ROUND_HALF_UP)?></font>
            </h3>
          </div>
          <?php
          foreach ($_listQuiz as $_quiz) {
          // counter
          $_cnt++;
          // get question id
          $_questID = getQuestID($_quiz);
          ?>
          <div id = "rcorners" >
            <div style="text-align: left;" >
              <?php echo getMallContent($_questID); ?>
            </div>
            <?php
            $_listAnsID = getListAnswer($_quiz, $_username);
            $_count = 0;
            
            // get position of your answer
            if (isset($_saveAns)) {
            $_yourAns = intval(substr($_saveAns, ($_cnt - 1) * 3, 3));
            $_theSol = intval(substr($_sol, ($_cnt - 1) * 3, 3));
            }
            // get list candidate answer except 'question'
            foreach ($_listAnsID as $_ansID)
            if ($_ansID != $_questID) {
            $_count++;
            
            ?>
            <div style="text-align: left;
              
              <?php if ($_yourAns == $_count){ ?>
              
              <?php if ($_yourAns == $_theSol) {?>
              background-color: #6ef442;
              <?php } else { ?>
              background-color: red;
              <?php } ?>
              <?php  } else
              if ($_theSol == $_count) { ?>
              background-color: orange;
              <?php } ?>
              ">
              <?php echo getMallContent($_ansID); ?> <br>
            </div>
            <?php
            }
            ?>
            <br>
            <p> <strong> Verdict:
              <?php
              if ($_yourAns == 0) {
              ?>
              <font color="orange"> NOT ANSWER</font>
              <?php
              }
              else
              if ($_yourAns == $_theSol) {
              ?>
              <font color="green"> CORRECT </font>
              <?php
              } else {
              ?>
              <font color="red"> IN-CORRECT </font>
              <?php } ?>
            </strong> </p>
          </div>
          <?php
          }
          ?>
        </div>
        <?php
        }
        ?>
        <!-- END BODY -->
      </div>
    </div>
    <?php include('gui/footer.php') ?>
  </body>
</html>