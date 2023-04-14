    <?php
               
            // get the data from the front end
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_rpt = $_POST['password_rpt'];
            

            // check the values
            if( !$fname || !$lname || !$email || !$password ||!$password_rpt) {
                echo 'One or more fields are empty.';
                return;
            }
            else {
                // escape special characters in a string for use in the SQL statement
                // ENCRYPT THE PASSWORD
                $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);

           }

           //connect to the DB
        require_once 'dbconnect.php';

        $db = $conn;
           // Check if email already exists in the database
           $sql = "SELECT * FROM clients WHERE Email = ?";
            $query = $db->prepare($sql);
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                // Email already exists, show error message or redirect to the signup page with an error message
                echo "<script>alert('This email address is already taken. Please choose another one'); 
                    setTimeout(function() 
                        { window.location.href = 'http://localhost/wealth_affairs/clients/front_end/signup.html'; }, 1000);
                        </script>";
                return;
            }

            // create a query
            $sqlQuery = "INSERT INTO clients (Firstname, Lastname, Email, Password) VALUES (?, ?, ?, ?)";

            //prepare the query
            $query = $db->prepare($sqlQuery);
            
            //execute the query
            $query->execute(array(
                $fname,
                $lname,
                $email,
                $encrypt_pass
            ));
            
            // check if the registration was successfully 
            if ($query) {
                echo "<script>alert('Congratulations! Your account has been created. You are now being redirected to login'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth_affairs/clients/front_end/login.php'; }, 1000);
                    </script>";
                exit;
            }
            else {
                // print the error generated
                echo "<script>alert('Unable to create your account. Please try again'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth_affairs/clients/front_end/signup.html'; }, 1000);
                    </script>";
            }
    
    ?>


