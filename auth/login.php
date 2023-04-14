<?php 
// Start the session
session_start();

// If user is already logged in
if (!isset($_SESSION['RmID']) || !isset($_SESSION['FaID'])){
    // Confirm if user submit both email and and password
    if (isset($_POST['email']) && isset($_POST['password'])){
        include "../rm/backend/dbconnection.php";
        // Store each input value in a variable
        // Sanitize the email and password parameters to prevent SQL injection
        $email = mysqli_real_escape_string($databaseConnection, trim($_POST['email']));
        $password = mysqli_real_escape_string($databaseConnection, trim($_POST['password']));

        // $email = htmlentities(trim($_POST['email']));
        // $password = htmlentities(trim($_POST['password']));

        if (!$email || !$password){
            // echo json_encode(["message" => "You need to fill in both the email and password."]);
            // exit();
            exit("You need to fill in both the email and password.");
        } else {
            // Connect to the database
            // include "../rm/backend/dbconnection.php";

            $query = "SELECT FaID, NULL AS RmID, Firstname, Lastname, Email, Password, PhoneNo, Role FROM fa WHERE Email = '$email' AND role = 'FA' 
            UNION ALL
            SELECT NULL AS FaID, RmID, Firstname, Lastname, Email, Password, PhoneNo, Role FROM rm WHERE Email = '$email' AND role='RM'";

            $result = mysqli_query($databaseConnection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if ($password == $row['Password']) {
                    if ($row['Role'] == 'FA') {
                        $_SESSION['FaID'] = $row['FaID'];
                        $_SESSION['Firstname'] = $row['Firstname'];
                        $_SESSION['Lastname'] = $row['Lastname'];
                        $_SESSION['Email'] = $row['Email'];
                        $_SESSION['PhoneNo'] = $row['PhoneNo'];
                        $_SESSION['Role'] = $row['Role'];
                        $_SESSION['last_activity'] = time();

                        // echo json_encode([
                        //     "message" => "Login successful. Redirecting to FA dashboard...",
                        //     "FaID" => $_SESSION['FaID'],
                        //     "Firstname" => $_SESSION['Firstname'],
                        //     "Lastname" => $_SESSION['Lastname'],
                        //     "Email" => $_SESSION['Email'],
                        //     "PhoneNo" => $_SESSION['PhoneNo'],
                        //     "Role" => $_SESSION['Role'],
                        //     "last_activity" => $_SESSION['last_activity']
                        // ]);

                        // Redirect to fadashboard.php
                        header('Location: http://localhost/wealth_affairs/fa/index.php');
                        exit();
                    } elseif ($row['Role'] == 'RM') {
                        $_SESSION['Firstname'] = $row['Firstname'];
                        $_SESSION['RmID'] = $row['RmID'];
                        $_SESSION['Lastname'] = $row['Lastname'];
                        $_SESSION['Email'] = $row['Email'];
                        $_SESSION['PhoneNo'] = $row['PhoneNo'];
                        $_SESSION['Role'] = $row['Role'];
                        $_SESSION['last_activity'] = time();
                        // Redirect to rmdashboard.php
                        header('Location: http://localhost/wealth_affairs/rm/index.php');
                        exit();
                    }
                } else {
                    // Redirect to acclogin.php for invalid credentials
                    echo "Incorrect login details";
                    echo "<script>
                        setTimeout(function() {
                            window.location.href = 'http://localhost/wealth_affairs/auth/login.html';
                        }, 3000);
                        </script>";
                        // header('Location: http://localhost/wealth_affairs/auth/login.html');
                    exit();
                }
            } else {
                // Redirect to acclogin.php for invalid credentials
                echo "Incorrect email or password";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'http://localhost/wealth_affairs/auth/login.html';
                    }, 3000);
                    </script>";
                    // header('Location: http://localhost/wealth_affairs/auth/login.html');
                exit();
            }


        }

        
        
    } 
    
    // else {
    //     // The user is not logged in and a login form was not submitted, so show the login form
    //     echo "Enter your login details";
    //     echo "<script>
    //         setTimeout(function() {
    //             window.location.href = 'http://localhost/wealth_affairs/auth/login.html';
    //         }, 2000);
    //         </script>";
    //         // header('Location: http://localhost/wealth_affairs/auth/login.html');
    //     exit();
    // }
    
    
} else {
    // The user is already logged in, so redirect to the next page
    if ($password == $row['Password']) {
        if ($row['Role'] == 'FA') {
            $_SESSION['FaID'] = $row['FaID'];
            $_SESSION['Firstname'] = $row['Firstname'];
            $_SESSION['Lastname'] = $row['Lastname'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['PhoneNo'] = $row['PhoneNo'];
            $_SESSION['Role'] = $row['Role'];

            // Redirect to fadashboard.php
            header('Location: http://localhost/wealth_affairs/fa/index.php');
            exit();
        } elseif ($row['Role'] == 'RM') {
            $_SESSION['RmID'] = $row['RmID'];
            $_SESSION['Firstname'] = $row['Firstname'];
            $_SESSION['Lastname'] = $row['Lastname'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['PhoneNo'] = $row['PhoneNo'];
            $_SESSION['Role'] = $row['Role'];
            // Redirect to rmdashboard.php
            header('Location: http://localhost/wealth_affairs/rm/index.php');
            exit();
        }
    }
}
?>