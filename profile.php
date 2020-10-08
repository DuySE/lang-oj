<?php
    include('control/configall.php');
    include('gui/resource.php');
    ob_start();
    $_status = 'NO';
    // Get status of user
    if (isset($_SESSION['tmp_uname'])) $_status = $_SESSION['tmp_uname'];
    if (isset($_GET['user'])) $_status = $_GET['user'];
    $_info = getSingleUser($_status);    

    $_stt = true;
    if (!isset($_info['username'])) $_page_error = 1;
    include('control/permission.php');
    // Get avatar
    $_avatar = getImg($_status);
    if (strlen($_avatar) == 0 || !file_exists($_avatar)) $_avatar = 'img/user.png';
?>
    <head>
        <style>
        .form-control:focus {
            border-color: #ccc;
            box-shadow: none;
            outline: none;
        }
        </style>
        <?php
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
        <script>
            ​$('input').on('keydown', function (e) {
                return e.which !== 32;
            });​​​​
        </script>
    </head>

    <body class="fonts1">
        <div id="body-wrapper">
            <?php include('gui/header.php') ?>
            <div id="" class="section" style="background-color: #f0f0f0">
                <div id="" class = "container">
                    <!-- BEGIN BODY CONTENT -->
                    <div class="text-justify photo">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <img src="<?php echo $_avatar ?>" alt="avatar" id="avatar">
                            <div class="caption">
                                <?php if (isset($_SESSION['tmp_uname']) && $_SESSION['tmp_uname'] == $_status) { ?> 
                                <strong>Change avatar</strong><br>
                                <input type="file" id="face" name="face"><br><br>
                                <input type="submit" value="Upload" name="submit" class="btn-success">
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                    <div class="info text-justify">
                        <font color="<?php echo getRankColor(getSingleUser($_status)['point']) ?>">
                        <h2><?php echo getSingleUser($_status)['name'] ?></h2>
                        </font>
                        <h4>
                        @<?php echo $_status; ?>                        
                        <?php 
                            $_prizeList = getListPrize($_status);
                                foreach ($_prizeList as $_prize) {
                                    $_prizeInfo = getPrizes($_prize['namePrize']);
                                      
                                ?>
                                <img src="<?php echo $_prizeInfo['imgURL']?>" title="<?php echo $_prizeInfo['description']?>" width="30" height = "30">
                                <strong><?php echo $_prize['cnt']?></strong>
                                &nbsp;&nbsp;
                        <?php } ?>
                        </h4>
                        <table style="font-size:16px">
                            <tr>
                                <td><strong>Rank</strong></td>
                                <td id="rank" style="padding-left:100px">
                                    <?php echo computeRanking($_status) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Point</strong></td>
                                <td id="point" style="padding-left:100px">
                                    <?php echo getSingleUser($_status)['point'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Last active:</strong></td>
                                <td id="active" style="padding-left:100px">
                                    <?php
                                        if (isset($_SESSION['tmp_uname']) && getSingleUser($_status)['username'] === $_SESSION['tmp_uname']) {
                                    ?>
                                    online now
                                    <?php } else { ?>
                                    offline now
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php if (isset($_SESSION['tmp_uname']) && $_SESSION['tmp_uname'] == $_status) { ?>
                    <div class="change text-justify">
                        <hr>
                        <h1 class="title1">
                        <span style="font-weight:400">
                            <span class="fontSize" style="font-size: 28px; line-height: 1">
                                <span class="fontFamily" style="font-family: oswald; line-height: 1">Change password</span>
                            </span>
                        </span>
                        </h1>
                        <form method="post" action="profile_validate.php">
                            <input type="password" placeholder="Current password" name="oldPass" required>
                            <input type="password" placeholder="New password" name="newPass" required>
                            <input type="password" placeholder="Confirm password" name="conPass" required>
                            <button type="submit" class="btn btn-success">Change</button>
                            <button type="reset" class="btn btn-success">Reset</button>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- END BODY CONTENT -->
        <!-- HORIZONE -->
        <?php
        include('gui/footer.php');
        ?>
    </body>
</html>
<?php ob_flush() ?>