<?php
   // Start the session
   session_start();
   
   // Check if the user is logged in
   if (!isset($_SESSION['ClientID'])) {
       // Check if a login form was submitted with an email and password
       if (isset($_POST['email']) && isset($_POST['password'])) {
           // Get the email and password
           $email = htmlentities(trim($_POST['email']));
           $password = htmlentities(trim($_POST['password']));
   
           if (!$email || !$password) {
            exit("You need to fill in both the email and password.");
           } else
                
               // Connect to the database
                require_once 'dbconnect.php';
                $db = $conn;

                // Look up the user-provided credentials
                $query = "SELECT c.ClientID, c.Firstname, c.Email, c.Password, 
                rm.Firstname AS rm_fname, rm.Lastname AS rm_lname, rm.Email AS rm_email
                FROM clients c
                INNER JOIN rm ON c.RmID = rm.RmID
                WHERE c.Email = ?";
                $stmt = mysqli_prepare($db, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $found = false;
                while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['Password'])) {
                // Set the session variables with the Client_ID, email, Firstname, and RM Name
                $_SESSION['ClientID'] = $row['ClientID'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['fname'] = $row['Firstname'];
                $_SESSION['rm_fname'] = $row['rm_fname'];
                $_SESSION['rm_lname'] = $row['rm_lname'];
                $_SESSION['rm_email'] = $row['rm_email'];

                // Redirect to the next page
                header("Location: http://localhost/wealth-affairs/clients/front_end/dashboard.php");
                $found = true;
                break;
                }
                }
       
                // If the $result contains 0 lines in the email and password and are not valid. Ask the user to re-enter them
                if (!$found) {
                    echo "<script>";
                    echo "alert('Invalid email or password');";
                    echo "window.location.href='http://localhost/wealth-affairs/clients/front_end/login.php';";
                    echo "</script>";
                    exit();
                }
                
        
            } else {
                // The user is not logged in and a login form was not submitted, so show the login form
    
            }
        } else {
            // The user is already logged in, so redirect to the next page
            header("Location: http://localhost/wealth-affairs/clients/front_end/dashboard.php");
        }
    
   
?>