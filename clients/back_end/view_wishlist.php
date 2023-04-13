<?php

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['ClientID'])) {
    // User is already logged in, no need for authentication
    $current_clientid = $_SESSION['ClientID'];
} else {
    // Require authentication
    require_once 'basicAuth_v3_PDO.php';
}

// Establish database connection
include "dbconnect.php";
$db = $conn;
// Define SQL query to get the products in the user's wishlist
$sql = "SELECT approvedideas. *
        FROM   approvedideas
        INNER JOIN wishlist ON wishlist.ApprovedID = approvedideas.ApprovedID
        WHERE wishlist.ClientID = $current_clientid";

// Execute SQL query
$result = mysqli_query($db, $sql);

// Create an array to hold the products
$approvedideas = array();

// Loop through the result set and add each product to the array
while ($row = mysqli_fetch_assoc($result)) {
    $approvedideas[] = $row;
}

// Output the products as JSON data
echo json_encode($approvedideas);

// Close database connection
mysqli_close($db);

?>
