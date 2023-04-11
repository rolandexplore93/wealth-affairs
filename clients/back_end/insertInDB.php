    <?php
        
        
        // function to insert data in the database 
        function insertInDB($db) {
            
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

           // Check if email already exists in the database
            $sql = "SELECT * FROM client WHERE Email = :email";
            $query = $db->prepare($sql);
            $query->execute(array(':email' => $email));
            if ($query->rowCount() > 0) {
                // Email already exists, show error message or redirect to the signup page with an error message
                echo "<script>alert('This email address is already taken. Please choose another one'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth-affairs/clients/Login/index.html'; }, 1000);
                    </script>";
                return;
            }
            
            // create a query
           $sqlQuery = "INSERT INTO client (Firstname, Lastname, Email, Password) VALUES (:fname, :lname, :email, :password)";
            
            //prepare the query
            $query = $db->prepare($sqlQuery);
            
            //execute the query
            $query->execute(array(
                                  ':fname' => $fname,
                                  ':lname' => $lname,
                                  ':email' => $email,
                                  ':password' => $encrypt_pass
                                  ));
            
            
            // check if the registration was successfully 
            if ($query) {
                echo "<script>alert('Congratulations! Your account has been created. You are now being redirected to login'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth-affairs/clients/Login/login.php'; }, 1000);
                    </script>";
                exit;
            }
            else {
                // print the error generated
                echo "<script>alert('Unable to create your account. Please try again'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth-affairs/clients/Login/index.html'; }, 1000);
                    </script>";
            }
            
        }
        
        
        /* Main body */
        //connect to the DB
        $dsn = 'mysql:host=localhost;dbname=wealthaffairsdb';
        $user = 'root';
        $password = '';
        
        try {
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //           echo 'Connection failed: ' . $e->getMessage();
            die('Sorry, database problem');
        }
        
        insertInDB($db);
        
    
    ?>


