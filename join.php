<?php
ob_start();
include('control/configall.php');
include('gui/resource.php');
// ACCESS CONTROL
$_stt = true;
/* place command & setting flag */
if (!isset($_SESSION['tmp_uname'])) $_need_login = 1;
include('control/requireContestID.php');
/* end command */
include('control/permission.php');
// END ACESS CONTROL

// get session username
$_username = $_SESSION['tmp_uname'];
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');

// get current date
$date = date('m/d/Y h:i:s a', time());
?>
<!-- <head> -->
<!-- </head> -->
<?php
// get time
function ana($_longtime) {
echo floor($_longtime / (60 * 60))." : ".(($_longtime / 60) % 60)." : ".($_longtime % 60)."<br>";
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
// get prize title
function getPrizeTitle($_rank) {
// zero point don't have prize
GLOBAL $_contestID;
GLOBAL $_username;
if (getContestPoint($_contestID, $_username) == 0) $_rank = 11;
// get title
if ($_rank == 1) return "Gold Trophy";
if ($_rank == 2) return "Silver Trophy";
if ($_rank == 3) return "Bronze Trophy";
if ($_rank <= 10) return "Badge of Top 10";
}
// get prize img
function getPrizeImg($_rank) {
// zero point don't have prize
GLOBAL $_contestID;
GLOBAL $_username;
if (getContestPoint($_contestID, $_username) == 0) $_rank = 11;
// get img
if ($_rank == 1) return "img/prize/gold.png";
if ($_rank == 2) return "img/prize/silver.png";
if ($_rank == 3) return "img/prize/bronze.png";
if ($_rank <= 10) return "img/prize/top10.png";
return "img/prize/noprize.jpg";
}
?>
<script>
// get remain time :D
function ana(longtime) {
var hours = Math.floor(longtime / (60 * 60));
var minutes = Math.floor(longtime / 60) % 60;
var seconds = (longtime % 60);
var timeStr = hours + ":" + ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);
if (hours >= 24) {
timeStr = Math.floor(hours / 24) + " days";
}
return '<h2><font color = "gray">' + timeStr + '</font><h2>';
}
// hide & show => JQUERY
$(document).ready(function(){

$("#myact").hide();

$("#show").click(function(){
$("#myact").show();

$('html, body').animate({
scrollTop: $("#myact").offset().top - 115 }, 2000);
});
});
</script>
<!-- CSS -->
<style>
#rcorners {
border-radius: 25px;
padding: 20px;
margin-bottom: 10px;
width: 100%;
background: white;
box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.5);
}
/** SAVE BUTTON **/
.btn-success {
color: #fff;
background-color: #5cb85c;
border-color: #4cae4c;
border-radius: 4px;
border: none;
height: 35px;
box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.5);
width: 100px;
}
.btn-success:focus,
.btn-success.focus {
color: #fff;
background-color: #449d44;
border-color: #255625;
}
.btn-success:hover {
color: #fff;
background-color: #449d44;
border-color: #398439;
cursor: pointer;
}
/** **/
.btn-submit {
color: #fff;
background-color: #5cb85c;
border-color: #4cae4c;
border-radius: 4px;
border: none;
height: 35px;
box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.5);
width: 100px;
}
.btn-submit:focus,
.btn-submit.focus {
color: #fff;
background-color: #449d44;
border-color: #255625;
}
.btn-submit:hover {
color: #fff;
background-color: #449d44;
border-color: #398439;
cursor: pointer;
}
</style>
<link rel="stylesheet" href="design/css/radio.css">
<body class="fonts1">
  <div id = "body-wrapper">
    <?php
    include('gui/header.php');
          
    //************************************************//
    $_contest = getContestByID($_contestID);
    
    $_deltime = (strtotime($_contest['beginTime']) + $_contest['duration'] * 60) - strtotime($date);
    
    ?>
    <div id="" class="section" style="background-color: #f0f0f0">
      <div class="container" >
        <!-- BEGIN HERE -->
        <div class="container" style="text-align: center;">
          <?php
          
          if ($_deltime < 0) {
          ?>
          <h1> Contest ended </h1> <br> <br> <br>
          <!-- Contest ended -->
          <!-- SHOW ANSWER -->
          <?php
          // check if user join that contest by tbl_activity
          if (!checkExistActivity($_contestID, $_username)) {
          ?>
          <img src="img/notfound.png" />
          <h3> <font color = "blue"> Opps, you did not enroll this contest. </font> </h3>
          <?php
          }
          else
          if ($_contest['isJudged'] == false) {
          ?>
          <img src="img/coffe.png" width="300" height="300"> <br>
          <h4>
          Well, We are working in judging your submission and analysis rating.
          </h4>
          <h4>
          It's will take some minutes. Take a cup of coffee and relax.
          </h4>
          <?php
          }
          else {
          // show them score / rank
          
          $_userrank = computeRank($_contestID, $_username);
          ?>
          <img src="<?php echo getPrizeImg($_userrank)?>" width="200" height="200" /> <br>
          <font color="green">
          
          <?php
          if ($_userrank <= 10 && getContestPoint($_contestID, $_username) > 0) {
          ?>
          <h3> What a performance! You got <strong>
          <?php echo getPrizeTitle($_userrank); ?>
          </strong>
          
          </h3>
          <?php
          }
          ?>
          
          <h3> Take place <strong> #<?php echo computeRank($_contestID, $_username) ?></strong> out of <strong> <?php echo countCompetition($_contestID)?> </strong> competition </h3>
          
          
          </font>
          <br>
          <!-- VIEW USER ACTIVITY -->
          
          <input type="image" src="img/down.png" width="100" height="50" value="SHOW SOLUTIONS" id="show"/>
          <div id = "myact">
            <?php
            // get list quiz
            $_listQuiz = getListQuiz($_contestID);
            $_cnt = 0;
            // get all answer if saved
            $_saveAns = getListSaveAnswer($_contestID, $_username);
            // get solutions
            $_sol = getSolutions($_contestID);
            ?>
            <br>
            <img src="img/ico1.PNG" />
            <img src="img/ico2.PNG" />
            <img src="img/ico3.PNG" />
            <br>
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
              <div style="text-align: left;word-wrap: break-word;" >
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
              <div style="text-align: left;word-wrap: break-word;
                
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
          
          }
          else
          if ( strtotime($_contest['beginTime']) > strtotime($date) ){
          ?>
          <h1> Contest is not start </h1>
          <h3> Before contest </h3>
          <!-- Countdown timer -->
          <div id = "upup<?php echo $_contest['conID']?>"> </div>
          
          <script>
          <?php
          $_diff = strtotime($_contest['beginTime']) - strtotime($date);
          ?>
          cnt<?php echo $_contest['conID']?> = parseInt("<?php echo $_diff ?>");
          var myVar<?php echo $_contest['conID']?> = setInterval(myTimer<?php echo $_contest['conID']?> , 1000);
          function myTimer<?php echo $_contest['conID']?>() {
          cnt<?php echo $_contest['conID']?>--;
          document.getElementById("upup<?php echo $_contest['conID']?>").innerHTML = ana(cnt<?php echo $_contest['conID']?>);
          
          if (cnt<?php echo $_contest['conID']?> == 0) {
          clearTimeout(myVar<?php echo $_contest['conID']?>);
          location.reload();
          }
          }
          </script>
          <!-- END countdown timer -->
          <?php
          } else {
          ?>
          <!-- Working with RUNNING CONTEST -->
          <h1> <?php echo $_contest['conName'] ?></h1>
          <h4> <font color="green">Contest is running</font> </h4>
          <!-- Timer place here -->
          <div id = "upup<?php echo $_contest['conID']?>"> </div>
          <script>
          <?php
          $_diff = strtotime($_contest['beginTime']) - strtotime($date) + $_contest['duration'] * 60;
          ?>
          cnt<?php echo $_contest['conID']?> = parseInt("<?php echo $_diff ?>");
          var myVar<?php echo $_contest['conID']?> = setInterval(myTimer<?php echo $_contest['conID']?> , 1000);
          function myTimer<?php echo $_contest['conID']?>() {
          cnt<?php echo $_contest['conID']?>--;
          document.getElementById("upup<?php echo $_contest['conID']?>").innerHTML = ana(cnt<?php echo $_contest['conID']?>);
          
          // IF TIME OUT
          if (cnt<?php echo $_contest['conID']?> == 0) {
          clearTimeout(myVar<?php echo $_contest['conID']?>);
          
          //1. notify if end contest
          alert("Contest is end");
          //2. update current answer to database
          // jquery for checking exist sub-button
          if ($('#subBut').length > 0) {
          document.getElementById("subBut").click();
          }
          else // try obmit else and see the result
          // reload page to see result
          location.reload();
          }
          }
          </script>
          <!-- END TIMER -->
          <?php
          $_done = isDoneContest($_contestID, $_username);
          if (isset($_done) && $_done == true) {
          ?>
          <font color="green">
          <img src="img/done.png" width="300" height="300" />
          <br>
          <h3> Congrats, You've done this contest.</h3>
          <h3> Take relax, and wait for result until contest end.</h3>
          </font>
          <?php
          }
          else {
          ?>
          <!-- LIST QUESTION DISPLAY HERE -->
          <form action = "control/submit.php" method="post">
            <input type="hidden" name="conID" value="<?php echo $_contestID?>" />
            <?php
            $_listQuiz = getListQuiz($_contestID);
            $_cnt = 0;
            // get all answer if saved
            $_saveAns = getListSaveAnswer($_contestID, $_username); // '000/001/012/...'
            foreach ($_listQuiz as $_quiz) {
            $_cnt++;
            // get question id
            $_questID = getQuestID($_quiz);
            ?>
            <div id = "rcorners">
              <div style="text-align: left;word-wrap: break-word;">
                <?php echo getMallContent($_questID); ?>
              </div>
              <?php
              $_listAnsID = getListAnswer($_quiz, $_username);
              $_count = 0;
              
              // get position of your answer
              if (isset($_saveAns))
              $_yourAns = intval(substr($_saveAns, ($_cnt - 1) * 3, 3));
              // get list candidate answer except 'question'
              foreach ($_listAnsID as $_ansID)
              if ($_ansID != $_questID) {
              $_count++;
              
              ?>
              <div style="text-align: left; word-wrap: break-word;">
                <label class="custom-control custom-radio">
                  <input id="r_<?php echo $_cnt ?>_<?php echo $_count ?>"
                  class="custom-control-input"
                  name="ans<?php echo $_cnt?>"
                  type="radio"
                  value="<?php echo $_count; ?>"
                  id = "r_<?php echo $_cnt ?>_<?php echo $_count ?>"
                  <?php if (isset($_yourAns) && $_yourAns == $_count){ ?> checked <?php } ?>
                  >
                  
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description"><?php echo getMallContent($_ansID); ?></span>
                </label>
              </div>
              <?php
              }
              ?>
            </div>
            <br>
            <?php
            }
            ?>
            <input type="submit" value="Save" name="bnAction" class="btn-success" />
            &nbsp;
            <input type="submit" value="Submit" name="bnAction" id = "subBut" class="btn-submit" />
            <input type="hidden" name="numAns" value="<?php echo $_cnt?>" />
            <br> <br>
            
          </form>
          
          <?php
          }
          }
          ?>
        </div>
        <!-- END HERE -->
        <br>
      </div>
    </div>
  </div>
  <?php
  include('gui/footer.php');
  ?>
</body>
</html>
<?php ob_flush(); ?>