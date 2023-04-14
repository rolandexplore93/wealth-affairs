<?php

// Check if the user is logged in
if (!isset($_SESSION['ClientID'])) {
    // Check if a password change form was submitted with an email, old password, new password and confirm password
    if (isset($_POST['email']) && isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
        // Get the email, old password, new password and confirm password
        $email = htmlentities(trim($_POST['email']));
        $oldpassword = htmlentities(trim($_POST['oldpassword']));
        $newpassword = htmlentities(trim($_POST['newpassword']));
        $confirmpassword = htmlentities(trim($_POST['confirmpassword']));

        // Validate the inputs
        if (!$email || !$oldpassword || !$newpassword || !$confirmpassword) {
            exit("You need to fill in all the fields.");
        } elseif ($newpassword !== $confirmpassword) {
            exit("New password and Confirm password do not match");
        } else {

            // Connect to the database
            include "dbconnect.php";

            // Look up the user-provided credentials
            $stmt = $conn->prepare('SELECT Email, Password FROM clients WHERE Email = ?');
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $found = false;
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                if (password_verify($oldpassword, $row['Password'])) {
                    // Update the password
                    $stmt = $conn->prepare('UPDATE clients SET Password = ? WHERE Email = ?');
                    $newpassword_hash = password_hash($newpassword, PASSWORD_DEFAULT);
                    $stmt->bind_param('ss', $newpassword_hash, $row['Email']);
                    $stmt->execute();
                    $found = true;
                    break;
                }
            }
            $stmt->close();
            $conn->close();

            // If the $result contains 0 lines in the email and password and are not valid. Ask the user to re-enter them
            if (!$found) {
                echo "<script>";
                echo "alert('Invalid email or old password');";
                echo "window.location.href='http://localhost/wealth_affairs/clients/front_end/forgot_password.php';";
                echo "</script>";
                exit();
            }

            // Redirect to the login page
            header("Location: ../front_end/login.php");
            exit();
        }
    } else {
        // The user is not logged in and a password change form was not submitted, so show the password change form

 
    }
    exit();
} 