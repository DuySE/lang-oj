<?php
    session_start();
    include('../dbcon.php');
    include('resource.php');
    ob_start();
?>
<body class="fonts1">
    <div id="body-wrapper">
        <?php include('header.php') ?>
        <div id="" class="section" style="background-color: #f0f0f0">
            <div id="" class = "container" style="text-align:center">
                <!-- BEGIN BODY CONTENT -->
                <h2>
                    We could not find the page you were looking for, so we found <br> something to make you laugh to make up for it.
                </h2>
                <div>
                    <img src="img/404.png">
                </div>
                <!-- END BODY CONTENT -->
            </div>
        </div>
    </div>
    <!-- END BODY CONTENT -->
    <!-- HORIZONE -->
    <?php
        include('footer.php');
    ?>
</body>
</html>
<?php ob_flush() ?>