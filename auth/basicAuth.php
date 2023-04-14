<?php
    if (!isset($_SERVER['PHP_AUTH_USER']) &&
        !isset($_SERVER['PHP_AUTH_PW']) ) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="ARU"');
        echo 'User hits cancel button';
        exit;
    } else {
        
        // get the email
        $email = htmlentities(trim($_SERVER['PHP_AUTH_USER']));
        // get the password
        $password = htmlentities(trim($_SERVER['PHP_AUTH_PW']));

        if(!$email || !$password) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Dashboard"');
            exit("You need to fill in both the email and password."); 
        }
        
        // Connect to the database
        include "../rm/backend/dbconnection.php";

        // Look up the user-provided credentials
        $rm = mysqli_query($databaseConnection, "SELECT RmID, Email, Password FROM rm WHERE Email = '$email' ");

        // get all records with email = $email and check which one matches the password
        $found = false;
        while ($row = mysqli_fetch_assoc($rm)) {

            // if (password_verify($password, $row['Password'])) {
            if ($password == $row['Password']) {
                $found = true;
                $current_RmID = $row['RmID'];
                $current_email = $row['Email'];
                break;
            }
        }

        // mysqli_stmt_close(); // Close the prepared statement
        mysqli_close($databaseConnection); // Close the database connection

        if ($found) {
            // Successful login logic
        } else {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Dashboard"');
            exit("You need a valid username and password."); 
        }
        
        
    }
?>
