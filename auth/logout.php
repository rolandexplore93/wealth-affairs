<?php
    //start the session
    session_start();
    
    unset($_SESSION['RmID']);
    unset($_SESSION['FaID']);
    unset($_SESSION['email']);
    
    header('Location: http://localhost/wealth_affairs/auth/login.html');
    exit();
    
?>