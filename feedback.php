<?php
    include('control/configall.php');
    include('gui/resource.php');
    if (!isset($_SESSION['tmp_uname'])) $_need_login = 1;
    include('control/permission.php');
?>
<style>
    iframe {
        overflow: hidden;
    }
</style>
<body class="fonts1">    
    <?php include('gui/header.php') ?>
    <!-- BEGIN -->
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScOhc-fQ3uCHFf2ctS5Evh0bEqnbYZx8mBUJV55dKcw-zBzMA/viewform?embedded=true" width="100%" height="170%" frameborder="0" marginheight="0" marginwidth="0"></iframe>    
        <!-- HORIZONTLE -->
    <?php
        include('gui/footer.php');
    ?>    
</body>