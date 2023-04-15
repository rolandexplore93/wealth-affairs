<?php
session_start();

// Check if the idea ID was submitted
if (!isset($_POST['ApprovedID'])) {
    // Idea ID was not submitted, redirect to homepage
    header('Location: http://localhost/wealth_affairs/clients/front_end/dashboard.php');
    exit();
}

// Get the current client ID
$current_clientid = $_SESSION['ClientID'];

// Get the idea ID from the POST parameter
$approved_id = $_POST['ApprovedID'];

// Connect to database
include "dbconnect.php";
$db = $conn;

// Prepare and execute the query to delete the idea from the wishlist
$sql = "DELETE FROM wishlist WHERE ClientID = ? AND ApprovedID = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "ii", $current_clientid, $approved_id);
mysqli_stmt_execute($stmt);

// Close statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($db);

exit();
?>
