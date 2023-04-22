<?php
    //start the session
    session_start();
    
    // unset user id and email and logout them out of the application and redirect them to login page
    unset($_SESSION['RmID']);
    unset($_SESSION['FaID']);
    unset($_SESSION['email']);
    
    header('Location: http://localhost/wealth_affairs/auth/login.html');
    exit();
    
?>