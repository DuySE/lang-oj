<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include('control/configall.php');
include('gui/resource.php');
ob_start();
?>
<?php

$_stt = true;
/* place command & setting flag */
include('control/requireContestID.php');
/* end command */
include('control/permission.php');
?>

<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>

<script>
  
  $(document).ready(function(){
    $("#combox").hide();
    $(".subcom").hide();
    $(".rep_box").hide();
  });
  // animate to some id
  function jump_to_id(ID) {
      $('html, body').animate({
              scrollTop: $("#" + ID).offset().top - 115 }, 2000);

  }
  // show / hide sub comment
  function show_sub_comment( subID ) {
    $("." + subID).show();
    jump_to_id("jp" + subID);
    //event.preventDefault();
  }
  // show / hide writer comment
  function show_combox() {
    $("#combox").show();
    // stop action of cursor link
    //event.preventDefault();
    jump_to_id("combox_tag");
  }

  function hide_combox() {
    $("#combox").hide();
  }
  // hide rep box
  function hide_rep_box(repboxID) {
    $("#" + repboxID).hide();
    event.preventDefault();
  }
  function show_rep_box(repboxID) {
    $("#" + repboxID).show();
    jump_to_id(repboxID);
    //event.preventDefault();
  }
  // AJAX - AMAZING - VOTING
  function request_vote(req_op, comID) {

    var xmlhttp = new XMLHttpRequest();
    // data
    var data = new FormData();
    data.append('comID', comID);
    data.append('vote_com', req_op);
    // send POST-request
    xmlhttp.open("POST", "control/voting.php", true);
    xmlhttp.send(data);
    // recieve data
    xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

    try { // catch JSON error
      var serverMess = JSON.parse(xmlhttp.responseText);
      alert(serverMess.mess);
      if (serverMess.mess != 'DONE')
        alert(serverMess.mess);    
      else {
        // up or down vote
        var e = document.getElementById("com_vote_" + comID);

        var newvote = parseInt(e.innerHTML.trim()) + req_op;

        e.innerHTML = newvote;
        // change color
        ecolor = document.getElementById("com_vote_col_" + comID);
        if (newvote < 0)
          ecolor.style.color = "red";
        else
          ecolor.style.color = "green";
      }
    }
    catch(e) {
    alert("Error occur!");
    }
    }
  }; /**/
    // stop event
    event.preventDefault();
  }


  // AJAX - COMMENT
  // contant

  idProvider = 2122017;

  <?php 
    // prepare information user
    if (isset($_SESSION['tmp_uname'])) {
        $_username = $_SESSION['tmp_uname'];
        $_user_info = getSingleUser($_username);
        $_user_img = $_user_info['imgURL'];
    }

  ?>
  function request_cmt(parID) {
    
    var xmlhttp = new XMLHttpRequest();
    
    // get name of textarea
    var name_txt_are = 'cmt_cont';
    if (parID != -1)
        name_txt_are = name_txt_are + parID;


    // get content of cmt
    var cmtStr = document.getElementsByName(name_txt_are)[0].value;
    // reset this content
    
    // data
    var data = new FormData();
    data.append('parID', parID);
    data.append('cmt_cont', cmtStr);
    data.append('conID', <?php echo $_contestID?>);
    // send POST-request
    xmlhttp.open("POST", "control/add_cmt.php", true);
    xmlhttp.send(data);
    // recieve data
    xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
    try { // catch JSON error
          var serverMess = JSON.parse(xmlhttp.responseText);
          // take the response
          
          alert(serverMess.mess);

          if (serverMess.mess == 'DONE') {
              // 1. RESET THIS COMMENT IF SUCCESSFULLY
              document.getElementsByName(name_txt_are)[0].value = '';
              // 2. ADD CMT TO CONTAINER
              var cmtBox = document.createElement("div");
              cmtBox.innerHTML = '';

              // for parent box
              var parAddHTML = '';
              if (parID == -1)
                 parAddHTML =
                '<div style="padding-left: 20px;">' +
                '<font color="gray">&#8594;</font><a href="#"'+ 
                'onclick="show_rep_box(\'rep'+ serverMess.id +'\')"' + 
                'class="underline_link"> Reply </a> &nbsp;&nbsp;&nbsp;' +
                '<a href="#" class="underline_link"' +  
                'onclick="show_sub_comment('+serverMess.id+')"' + 
                '> Comment (0) </a> ';

              var parCmtBoxHTML = '';
              if (parID == -1)
                parCmtBoxHTML =
                '<div id = "box_'+serverMess.id+'">' +
                '</div>' +
                '<div id = "rep'+serverMess.id+'" class = "rep_box">' +
                '<br>' +
                '<form>' +
                '<textarea textarea rows="4" cols="115" required id = "combox_cont"' +
                'name = "cmt_cont'+serverMess.id+'"' +
                '> </textarea>' +
                '<br>' +
                '<br>' +
                '<input type="button" name="" value="Post" ' +
                'onclick="request_cmt(\''+serverMess.id+'\')"> &nbsp;' +
                '<input type="button" name="" value="Cancel" ' +
                'onclick="hide_rep_box(\'rep'+serverMess.id+'\')">' +
                '</form>' +
                '</div>';

              var sub_part_1 = '<div class = "subcom ' + parID + ' " >';
              var sub_part_2 = '</div>';
              var sub_part_3 = 'sub_com';

              if (parID == -1) {
                  sub_part_1 = '';
                  sub_part_2 = '';
                  sub_part_3 = '';
              }
             // if (parID != -1) {
                 cmtBox.innerHTML = 
                      sub_part_1 +
                      '<br>' +
                      '<div class="comment_display wrap_shadow '+sub_part_3+'" id = "">'+
                      '<table>' +
                      '<tr>' +
                      '<td>' +
                      '<div style="text-align: center; width: 100px;">' +
                          '<a href="profile/<?php echo $_username ?>">'+
                          '<img src="<?php echo $_user_img?>" width="65" height="65">' +
                          '<br>'+
                          '<strong>' +'<?php echo getTitle2($_username)?>' + '</strong></a>'+
                          '</div>' +
                      '</td>' +
                      '<td  class ="content_box">'+
                      '<div class="sub_com_content">' +
                      cmtStr + 
                      '</div>' +
                      parAddHTML +
                      '</td>' +
                      '<td style="padding-left: 20px;">' +
                      '<div style="text-align: center; ">' +
                      '<div>' +
                      '<a href="#" onclick="request_vote(1,'+ serverMess.id +')">' +
                      '<img src="img/vote_up.png">' +
                      '</a>' +
                      '</div>' +
                      '<div>' + 
                      '<font id="com_vote_col'+ serverMess.id +'" color="green">' +
                      '<strong id = "com_vote_'+ serverMess.id + '">' +
                      '0' +
                      '</strong>' +
                      '</font>' +
                      '</div>' +
                      '<div>' +    
                      '<a href="#" onclick="request_vote(-1,'+ serverMess.id +')">' +
                      '<img src="img/vote_down.png">' +
                      '</a>' +
                      '</div>' +
                      '</div>' +
                      '</td>' +
                      '</tr>' +
                      '</table>' +
                      '</div>' +
                      sub_part_2 +
                      parCmtBoxHTML;
                      // add to box

                      var con = document.getElementById("box_" + parID);
                      if (parID == -1)
                          con = document.getElementById("boxx");
                      con.appendChild(cmtBox);
                      //alert(serverMess.id);
                      cmtBox.setAttribute("id", "" + idProvider);
                      if (parID == -1) jump_to_id(idProvider); // jump for parent - cmt
                      idProvider++;
             // }
            }
         }
        catch(e) {
          alert("Error occur!");
        }
      }
    };
    // stop event
   // event.preventDefault();
  }
</script>

<style>
    .wrap_shadow {
      box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.5);
    }

    .sub_com_content {
        padding: 20px 10px 20px 20px;
        width:630px;
        word-wrap: break-word;
    }

    .par_com_content {
        padding: 20px 10px 20px 20px;
        width:730px;
        word-wrap: break-word;
    }
</style>

<body class="fonts1">
  <div id="body-wrapper">
    <?php include('gui/header.php') ?>
   
   
    <!-- BEGIN -->
    <div id="" class="section" style="background-color: #f0f0f0">
      <div class="container" >
        <!-- BODY CONTENT PLACE HERE -->
        <?php include('HTMLtemplate/HTMLTemplate.php') ?>
        <?php
          $_con = getContestByID($_contestID);
          $_list_par_com = getListParentComment($_contestID);
        ?>
        <div id="" class="element text-element  ">
          <div class="text-content">
            <h1 style="text-align: center;"><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:red;"> DISCUSS </span></span></span></h1>
          </div>
        </div>
        <div id="" class="element text-element  ">
          <div class="text-content">
            <h1 style="text-align: center;"><span class="fontSize" style="font-size: 24px; line-height: 1;"><span><span style="color:#696969;"> <?php echo $_con['conName'];?> </span></span></span></h1>
          </div>
          
          <!-- DIFFICULT STAR -->
          <div style="text-align: center;">
            <?php
              $_level = $_con['level'];
              for ($_i = 0; $_i < $_level; $_i++) {
            ?>
            <img src="img/star.png" width="20" height="20" title="dificult level: <?php echo $_level?>">
            <?php } ?>
          </div>
          </div>

          <br>
          <!-- CONTENT POST -->
          <div class = "post wrap_shadow">
            <img src="img/writer.png">
            <a href="profile/<?php echo $_con['author'] ?>">
              <strong>
              <?php
                echo getTitle($_con['author']);
                $_ct = strtotime($_con['createDate']);
              ?>
              </strong>
            </a>
             &nbsp; &nbsp; 
            <img src="img/time.png">&nbsp;<?php echo date('d/m/Y', $_ct) ?>
            <img src="img/clock.png" width="15" height="15">&nbsp;<?php echo date("H:i", $_ct) ?>
            &nbsp;&nbsp;
            <?php if (isset($_SESSION['admin'])) { ?>
              <img src="img/create_topic.png" width="20" height="20">
              <a href="editblog/<?php echo $_con['conID'] ?>"> Edit</a>
              
            <?php } ?>

            <br> <br>
              <!-- content of blog -->
              <div class="content_pos" style="word-wrap: break-word;">
                <?php echo $_con['blog'] ?>
              </div>
            <hr>
            <!-- comment button in here -->
            <div>
              <?php if (isset($_SESSION['tmp_uname'])) {?>
                <a href="#combox_tag" style="" onclick="show_combox()"> Write comment </a>
              <?php } else { ?>
                <a onclick="logReg()" href="#"> Login to write comment </a>
              <?php } ?>
              &nbsp;&nbsp;&nbsp;| <img src="img/comment.png">  <?php echo sizeof($_list_par_com) ?>
            </div>
          </div>
          <!-- COMMENT - BOX -->
          <!-- == COMMENT WRITING BOX == -->
          <?php if (isset($_SESSION['tmp_uname'])) { ?>
            <div id = "combox_tag" ?>
            <div id = "combox" class="">
              <br>
              <form>
                <textarea textarea rows="4" cols="130" required id = "combox_cont"
                name = "cmt_cont"
                > </textarea> <br> <br>
                <input type="button" 
                onclick="request_cmt(-1)" 
                value="Post"> &nbsp;
                <input type="button" name="" value="Cancel" onclick="hide_combox()">
              </form>
            </div>
          <?php } ?>
          <!-- COMMENT DISPLAY BOX -->
          <div id = "boxx"> <!-- BEGIN ROOT OF ALL COMMENT -->
          <?php
            foreach ($_list_par_com as $_par_com) {
            $_list_sub_com = getListSubCom($_par_com['ID']);
          ?>
          <br>
          <!-- COMMENT BLOCK -->
          <div class="comment_display wrap_shadow" id = "jp<?php echo $_par_com['ID']?>">
            <table>
              <tr>
                <td>
                  <?php echo UserBoxTemplate($_par_com['username'])?>
                </td>
                <td  class ="content_box">                  
                  <div class = "par_com_content">
                    <?php echo $_par_com['content']?>
                  </div>
                  
                  <!-- REPLY & SHOW CMT BOX -->
                  <?php
                    echo ReplyAndShowCmtBoxTemplate($_par_com['ID'], sizeof($_list_sub_com));
                  ?>
                </td>
                <!-- VOTE PLACE -->
                <td style="padding-left: 20px;">
                  <?php
                    echo VotingTemplate($_par_com['ID']);
                  ?>
                  
                </td>
              </tr>
            </table>
          </div>
          <!-- AMAZING SUB COMMENT IS HERE....................................................... -->
          <div id = "box_<?php echo $_par_com['ID']?>"> <!-- BEGIN: wrap all cmt to a div tag -->
          <?php
            foreach ($_list_sub_com as $_sub_com) {
            $_sub_user = getSingleUser($_sub_com['username']);
          ?>
          <!-- ALL SUB COMMENT -->
          <div class = "subcom <?php echo $_par_com['ID'];?> " >
            <br >
            <div class="comment_display wrap_shadow sub_com" id = "">
              <table>
                <tr>
                  <td>
                    <div style="text-align: center; width: 100px;">
                      <a href="profile/<?php echo $_sub_com['username'] ?>">
                        <img src="<?php echo $_sub_user['imgURL']?>" width="65" height="65">
                        <br>
                      <strong> <?php echo getTitle($_sub_com['username'])?> </strong> </a>
                    </div>
                  </td>
                  <td  class ="content_box">
                    <!-- content -->
                    <div class="sub_com_content">
                      <?php echo $_sub_com['content']?>
                    </div>
                </td>
                <!-- VOTE-SUB PLACE -->
                <td style="padding-left: 20px;">
                  <?php echo VotingTemplate($_sub_com['ID'])?>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <!-- END SUB COMMENT -->
        <?php } ?>
        </div> <!-- END: wrap all cmt to a div tag -->

          <?php if (isset($_SESSION['tmp_uname'])) { ?>
            <div id = "rep<?php echo $_par_com['ID']?>" class = "rep_box">
              <br>
              <form>
                <textarea textarea rows="4" cols="115" required id = "combox_cont"
                name = "cmt_cont<?php echo $_par_com['ID']?>"
                > </textarea>
                <br>
                <br>
                <input type="button" name="" value="Post" 
                onclick="request_cmt('<?php echo $_par_com['ID']?>')"> &nbsp;
                <input type="button" name="" value="Cancel" onclick="hide_rep_box('<?php echo 'rep'.$_par_com['ID'] ?>')">
              </form>
            </div>
          <?php } ?>
        <?php } ?>
        </div> <!-- END OF PARENT ALL CMT -->
        <!-- END BODY -->
        <br>
      </div>
    </div>
    </div>
    <!-- HORIZONTLE -->
    <?php include('gui/footer.php') ?>
  </body>
</html>
<?php ob_flush() ?>