<?php
    //start the session
    session_start();
    
    unset($_SESSION['Client_ID']);
    unset($_SESSION['email']);
    
    header('Location:http://localhost/wealth-affairs/clients/front_end/login.php');
    exit();
    
?>