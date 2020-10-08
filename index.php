<?php
    include('control/configall.php');
    include('gui/resource.php');
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('m/d/Y h:i:s a', time());
?>
<head>
    <script>
        function ana2(longtime) {
            var hours = Math.floor(longtime / (60 * 60));
            var minutes = Math.floor(longtime / 60) % 60;
            var seconds = (longtime % 60);
            var timeStr = hours + ":" + ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);
            if (hours >= 24)
                timeStr = Math.floor(hours / 24) + " days";            
            return "<font color='white'>" + timeStr + "</font>";
        }
    </script>
</head>
<body class="fonts1">
    <div id="body-wrapper">
        <?php include('gui/header.php') ?>
        <script>
        var d = document.getElementById("navhome");
        d.className += "active current";
        </script>
        <div id="content">
            <div id="content-body" class="section">
                <div class="container">
                    <div id="content-wrapper" class="container-wrapper">
                        <div id="el-190943" class="element box-element" style="background-image:url(img/upcoming.png)"></div>
                        <a href="guide">
                            <div id="el-17604" class="element button-element">
                                    <div class="button">
                                            <div>GUIDE</div>
                                    </div>
                            </div>
                        </a>
                        <a href="practices">
                            <div id="el-191108" class="element button-element">
                                    <div class="button">
                                            <div>PRACTICE</div>
                                    </div>
                            </div>
                        </a>
                        <a href="feedback">
                            <div id="el-191109" class="element button-element">
                                    <div class="button">
                                            <div>FEEDBACK</div>
                                    </div>
                            </div>
                        </a>
                        <div id="el-190945" class="element text-element  ">
                            <div class="text-content">
                                <p class="paragraph2"><span class="fgColor fg-A4">Upcoming contest</span></p>
                            </div>
                        </div>
                        <?php $_upcoming_list = getAllContest2();
                            foreach ($_upcoming_list as $_coming) {
                                $_deltime = (strtotime($_coming['beginTime'])) - strtotime($date);
                                    if ($_deltime >= 0)
                                    {
                                            $_upcoming = $_coming;
                                            break;
                                    }
                                }
                        ?>

                        <div id="el-190949" class="element text-element  ">
                            <div class="text-content">
                                <h4 class="title4" style="text-align: center;">
                                <strong>
                                <span class="fontFamily" style="font-family: &quot;coming soon&quot;; line-height: 1;">
                                    <span class="fgColor fg-A4">
                                        <?php
                                        if (isset($_upcoming)) {
                                            
                                        ?>
                                        <a href="blog/<?php echo $_upcoming['conID'] ?>"><?php echo $_upcoming['conName']; ?></a>
                                        <?php }  
                                        
                                        else echo "No upcoming contest";?></span>
                                </span>
                                </strong>
                                </h4>
                            </div>
                        </div>
                        <div id="el-190953" class="element text-element  ">
                            <div class="text-content">
                                <p class="paragraph2">
                                    <span class="fgColor fg-A4">Before start</span>
                                </p>
                            </div>
                        </div>
                        <div id="el-190954" class="element text-element">
                            <div class="text-content">
                                <p>
                                    <span class="fgColor fg-C0">
                                        <?php if (isset($_upcoming)) { ?>
                                        <script>
                                        <?php
                                            $date = date('m/d/Y h:i:s a', time());
                                            $_diff = strtotime($_upcoming['beginTime']) - strtotime($date);
                                            ?>
                                            cnt<?php echo $_upcoming['conID']?> = parseInt("<?php echo $_diff ?>");
                                            var myVar<?php echo $_upcoming['conID']?> = setInterval(myTimer<?php echo $_upcoming['conID']?> , 1000);
                                            function myTimer<?php echo $_upcoming['conID']?>() {
                                                cnt<?php echo $_upcoming['conID']?>--;
                                                document.getElementById("el-190954").innerHTML = ana2(cnt<?php echo $_upcoming['conID']?>);
                                                
                                                if (cnt<?php echo $_upcoming['conID']?> == 0) {
                                                    clearTimeout(myVar<?php echo $_upcoming['conID']?>);
                                                }
                                            }
                                        </script>
                                        <?php } ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('gui/footer.php'); ?>
        
    </body>
</html>