<?php
    //start the session
    session_start();
    
    unset($_SESSION['ClientID']);
    unset($_SESSION['email']);
    
    header('Location:http://localhost/wealth_affairs/clients/front_end/login.php');
    exit();
    
?>