<?php 
    session_start();

    // if (!isset($_SESSION['Email'])) {
    //     header('Location: http://localhost/wealth_affairs/auth/login.html');
    //     echo json_encode(['loggedIn' => false, 'NotAuth' => 'Not Authenticated']);
    //     exit();
    // }
    
    // Check if user is logged in
    if (isset($_SESSION['Email'])) {
        // User is logged in as FA, return user details and logged-in status
        if ($_SESSION['Role'] == 'FA'){
            echo json_encode([
                'loggedIn' => true, 
                'Email' => $_SESSION['Email'], 
                'Role' => $_SESSION['Role'],
                'FaID' => $_SESSION['FaID'],
                'Firstname' => $_SESSION['Firstname'],
                'Lastname' => $_SESSION['Lastname'],
                'PhoneNo' => $_SESSION['PhoneNo'],
                'last_activity' => $_SESSION['last_activity']
            ]);
        } else if ($_SESSION['Role'] == 'RM'){
            // User is logged in as RM, return user details and logged-in status
            echo json_encode([
                'loggedIn' => true, 
                'Email' => $_SESSION['Email'], 
                'Role' => $_SESSION['Role'],
                'RmID' => $_SESSION['RmID'],
                'Firstname' => $_SESSION['Firstname'],
                'Lastname' => $_SESSION['Lastname'],
                'PhoneNo' => $_SESSION['PhoneNo'],
                'last_activity' => $_SESSION['last_activity']
            ]);
        } else {
            echo json_encode(['loggedIn' => 'Unknown User just log in']);

        };
    } else {
    // User is not logged in, return logged-in status as false
    echo json_encode(['loggedIn' => false]);
    }
?>

