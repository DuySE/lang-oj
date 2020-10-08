<?php
include('control/configall.php');
// ACCESS CONTROL
$_stt = true;
/* place command & setting flag */

include('control/requireContestID.php');
/* end command */

include('control/permission.php');
// END ACESS CONTROL
include('gui/resource.php');
function getPrize($_rank) {
if ($_rank <= 3) {
$_imgName = 'img/gold.png';
if ($_rank == 2) $_imgName = 'img/silver.png';
if ($_rank == 3) $_imgName = 'img/bronze.png';
$_res = '<img src="'.$_imgName.'" width = 30 height = 30/>';
return $_res;
}
}
?>

  
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

<!-- bootstrap -->
<body class="fonts1">
    <div id="body-wrapper">
        <?php include('gui/header.php') ?>
        <!-- BEGIN -->
        <div id="" class="section" style="background-color: #f0f0f0">
            <div class="container">
                <div class="text-content hasFontScale" data-fontscale="0.6561" style="text-align: center">
                    <h1>
                    <span class="fontSize" style="font-size: 24px; line-height: 1">
                        <span style="font-family:oswald">
                            <span style="color:#696969"><h1><?php echo getContestName($_contestID) ?></h1>
                            </span>
                            <h3 style="text-align: center"> <font color = "red"> Ranking </font> </h3>
                        </span>
                    </span>
                    </h1>
                </div>
                <div id="" class="element text-element">
                    <div class="text-content">
                        <table border="0" style="width:100%">
                            <thead >
                                <tr >
                                    <th style="text-align: center"> #  </th>
                                    <th style="text-align: center">Who</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Point</th>
                                    <th style="text-align: center">Prize</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $_us = getListUserJoinContest($_contestID);
                                $_cnt = 0;
                                foreach ($_us as $_member) {
                                $_cnt++;
                                $_acc = getSingleUser($_member['username']);
                                ?>
                                <tr style="text-align: center">
                                    <td><strong><?php echo computeRank($_contestID, $_acc['username']); ?></strong></td>
                                    <td>
                                        <strong>
                                        <a href="profile/<?php echo $_acc['username'] ?>">
                                            <?php echo getTitle($_acc['username']) ?>
                                        </a>
                                        </strong>
                                    </td>
                                    <td><?php echo $_acc['name'] ?></td>
                                    <td>
                                    <a href="report/<?php echo $_contestID?>/<?php echo $_member['username']?>" title = "View Report">
                                        <strong>
                                        <?php echo round($_member['point'], 2, PHP_ROUND_HALF_UP)?>
                                        </strong>
                                    </a>
                                    </td>
                                    <td>
                                        <?php if (round($_member['point'], 2, PHP_ROUND_HALF_UP) > 0) echo getPrize(computeRank($_contestID, $_acc['username'])); ?>
                                    </td>
                                   

                                </tr>
                                <?php }
                                if ($_cnt == 0) {
                                ?>
                                <tr> <td>
                                    No data found.
                                </td> </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
            </div>
        </div>

        <!-- HORIZONTLE -->
        <?php
        include('gui/footer.php');
        ?>
    </body>
</html>