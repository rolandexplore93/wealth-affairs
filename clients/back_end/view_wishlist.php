<?php

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['Client_ID'])) {
    // User is already logged in, no need for authentication
    $current_clientid = $_SESSION['Client_ID'];
} else {
    // Require authentication
    require_once 'basicAuth_v3_PDO.php';
}

// Establish database connection
$db = mysqli_connect('localhost', 'root', '', 'wealthaffairsdb');

// Define SQL query to get the products in the user's wishlist
$sql = "SELECT product.*
        FROM product
        INNER JOIN wishlist ON wishlist.ProductID = product.ProductID
        WHERE wishlist.ClientID = $current_clientid";

// Execute SQL query
$result = mysqli_query($db, $sql);

// Create an array to hold the products
$products = array();

// Loop through the result set and add each product to the array
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Output the products as JSON data
echo json_encode($products);

// Close database connection
mysqli_close($db);

?>
