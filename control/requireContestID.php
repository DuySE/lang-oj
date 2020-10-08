<?php
	/* this template for access page requried contestID as get-parameter */
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
          if (isset($_GET['id'])) {
              $_contestID = $_GET['id'];
              if (!is_numeric($_contestID)) $_page_error = 1;
              if (!checkExistContest($_contestID)) $_page_error = 1;
          }
          else
            $_page_error = 1;
      }   
      else {
          $_page_error = 1;
      }  
?>