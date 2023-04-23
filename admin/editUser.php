<?php
    // Connect to the database
    include "../rm/backend/dbconnection.php";

    // Check if ID and role parameters are set
    if (isset($_GET['id']) && isset($_GET['role'])) {
        $id = $_GET['id'];
        $role = $_GET['role'];

        // Fetch user data based on role
        if ($role == 'fa') {
            $query = "SELECT * FROM fa WHERE FaID = '$id'";
        } else if ($role == 'rm') {
            $query = "SELECT * FROM rm WHERE RmID = '$id'";
        }

        $result = mysqli_query($databaseConnection, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Display form to edit user details
            echo '<h1>Edit User</h1>';
            echo '<form action="updateUser.php" method="post">';
            echo '<input type="hidden" name="id" value="' . $id . '">';
            echo '<input type="hidden" name="role" value="' . $role . '">';
            echo 'First Name: <input type="text" name="firstname" value="' . $row['Firstname'] . '" required><br>';
            echo 'Last Name: <input type="text" name="lastname" value="' . $row['Lastname'] . '" required><br>';
            echo 'Email: <input type="text" name="email" value="' . $row['Email'] . '" required><br>';
            echo 'Phone Number: <input type="text" name="phone" value="' . $row['PhoneNo'] . '" required><br>';
            echo 'Password: <input type="password" name="password" value="' . $row['Password'] . '" required><br>';
            echo '<input type="submit" name="submit" value="Save">';
            echo '</form>';
        } else {
            echo 'User not found';
        }
    } else {
        echo 'Invalid request';
    }

    // Close database connection
    mysqli_close($databaseConnection);
?>
