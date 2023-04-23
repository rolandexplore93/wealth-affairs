<?php
// Connect to the database
include "../rm/backend/dbconnection.php";

$id = $_GET['id'];
$role = $_GET['role'];

if ($role == 'fa') {
    $query = "DELETE FROM fa WHERE FaID = '$id'";
} else {
    $query = "DELETE FROM rm WHERE RmID = '$id'";
}

$result = mysqli_query($databaseConnection, $query);

if ($result) {
    echo "User deleted successfully.";
    header("Location: allUsers.php"); // redirect to homepage after deleting a user
    exit();
} else {
    echo "Error deleting user: " . mysqli_error($databaseConnection);
    header("Location: allUsers.php");
    exit();
}

mysqli_close($databaseConnection);
?>
