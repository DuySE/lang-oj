<!-- Set z-index for register and login modal -->
<?php
    if (isset($_SESSION['tmp_uname'])) {
        $_info = getSingleUser($_SESSION['tmp_uname']);
        $_admin = $_info['role'];    
    }
    // $_SESSION['page'] = $_SERVER['PHP_SELF'];
    // $_page = $_SESSION['page'];
?>
<style>
    #logReg {
        margin-top: 3%;
        float: right;
    }
</style>
<header>
    <div id="header-body" class="section">
        <div class="container" style="height:100%">
            <div id="menu" class="el-locked horizontal-menu" data-menubdrwidth="0" data-itemscretch="true" data-caretclass="fa-caret-down" data-submenuorientation="h" data-btnalign="left" data-textalign="left" data-shrink="false" data-shrinklabel="">
                <div class="navbar">
                    <div id="nav_7" class="container">
                        <ul class="nav" style="width: 532px;">
                            <li class="" style="height: 100%; width: 133px;" id="navhome">
                                <a href="./" class="menuPageLink ">
                                    <div class="menulink-wrapper"><span class="text-wrapper">Home</span></div>
                                </a>
                            </li>
                            <li class="" style="height: 100%; width: 133px;" id="navcon">
                                <a href="contests" class="menuPageLink ">
                                    <div class="menulink-wrapper"><span class="text-wrapper">Contests</span></div>
                                </a>
                            </li>
                            <li class="" style="height: 100%; width: 133px;" id="navprac">
                                <a href="practices" class="menuPageLink ">
                                    <div class="menulink-wrapper"><span class="text-wrapper">Practice</span></div>
                                </a>
                            </li>
                            <li style="height: 100%; width: 133px;" class="" id="navrate">
                                <a href="rating" class="menuPageLink ">
                                    <div class="menulink-wrapper"><span class="text-wrapper">Rating</span></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="el-44083" class="element mobileMenu-element">
                <script>
                    // Get the modal
                    var modal = document.getElementById('id01');
                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                          if (event.target == modal) {
                                modal.style.display = "none";
                          }
                    }
                </script>
                <div class="mobile-menu mCustomScrollbar _mCS_1 mCS_no_scrollbar" style="height: 621px;">
                    <div id="mCSB_1" class="mCustomScrollBox mCS-mobile-menu-light mCSB_vertical mCSB_inside" tabindex="0">
                        <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                            <ul class="mobile-menu-links">
                                <li class=" selected current ">
                                    <a href="" class="">Home</a>
                                    <ul>
                                    </ul>
                                </li>
                                <li class="<?= DOMAIN ?>contest">
                                    <a href="" class="">Contests</a>
                                    <ul>
                                    </ul>
                                </li>
                                <li class="practice">
                                    <a href="" class="">Practice</a>
                                    <ul>
                                    </ul>
                                </li>
                                <li class="rating">
                                    <a href="" class="">Rating</a>
                                    <ul>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-mobile-menu-light mCSB_scrollTools_vertical" style="display: none;">
                            <div class="mCSB_draggerContainer">
                                <div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px;" oncontextmenu="return false;">
                                    <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
                                </div>
                                <div class="mCSB_draggerRail"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="logReg">
               
                <?php if (isset($_SESSION['tmp_uname'])) { ?>
                <a href="profile/<?php echo $_SESSION['tmp_uname'] ?>">
                    <span id="greeting">Hello <span style="font-family: 'Oswald'; font-size:18px">
                        <?php
                            if (isset($_info)) {
                               // $_fname = strrpos($_info['name'], " ") + 1;
                               // echo substr($_info['name'], $_fname);
                                echo $_info['username'];
                            }
                        ?>
                        <?php
                            $_imgSrc =  getImg($_SESSION['tmp_uname']);
                            ?>
                        <img id="photo" src="<?php echo $_imgSrc ?>" width="25" height="25">
                        </span>
                        <?php } ?>
                        <?php if (isset($_SESSION['tmp_uname'])) { ?>
                            <div id="el-191009" class="element text-element">
                                <div class="text-content">
                                    <div>
                                        <span class="fontSize" style="font-size: 14px; line-height: 1;" id="rank">
                                            <strong>#<?php echo computeRanking($_info['username']) ?>
                                            </strong>&nbsp;
                                        </span>
                                        <span class="fgColor" style="color:#ffaa00;" id="point">
                                            <span class="fontSize" style="font-size: 11px; line-height: 1;">&#9899;&nbsp;</span><?php echo $_info['point'] ?>
                                        </span>
                                        <span class="fontSize" style="font-size: 14px; line-height: 1;">&nbsp;&nbsp;
                                    </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!isset($_SESSION['tmp_uname'])) { ?>
                        <!-- Register -->
                            <a href="#" onclick="document.getElementById('id02').style.display='block'" id="reg">
                                <span class="fontSize" style="font-size: 14px; line-height: 1">Register&emsp;&nbsp;</span>
                            </a>
                        <?php } else { ?>
                            <?php if ($_admin == 1) { ?>
                                <a href="manage/" id="reg">
                                    <span class="fontSize" style="font-size: 14px; line-height: 1; color:#4169e1">
                                        <strong>Manage</strong>
                                        <img src="img/setting.png" width="20" height="20">
                                    </span>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </span>
                </a>
                <!-- Login -->
                <span class="fontSize" style="font-size: 14px; line-height: 1; padding-left: 8px">
                    <a href="#" onclick="logReg()" id="log">
                    <?php if (isset($_SESSION['tmp_uname'])) { ?>
                    Logout
                    <?php } else { ?>
                    Login
                    <?php } ?>
                    </a>
                    <script>
                        function logReg() {
                           var isLogout = document.getElementById('log').innerHTML;
                           if (isLogout.trim() === 'Logout') {
                              window.location.href = 'logout.php';
                           }
                           else {
                              document.getElementById('id01').style.display='block';
                           }
                        }
                    </script>
                </span>
                <!-- End of login -->
                <div id="verticalLine" class="element verticalLine-element">
                    <div class="verticalLine-wrapper">
                        <div class="verticalLine"></div>
                    </div>
                </div>
            </div>
            <?php include('gui/login.php') ?>
            <?php include('gui/register.php') ?>
            <div id="el-14203" class="element text-element  ">
                <div class="text-content hasFontScale" data-fontscale="0.9">
                    <p>PRACTICES &amp; CONTESTS</p>
                </div>
            </div>
            <div id="el-13668" class="element text-element  ">
                <div class="text-content hasFontScale" data-fontscale="0.729">
                    <a href="">
                        <h1 class="title1">Languages Online Judge</h1>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>