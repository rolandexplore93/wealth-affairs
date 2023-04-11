<?php

// Check if the user is logged in
if (!isset($_SESSION['Client_ID'])) {
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
            $dsn = 'mysql:host=localhost;dbname=wealthaffairsdb';
            $user = 'root';
            $dbpassword = '';

            try {
                $db = new PDO($dsn, $user, $dbpassword);
            } catch (PDOException $e) {
                die('Sorry, database problem');
            }

            // Look up the user-provided credentials
            $query = 'SELECT  Email, Password FROM client WHERE Email = :email';
            $params = array('email' => $email);

            $result = $db->prepare($query);
            $result->execute($params);

            $found = false;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($oldpassword, $row['Password'])) {
                    // Update the password
                    $query = 'UPDATE client SET Password = :password WHERE Email = :email';
                    $params = array(
                        'password' => password_hash($newpassword, PASSWORD_DEFAULT),
                        'email' => $row['Email']
                    );

                    $result = $db->prepare($query);
                    $result->execute($params);

                    // Redirect to the login page
                    header("Location: login.php");
                    exit();
                }
            }

            // If the $result contains 0 lines in the email and password and are not valid. Ask the user to re-enter them
            if (!$found) {
                echo "<script>";
                echo "alert('Invalid email or old password');";
                echo "window.location.href='http://localhost/wealth-affairs/clients/front_end/forgot_password.php';";
                echo "</script>";
                exit();
            }
        }
    } else {
        // The user is not logged in and a password change form was not submitted, so show the password change form

 
    }
    exit();
} 
    

?>
