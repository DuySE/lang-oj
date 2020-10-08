<?php
	 // Control voting system
   include('../dbcon.php');
   session_start();
   $_operation_stt = array('mess' => '');
   
   $_operation_stt['mess'] = "OK";
   echo json_encode($_operation_stt);
   exit(0);
   // MUST login first
   if (isset($_SESSION['tmp_uname']) && isset($_SERVER['REQUEST_METHOD']) == 'POST') {
        $_userVote = $_SESSION['tmp_uname'];
        // get post
        if (isset($_POST['comID']))
            $_commentID = $_POST['comID'];
        
        if (isset($_POST['vote_com']))
            $_operation = $_POST['vote_com'];
        
        if ($_operation != 1 && $_operation != -1) {
            //echo "Invalid request";
            $_operation_stt['mess'] = "Invalid request";
        }
        else
        if (isset($_userVote) && isset($_commentID)) {
             $_comment = getComment($_commentID);
             if (isset($_comment)) {
                  if ($_comment['username'] != $_userVote) {
                      if (!checkVote($_userVote, $_commentID)) {
                          
                          // insert new row
                          insertVote($_userVote, $_commentID, $_operation);
                          $_operation_stt['mess'] = "DONE";
                      }
                      else {
                          $_vote_stt = getVote($_userVote, $_commentID);
                          if ($_vote_stt == $_operation)
                              //  echo "Cannot vote twice";
                                 $_operation_stt['mess'] = "Cannot vote twice";
                          else {
                              // delete
                              deleteVote($_userVote, $_commentID);
                              $_operation_stt['mess'] = "DONE";
                          }
                      }
                  }
                  else {
                    //echo "You cannot vote your comment";
                    $_operation_stt['mess'] = "You cannot vote your comment";
                  }
             }
             else {
                //echo "Request failed";
                $_operation_stt['mess'] = "Comment not exist";
            }
        }
        else {
            //echo "Invalid request";
            $_operation_stt['mess'] = "Invalid request";
        }
   }
   else {
      //echo "Not login yet";
      $_operation_stt['mess'] = "You must login to vote this comment";
   }
   // export json file
   echo json_encode($_operation_stt);
   exit(0);
?>