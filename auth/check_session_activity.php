<?php 
    // check_session_activity.php
    session_start();
    if (isset($_SESSION['last_activity'])) {
        echo json_encode(array('last_activity' => $_SESSION['last_activity']));
    } else {
        echo json_encode(array('last_activity' => 0));
    }

?>