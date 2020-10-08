<?php 
  ob_start();
    include("control/configall.php");
    include('gui/resource.php');
    include('control/judging.php');
  ?>
<!-- bootstrap -->
  
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

<body class="fonts1">
   <?php 
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      function ana($_longtime) {
             echo floor($_longtime / (60 * 60))." : ".(($_longtime / 60) % 60)." : ".($_longtime % 60)."<br>";
         }
      $date = date('m/d/Y h:i:s a', time());
      ?>
   <script>
      function ana2(longtime) {
          var hours = Math.floor(longtime / (60 * 60));
          var minutes = Math.floor(longtime / 60) % 60;
          var seconds = (longtime % 60);
      
          var timeStr = hours + ":" + ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);
          if (hours >= 24) {
            timeStr = Math.floor(hours / 24) + " days";
          }
      
          return "<font color='gray'>" + timeStr + "</font>";
      }
   </script>
   <div id="body-wrapper">
   <?php include('gui/header.php') ?>
   <script>
      var d = document.getElementById("navcon");
      d.className += "active current";
   </script>
   <!-- BEGIN -->
   <div id="" class="section" style="background-color: #f0f0f0">
      <div class="container" >

        
         <div class="text-content hasFontScale" data-fontscale="0.6561">
            <h1><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:#696969;">Upcoming &amp; Running Contests</span></span></span></h1>
         </div>
         <div id="" class="element text-element">
            <div class="text-content">
               <table border="0" cellpadding="1" cellspacing="1" style="width:100%;">
                  <thead >
                     <tr >
                        <th style="text-align: center;"> # </th>
                        <th style="text-align: center;"> Name </th>
                        <th style="text-align: center;"> Writer </th>
                        <th style="text-align: center;"> Start </th>
                        <th style="text-align: center;"> Length </th>
                        <th> Action </th>
                        <?php if (isset($_SESSION['admin'])) {?>
                        <th> Manage </th>
                        <?php } ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $upConList = getAllContest2();
                        $_cntZero = 0;
                        foreach ($upConList as $_contest) {
                        
                        $_deltime = (strtotime($_contest['beginTime']) + $_contest['duration'] * 60) - strtotime($date);
                        if ($_deltime < 0) continue;
                        $_cntZero++;
                        
                        ?>
                     <tr style="text-align: center;">
                        <td> <?php echo $_cntZero ?> </td>
                        <td> 

                        <a href="blog/<?php echo $_contest['conID'] ?>">  <strong> <?php echo $_contest['conName']?> </strong> </a>

                        </td>
                        <td> <strong> 
                          <a href="profile/<?php echo $_contest['author'] ?>"> <?php echo getTitle($_contest['author'])?></a>
                        </strong></td>
                        <td>
                          <font color = "blue" >
                           <a href="#" style="text-decoration: underline;">
                           <?php 
                              $_beginDate = strtotime($_contest['beginTime']);
                              echo date('d/m/Y', $_beginDate)."<br>".date("H:i", $_beginDate);
                              ?>
                           </a>
                           </font>
                        </td>
                        <td><?php echo $_contest['duration']?></td>
                        <?php 
                           if ($_deltime - $_contest['duration'] * 60 >= 0) {
                           ?>
                        <td style="text-align: center;">
                           before start
                           <div id = "upup<?php echo $_contest['conID']?>"> </div>
                           <script>
                              <?php 
                                 $_diff = strtotime($_contest['beginTime']) - strtotime($date);
                                 ?>
                                  cnt<?php echo $_contest['conID']?> = parseInt("<?php echo $_diff ?>");
                                  var myVar<?php echo $_contest['conID']?> = setInterval(myTimer<?php echo $_contest['conID']?> , 1000);
                                  function myTimer<?php echo $_contest['conID']?>() {
                                      cnt<?php echo $_contest['conID']?>--;
                                    document.getElementById("upup<?php echo $_contest['conID']?>").innerHTML = ana2(cnt<?php echo $_contest['conID']?>);
                                    
                                      if (cnt<?php echo $_contest['conID']?> == 0) {
                                        clearTimeout(myVar<?php echo $_contest['conID']?>);
                                      }
                                  }
                              
                           </script>
                        </td>
                        <?php
                           }
                           else {
                           ?>
                        <td style="text-align: center;" >
                           <strong> <font color="green"> Contest is running </font> </strong> <br>
                           
                           <!-- required login -->
                           <?php if (isset($_SESSION['tmp_uname'])) { ?>
                           <a href="contest/<?php echo $_contest['conID']?>" title = "Join this contest"> <strong> Enter </strong> </a> <br>
                           <?php } ?>

                           Escape time: 
                           <div id = "upup<?php echo $_contest['conID']?>" style="display: inline;"> </div>
                        </td>
                        <script>
                           <?php 
                              $_diff = strtotime($_contest['beginTime']) - strtotime($date) + $_contest['duration'] * 60;
                              ?>
                             cnt<?php echo $_contest['conID']?> = parseInt("<?php echo $_diff ?>");
                             var myVar<?php echo $_contest['conID']?> = setInterval(myTimer<?php echo $_contest['conID']?> , 1000);
                             function myTimer<?php echo $_contest['conID']?>() {
                                 cnt<?php echo $_contest['conID']?>--;
                               document.getElementById("upup<?php echo $_contest['conID']?>").innerHTML = ana2(cnt<?php echo $_contest['conID']?>);
                               
                                 if (cnt<?php echo $_contest['conID']?> == 0) {
                                   clearTimeout(myVar<?php echo $_contest['conID']?>);
                                 }
                             }
                        </script>
                        <?php 
                           }
                           ?>
                        <!-- ADMIN PLACE -->
                        <?php if(isset($_SESSION['admin'])) {?>
                        <td>
                           <?php if ($_contest['islock'] == false) { ?>
                           <a href="edit/<?php echo $_contest['conID']?>"> Edit contest 
                           <img src="img/edit_icon.png" width="20" height="20">
                           </a>
                           <?php } else { ?>
                           <span class="label label-important"> &#x1F512; Locked </span>
                           <br>
                           <a href="edit/<?php echo $_contest['conID']?>"> View </a>
                           <?php } ?>
                        </td>
                        <?php } ?>
                     </tr>
                     <?php  
                        }
                          ?>
                  </tbody>
                  </tbody>
               </table>
            </div>
         </div>
         <div id="" class="element text-element  ">
            <div class="text-content">
               <h1><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:#696969;">Past Contests</span></span></span></h1>
            </div>
         </div>
         <div id="" class="element text-element  ">
            <div class="text-content">
               <table border="0" cellpadding="1" cellspacing="1" style="width:100%;">
                  <thead>
                     <tr>
                        <th style="text-align: center;"> # </th>
                        <th style="text-align: center;"> Name </th>
                        <th style="text-align: center;"> Writer </th>
                        <th style="text-align: center;"> Start </th>
                        <th style="text-align: center;"> Length </th>
                        <th style="text-align: center;"> Standing </th>

                        <?php if (isset($_SESSION['admin'])) {?>
                            <th style="text-align: center;">  Manage </th>
                        <?php } ?>
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
                          <strong>
                            <a href="blog/<?php echo $_contest['conID']?>"> 
                            <?php echo $_contest['conName']?>
                            </a>
                          </strong>
                        </td>
                        <td> <a href="profile/<?php echo $_contest['author'] ?>"> 
                          <strong><?php echo getTitle($_contest['author'])?></strong>
                          </a>
                        </td>
                        <td>
                        <font color = "blue" >
                        <a href="#" style="text-decoration:underline;">
                           <?php 
                              $_beginDate = strtotime($_contest['beginTime']);
                              echo date('d/m/Y', $_beginDate)."<br>".date("H:i", $_beginDate)
                              ?>
                           </a>
                           </font>
                        </td>
                        <td><?php echo $_contest['duration']?></td>
                        <td>
                        <a href="rank/<?php echo $_contest['conID']?>"> Final Standing </a>
                        <?php if (isset($_SESSION['tmp_uname'])) { ?>
                        <br>
                        <a href="contest/<?php echo $_contest['conID']?>"> <strong> Enter </strong> </a>
                        <?php } ?>
                        </td>
                        
                         <?php if (isset($_SESSION['admin'])) {?>
                            <td style="text-align: center;">  
                                <a href="judge/<?php echo $_contest['conID']?>">
                                <?php if (!$_contest['isJudged']) { ?>
                                   <strong> Judge <img src="img/play.png" width="20" height="20"> </strong>
                                <?php } else {?>
                                     Rejudge <img src="img/judged.png" width="20" height="20">
                                <?php } ?>
                                </a>
                            </td>
                        <?php } ?>
                     </tr>
                     <?php  
                        }
                          ?>
                  </tbody>
               </table>
               <p>&nbsp;</p>
            </div>
         </div>
      </div>
   </div>
   <!-- HORIZONTLE -->
   <?php 
      include('gui/footer.php');
      ?>
</body>
</html>
<?php ob_flush() ?>