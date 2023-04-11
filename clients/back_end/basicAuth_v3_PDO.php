<?php
    if (!isset($_SERVER['PHP_AUTH_USER']) &&
        !isset($_SERVER['PHP_AUTH_PW']) ) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Dashboard"');
        echo 'User hits Cancel button';
        exit;
    } else {

        // get the email
        $email = htmlentities(trim($_SERVER['PHP_AUTH_USER']));
        // get the password
        $password = htmlentities(trim($_SERVER['PHP_AUTH_PW']));
        
        if(! $email || ! $password) {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Dashboard"');
            exit("You need to fill in both the email and password.");
            
        }

        //connect to the database
        $dsn = 'mysql:host=localhost;dbname=wealthaffairsdb';
        $user = 'root';
        $passwordDB = '';
        
        try {
            $db = new PDO($dsn, $user, $passwordDB);
        } catch (PDOException $e) {
            //        echo 'Connection failed: ' . $e->getMessage();
            die('Sorry, database problem');
        }
        // Look up the user-provided credentials
        $query = 'SELECT Client_ID, Email, Password FROM client WHERE Email = :email';
        $params = array(
                        'email' => $email
                        );
 
        $result = $db->prepare($query);
        $result->execute($params);

        // get all records with email = $email and check which one matches the password
        $found = false;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {	
            if (password_verify($password, $row['Password'])) {
                $found = true;
                $current_clientid = $row['Client_ID'];
                $current_email = $row['Email'];
                break;
            }
        }

        if ($found) {
        } else {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="Dashboard"');
            exit("You need a valid username and password."); 
        }

 
    }
?>
