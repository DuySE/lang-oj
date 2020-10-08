<?php 
  include('control/configall.php');
  include('gui/resource.php');
?>
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
   
   <script>
      var d = document.getElementById("navrate");
      d.className += "active current";
   </script>
   
   <!-- BEGIN -->
   <div id="" class="section" style="background-color: #f0f0f0">
      <div class="container" >
         <div class="text-content hasFontScale" data-fontscale="0.6561">
            <h1 style="text-align: center;"><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:red;"> Hall of fame </span></span></span></h1>
         </div>
         <div id="" class="element text-element">
            <div class="text-content">
               <table border="0" cellpadding="1" cellspacing="1" style="width:100%;">
                  <thead >
                     <tr >
                        <th style="text-align: center;"> # </th>
                        <th style="text-align: center;"> Who </th>
                        <th style="text-align: center;"> Name </th>
                        <th style="text-align: center;"> Trophy </th>
                        <th style="text-align: center;"> Points </th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $_userList = getListUsers();
                        
                        foreach ($_userList as $_user) {
                        
                       
                          $_prizeList = getListPrize($_user['username']);
                        ?>
                     <tr >
                        <td style="text-align: center;">
                            
                            <?php echo computeRanking($_user['username']) ?> 
                          
                        </td>
                        <td style="text-align: center;"> 
                          

                          <strong>
                            <a href="profile/<?php echo $_user['username'] ?>">                              
                          <?php echo getTitle($_user['username']) ?>
                          </a>                          
                          </strong>


                        </td>
                        
                        <td style="text-align: center;"> <?php echo $_user['name'] ?> </td>
                        <td> 
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php 
                                foreach ($_prizeList as $_prize) {
                                      $_prizeInfo = getPrizes($_prize['namePrize']);
                                      
                                  ?>
                                    <img src="<?php echo $_prizeInfo['imgURL']?>" title="<?php echo $_prizeInfo['description']?>" width="30" height = "30">
                                    <strong>
                                    <?php echo $_prize['cnt']?>  
                                    </strong>
                                    &nbsp;&nbsp;
                                  <?php
                                }
                            ?>
                        </td>
                        
                         
                        <td style="text-align: center;"> 
                          <strong>
                          <font color="<?php echo getRankColor($_user['point'])?>">
                            <?php echo $_user['point'] ?> </td>
                          </font>
                          </strong>
                     </tr>
                     <?php  
                        }
                          ?>
                  </tbody>
                  </tbody>
               </table>
            </div>
         </div>
         
         <br>
         
      </div>
   </div>
   <!-- HORIZONTLE -->
   <?php 
      include('gui/footer.php');
      ?>
</body>
</html>