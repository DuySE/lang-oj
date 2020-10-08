<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include('control/configall.php');
    include('gui/resource.php');
    $date = date('m/d/Y h:i:s a', time());
?>
<link rel="stylesheet" href="design/css/radio.css">
<body class="fonts1">
    <style>
        td {
          background-color: #f0f0f0;
          height: 32px;
          border-bottom: 3px solid white;
        }
        
        table { 
            box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.5);
        }

        
        th {
          background-color: #e23435;
          color: white;

          border-right: 1px solid white;
        }

    </style>
    <div id="body-wrapper">
    <?php include('gui/header.php') ?>
    <?php 
        // get contest Id for practicing
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['id'])) {
                if (is_numeric($_GET['id']))
                    if (checkExistContest($_GET['id']))
                      $_contestID = $_GET['id'];
            }
        }
        ?>
    <script>
        var d = document.getElementById("navprac");
        d.className += "active current";
    </script>
    <!-- BEGIN IN HERE -->
    <div id="" class="section" style="background-color: #f0f0f0">
        <div class="container" >
            <?php 
                if (!isset($_contestID)) {
                ?>
            <div id="" class="element text-element  ">
                <div class="text-content">
                    <h1><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:#696969;">Practice Last Contests</span></span></span></h1>
                </div>
            </div>
            <div id="" class="element text-element  ">
                <div class="text-content">
                    <table border="0" cellpadding="2" cellspacing="2" style="width:100%;">
                        <thead>
                            <tr>
                                <th style="text-align: center;"> # </th>
                                <th style="text-align: center;"> Name </th>
                                <th style="text-align: center;"> Writer </th>
                                <th style="text-align: center;"> Level </th>
                                <th style="text-align: center;"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $upConList = getAllContest();
                                $_cnt = 0;
                                foreach ($upConList as $_contest) {
                                
                                  $_deltime = (strtotime($_contest['beginTime']) + $_contest['duration'] * 60) - strtotime($date);
                                
                                  if ($_deltime >= 0) continue;
                                  $_cnt++;
                                ?>
                            <tr style="text-align: center;">
                                <td> <?php echo $_cnt ?> </td>
                                <td> 
                                    <a href="blog/<?php echo $_contest['conID'] ?>">  <strong> <?php echo $_contest['conName']?> </strong> </a>
                                </td>
                                <td>
                                  <a href="profile/<?php echo $_contest['author'] ?>"> 
                                    <strong><?php echo getTitle($_contest['author'])?></strong>
                                  </a>
                                </td>
                                <td>  
                                    <?php 
                                        $_level = intval($_contest['level']);
                                        for ($i = 0; $i < $_level; $i++) {
                                        ?>
                                    <img src="img/star.png" width="20" height="20">
                                    <?php 
                                        } 
                                        ?>
                                </td>
                                <td>
                                    <a href="practice2.php?id=<?php echo $_contest['conID']?>"> Go </a>
                                </td>
                            </tr>
                            <?php  
                                }
                                  ?>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                </div>
            </div>
            <?php 
                }
                else {
                      $_con = getContestByID($_contestID);
                ?>
            <script>
                ans = "<?php echo getSolutions($_contestID)?>";
                // Judgement place here
                function run_judge_machine() {
                    var len = ans.length / 3;
                    var rr_ac = 0;
                
                  for (i = 1; i <= len; i++) {
                
                         var sys_ans = parseInt(ans.substr(3 * (i - 1), 3));
                         var user_ans = 0;  
                
                         var el = document.getElementsByClassName('ans' + i);
                
                         for (j = 0; j < el.length; j++)
                             if ( el[j].checked ){
                                 user_ans = j + 1;
                                 break;                                
                            }
                
                          // set to default background all
                         for (j = 0; j < el.length; j++) {
                              var get_but = document.getElementById('ans' + i + '_' + (j + 1));
                              get_but.style.backgroundColor = "white";
                             // alert(j + 1);
                         }
                
                          var verdict = document.getElementById("show" + i);
                
                          if (user_ans === 0) {
                              // no-answer
                             var but = document.getElementById('ans' + i + '_' + (sys_ans));
                             but.style.backgroundColor = "orange";
                             verdict.innerHTML = "<strong>Verdict: " + "<font color = 'orange'> No Answer</font></strong>";
                          }     
                          else
                          if (user_ans == sys_ans) {
                              // correct
                              var but = document.getElementById('ans' + i + '_' + (sys_ans));
                              but.style.backgroundColor = "#6ef442";
                              verdict.innerHTML = "<strong>Verdict: " + "<font color = 'green'> Correct </font></strong>";
                              rr_ac++;
                          }
                          else {
                              // in-correct
                              var but_user = document.getElementById('ans' + i + '_' + (user_ans));
                              but_user.style.backgroundColor = "#ff7066";
                              var but_sys = document.getElementById('ans' + i + '_' + (sys_ans));
                              but_sys.style.backgroundColor = "orange";
                              verdict.innerHTML = "<strong>Verdict: " + "<font color = 'red'> In-correct </font></strong>";
                          }
                
                          var dislay_score = document.getElementById("score");
                          dislay_score.innerHTML = "Score: " + "<font color='green'>" + (Math.round(rr_ac * 100 / len))  + "</font>";
                
                        
                }

                     $('html, body').animate({
                          scrollTop: $("#anchor").offset().top - 120 }, 2000);
                      
                }
                
                function reset_all() {

                    $('html, body').animate({
                          scrollTop: $("#anchor").offset().top - 120 }, 2000);
                    //location.reload();
                }
                
            </script>
            <div id="" class="element text-element  ">
                <div class="text-content">
                    <h1 style="text-align: center;"><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:red;"> Practice Contest </span></span></span></h1>
                </div>
            </div>
            <div id="" class="element text-element  ">
                <div class="text-content" id = "anchor">
                    <h1 style="text-align: center;"><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:#696969;"> <?php echo $_con['conName'];?> </span></span></span></h1>
                </div>
            </div>
            <div style="text-align: center;">
                <?php 
                    $_level = $_con['level'];
                    for ($_i = 0; $_i < $_level; $_i++) {
                    ?>
                <img src="img/star.png" width="20" height="20" title="dificult level: <?php echo $_level?>">
                <?php 
                    }
                    ?>
            </div>
            <br>

            <!-- ALL CONTENT DISPLAY HERE -->
            <h3 id = "score" autofocus> </h3>
            <?php 
                $_listQuiz = getListQuiz($_contestID);
                $_cnt = 0;
                
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
                $_listAnsID = getListAnswer($_quiz);
                $_count = 0;
                
                // get list candidate answer except 'question'
                foreach ($_listAnsID as $_ansID) 
                      if ($_ansID != $_questID) {
                        $_count++;
                
                        
                ?>         
          

            <div style="text-align: left;word-wrap: break-word;">
                <div id = "ans<?php echo $_cnt ?>_<?php echo $_count ?>">
                    <label class="custom-control custom-radio">
                    <input id="r_<?php echo $_cnt ?>_<?php echo $_count ?>" 
                    class="ans<?php echo $_cnt?> custom-control-input"
                    name="<?php echo $_cnt ?>" 
                    type="radio" 
                    id = "r_<?php echo $_cnt ?>_<?php echo $_count ?>"
                    >
                    
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"><?php echo getMallContent($_ansID); ?></span>
                    </label>
            </div>
            </div>

            <?php
                }
                ?> 
            </div>

            <div id = "show<?php echo $_cnt?>"> </div>
            <br>
            <?php
                }
                ?>
            <div style="text-align: center;">
            <input type="button" value="Check your answer" class="btn-success"
             onclick="run_judge_machine()" /> 
           <!-- <input type="button" value="Reset" class="btn-success"
            onclick="reset_all()" />  -->
            </div>
            <br> <br>
            <!-- END DISPLAY -->
            <?php 
                } 
                ?>
        </div>
    </div>
    <!-- HORIZONTLE -->
    <?php 
        include('gui/footer.php');
    ?>
</body>
</html>