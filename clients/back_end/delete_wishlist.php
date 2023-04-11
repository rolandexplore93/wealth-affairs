<?php
session_start();

// Check if the product ID was submitted
if (!isset($_POST['ProductID'])) {
    // Product ID was not submitted, redirect to homepage
    header('Location: http://localhost/wealth-affairs/clients/Dashboard.php');
    exit();
}

// Get the current client ID
$current_clientid = $_SESSION['Client_ID'];

// Get the product ID from the POST parameter
$product_id = $_POST['ProductID'];

// Connect to database
$db = mysqli_connect('localhost', 'root', '', 'wealthaffairsdb');

// Prepare and execute the query to delete the product from the wishlist
$sql = "DELETE FROM wishlist WHERE ClientID = ? AND ProductID = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "ii", $current_clientid, $product_id);
mysqli_stmt_execute($stmt);

// Close statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($db);

exit();
?>
