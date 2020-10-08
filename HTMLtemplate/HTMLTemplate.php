 
 <?php 
    // ALL CONTROL FUNCTION REQUIRED
    function isLogin() {
          if (isset($_SESSION['tmp_uname'])) return true;
          else
              return false;
    }

    // ALL TEMPLATE DISPLAY HERE
    function VotingTemplate($_commentID) {
          // param
          $_imgUpSrc = 'img/vote_up.png';
          $_imgDownSrc = 'img/vote_down.png';
         
          $_idFont = 'com_vote_col_'.$_commentID;
          $_idDisplayPoint = 'com_vote_'.$_commentID;

          $_point = getSumCounter($_commentID);

          $_colorStr = 'color = "red"';
          if ($_point >= 0)
            $_colorStr = 'color = "green" ';

          // make-template
          $_templateStr =   
          '<div style="text-align: center; ">
          <div>
            <a href="#" onclick="request_vote(1, '.$_commentID.')">
            <img src=" '. $_imgUpSrc .' ">
            </a>
          </div>
          <div>
              <font id="'.$_idFont.'" '. $_colorStr .'>
              <strong id = "'.$_idDisplayPoint.'">
                  '. $_point .'
              </strong>
              </font>
          </div>
          <div>    
              <a href="#" onclick="request_vote(-1, '.$_commentID.')">
              <img src=" '. $_imgDownSrc .' ">
              </a>
          </div>
          </div>';

          return $_templateStr;
    }

    function UserBoxTemplate($_username) {
        // param
        $_userInfor = getSingleUser($_username);
        $_imgSrc = $_userInfor['imgURL'];
        $_title = getTitle($_username);

        // make template
        $_templateStr = '
        <div style="text-align: center; width: 100px;">
        <a href="profile/'.$_username.'"> 
        <img src="'.$_imgSrc.'" width="65" height="65">
        <br>
        <strong>'.$_title.'</strong> 
        </a>
        </div>';

        return $_templateStr;
    }

    function ReplyAndShowCmtBoxTemplate($_parentID, $_sizeSub) {
        // param
        $_replyID = 'rep'.$_parentID;
        $_replyTmp = '';
        
        if (isLogin())
            $_replyTmp = 
        '<font color="gray"> &#8594; </font><a href="#" onclick="show_rep_box(\''.$_replyID.'\')" class="underline_link"> Reply </a> &nbsp;&nbsp;&nbsp;';

        // make template
        $_templateStr =
          '<div style="padding-left: 20px;">
              '.$_replyTmp.'
              <a href="#" class="underline_link" 
              onclick="show_sub_comment('.$_parentID.')" 
              > Comment ('.$_sizeSub.') </a> 
          </div>';

        return $_templateStr;
    }

 ?>

            