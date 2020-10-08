<?php
	// ********* JUDGING SYSTEM **************************//
    // add an achivement
    function addNewPrize($_user, $_prizeName) {
        if (strlen($_prizeName) == 0) return;
        $_cntPrize = getCountPrize($_user, $_prizeName);
        $_cntPrize++;
        if ($_cntPrize == 1) {
            addPrize($_user, $_prizeName, $_cntPrize); // add new
        }
        else
          updatePrize($_user, $_prizeName, $_cntPrize); // update
    }
    // del an achivement
    function delOldPrize($_user, $_prizeName) {
        if (strlen($_prizeName) == 0) return;
        $_cntPrize = getCountPrize($_user, $_prizeName);
        $_cntPrize--;
        if ($_cntPrize < 0) return;
        if ($_cntPrize == 0) {
            delPrize($_user, $_prizeName); // del
        }
        else
           updatePrize($_user, $_prizeName, $_cntPrize); // update
    }
    // get Prize name
    function getPrize($_user, $_conID) {
        //echo $_user."<br>".$_conID."<br>";
        $_rank = computeRank($_user, $_conID);
        $_point = getContestPoint($_conID, $_user);
        if ($_point == 0) return ''; // zero point ==> no prize
        if ($_rank == 1) return 'gold';
        if ($_rank == 2) return 'silver';
        if ($_rank == 3) return 'bronze';
        if ($_rank <= 10) return 'top10';
        return '';
    }
    // get bonus point
    function getBonus($_user, $_conID) {
        $_rank = computeRank($_user, $_conID);
        $_point = getContestPoint($_conID, $_user);
        if ($_point == 0) return 0; // zero no aware
        if ($_rank == 1) return 50;
        if ($_rank == 2) return 20;
        if ($_rank == 3) return 10;
        if ($_rank <= 10) return 5;
        return 0;
    }
    // remove old prize
    function removeOldPrize($_conID) {
         $_con = getContestByID($_conID);
        if (!$_con['isJudged']) return; // not judged yet

        $_listUser = getListUserJoinContest($_conID);
        foreach ($_listUser as $_username) {
            $_prizeName = getPrize($_username['username'], $_conID);
            if (strlen($_prizeName) > 0) 
              delOldPrize($_username['username'], $_prizeName);
        }
    }

    // add new prize
    function updateAllNewPrize($_conID) {
        $_listUser = getListUserJoinContest($_conID);
        foreach ($_listUser as $_username) {
            $_prizeName = getPrize($_username['username'], $_conID);
            if (strlen($_prizeName) > 0)
              addNewPrize($_username['username'], $_prizeName);
        }
    }
    // judge
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

    // make report of contest
    function makeRepoto($_contestID) {
        $_ac = getAllAction($_contestID);
        $_ans = getSolutions($_contestID);
        foreach ($_ac as $_user) {
          $_point = Judge($_user['ans'], $_ans);
          $_username = $_user['username'];
          addToRepoto($_contestID, $_username, $_point);
        }
    }

    // delete old point => O(N^2)
    function normalizeRanking($_contestID) {
        $_con = getContestByID($_contestID);
        if ($_con['isJudged']) { // contest have been judeged
            $_list_repoto = getRepoto($_contestID);
            $_sz = sizeof($_list_repoto);

            for ($_i = 0; $_i < $_sz; $_i++) {
                
                $_add = 0;
                
                $_name = $_list_repoto[$_i]['username'];

                $_cur_point = getPoint($_name);

                $_cur_result = $_list_repoto[$_i]['point'];

                // user have higher rating
                for ($_j = $_i + 1; $_j < $_sz; $_j++) {
                    $_other_name = $_list_repoto[$_j]['username'];
                    $_other_point = getPoint($_other_name);
                    $_other_result = $_list_repoto[$_j]['point'];
                    // bad result! so you have + point
                    if ($_other_point >= $_cur_point && $_other_result > 0) $_add++;
                }
                // user have lower rating
                for ($_j = $_i - 1; $_j >= 0; $_j--) {
                    $_other_name = $_list_repoto[$_j]['username'];
                    $_other_point = getPoint($_other_name);
                    $_other_result = $_list_repoto[$_j]['point'];
                    // people have lower rating but have high rating! so you get - point
                    if ($_other_point < $_cur_point && $_other_result > 0) $_add--;
                }
                // normal
                $_cur_point = $_cur_point - $_add - getBonus($_name, $_contestID);
                setPoint($_name, $_cur_point);
            }
        }
    }

    // update ranking contest => O(N^2)
    function updateRanking($_contestID) {
            // get report from contest
            $_list_repoto = getRepoto($_contestID);
            $_sz = sizeof($_list_repoto);

            for ($_i = 0; $_i < $_sz; $_i++) {
                $_add = 0;
                $_name = $_list_repoto[$_i]['username'];

                $_cur_point = getPoint($_name);

                $_cur_result = $_list_repoto[$_i]['point'];

                // user have higher rating
                for ($_j = $_i + 1; $_j < $_sz; $_j++) {
                    $_other_name = $_list_repoto[$_j]['username'];
                    $_other_point = getPoint($_other_name);
                    $_other_result = $_list_repoto[$_j]['point'];
                    // bad result! so you have + point
                    if ($_other_point >= $_cur_point && $_other_result > 0) $_add++;
                }
                // user have lower rating
                for ($_j = $_i - 1; $_j >= 0; $_j--) {
                    $_other_name = $_list_repoto[$_j]['username'];
                    $_other_point = getPoint($_other_name);
                    // people have lower rating but have high rating! so you get - point
                    if ($_other_point < $_cur_point && $_other_result > 0) $_add--;
                }
                // update with new point 
                $_cur_point = $_cur_point + $_add + getBonus($_name, $_contestID);
                setPoint($_name, $_cur_point);
        }
    }
    // ******************* END JUDGING SYSTEM *******************************************

    // have one request: Judging
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

      if (isset($_SESSION['admin']) && isset($_GET['jid'])) {
          $_conID = $_GET['jid'];
          if (checkExistContest($_conID)) {
              // 1. remove old prize
              removeOldPrize($_conID); // need not judge
              // 2. normal data
              normalizeRanking($_conID); // need not judge
              // 3. delete old report
              deleteRepoto($_conID); // need not judge
              // 4. judging
              makeRepoto($_conID);
              // 5. notify done judging
              setDoneJudge($_conID);
              // 6. update new ranking
              updateRanking($_conID);
              // 7. add new prize
              updateAllNewPrize($_conID);
              // 8. annoucement done contest by alert()
              $_SESSION['sys_msg'] = 'Contest is judged.';
          }
      }
  }
  /******** END JUDGING SYSTEM ***************************/
?>