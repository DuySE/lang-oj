<?php
    ob_start();
    include('control/configall.php');
    // $_page = $_SESSION['page'];

    if (isset($_SESSION['tmp_uname'])) {
       header('Location: index.php');
       exit(0);
    }
    
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['pass'] = $_POST['pass'];

    $t = 10;

    if (!isset($_SESSION['counter']))
        $_SESSION['counter'] = 0;

    if (isset($_SESSION['user']) && isset($_SESSION['pass']))
    {
        $_user = $_SESSION['user'];
        $_pass = $_SESSION['pass'];
    }
    // validation section
    if (checkLogin($_user, $_pass)) {
        $_SESSION['tmp_uname'] = $_user;            
        if (isset($_SESSION['tmp_uname']) && checkAdmin($_SESSION['tmp_uname']))
            $_SESSION['admin'] = $_user;
        $_SESSION['sys_msg'] = 'Welcome, ' . $_SESSION['tmp_uname'];
        header("Location: ");
    } else {
        $_SESSION['sys_msg'] = 'Incorrect username or password.';
        $_SESSION['counter']++;
        if ($_SESSION['counter'] == 5)
            setcookie('lock', 'abc', time() + $t, "/");        
        header("Location: ");
    }
    ob_flush();
?>