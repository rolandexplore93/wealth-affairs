<?php 
    // Connect to the database
    include "../rm/backend/dbconnection.php";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form input data into variables
        $firstName = $_POST["FirstName"];
        $lastName = $_POST["LastName"];
        $email = $_POST["Email"];
        $phoneNo = $_POST["PhoneNo"];
        $password = $_POST["Password"];
        $role = $_POST["Role"];
        $AdminID = '1';

        // echo $firstName;
        // echo $lastName;
        // echo $email;
        // echo $phoneNo;
        // echo $password;
        // echo $role;
        // echo $AdminID;
    
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo $hashedPassword;
    
        // Check the selected role and perform corresponding action
        if ($role == "FA") {
            // Insert data into "fa" table in the database
            $query = mysqli_query($databaseConnection, "INSERT INTO fa (Firstname, Lastname, Email, PhoneNo, Password, Role, AdminID) VALUES ('$firstName', '$lastName', '$email', '$phoneNo', '$hashedPassword', '$role', '$AdminID')");
            echo "FA has been created...";
            // Close database connection
            mysqli_close($databaseConnection);
        } elseif ($role == "RM") {
            // Insert data into "rm" table in the database
            $query = mysqli_query($databaseConnection, "INSERT INTO rm (Firstname, Lastname, Email, PhoneNo, Password, Role, AdminID) VALUES ('$firstName', '$lastName', '$email', '$phoneNo', '$hashedPassword', '$role', '$AdminID')");
            echo "RM has been created...";
            // Close database connection
            mysqli_close($databaseConnection);
        }
    }
    
?>