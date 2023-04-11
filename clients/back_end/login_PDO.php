<?php
   // Start the session
   session_start();
   
   // Check if the user is logged in
   if (!isset($_SESSION['Client_ID'])) {
       // Check if a login form was submitted with an email and password
       if (isset($_POST['email']) && isset($_POST['password'])) {
           // Get the email and password
           $email = htmlentities(trim($_POST['email']));
           $password = htmlentities(trim($_POST['password']));
   
           if (!$email || !$password) {
            exit("You need to fill in both the email and password.");
           } else
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
                $query = 'SELECT Client_ID, Firstname, Email, Password FROM client WHERE Email = :email';
                $params = array('email' => $email);
        
                $result = $db->prepare($query);
                $result->execute($params);
        
                $found = false;
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    if (password_verify($password, $row['Password'])) {
                        // Set the session variables with the Client_ID, email, and Firstname
                        $_SESSION['Client_ID'] = $row['Client_ID'];
                        $_SESSION['email'] = $row['Email'];
                        $_SESSION['fname'] = $row['Firstname'];
        
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