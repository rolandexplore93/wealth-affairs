<?php
    // Connect to the database
    include "../rm/backend/dbconnection.php";

    // Check if form is submitted
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $role = $_POST['role'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update user details based on role
        if ($role == 'fa') {
            $query = "UPDATE fa SET Firstname = '$firstname', Lastname = '$lastname', Email = '$email', PhoneNo = '$phone', Password = '$hashedPassword' WHERE FaID = '$id'";
        } else if ($role == 'rm') {
            $query = "UPDATE rm SET Firstname = '$firstname', Lastname = '$lastname', Email = '$email', PhoneNo = '$phone', Password = '$hashedPassword' WHERE RmID = '$id'";
        }

        if (mysqli_query($databaseConnection, $query)) {
            echo 'User details updated successfully... Redirecting in 2 seconds';
            // Wait for 2 seconds
            header("refresh:2; url=allUsers.php");
        } else {
            echo 'Error updating user details: ' . mysqli_error($databaseConnection);
            // Wait for 2 seconds
            header("refresh:2; url=allUsers.php");
        }

        // Close database connection
        mysqli_close($databaseConnection);
    } else {
        echo 'Invalid request';
    }
?>
