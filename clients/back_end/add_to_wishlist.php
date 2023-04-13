<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['ClientID'])) {
    // User is not logged in, redirect to login page
    header('Location: http://localhost/wealth-affairs/clients/front_end/login.php');
    exit();
}

// Check if the product ID was submitted
if (!isset($_POST['ApprovedID'])) {
    // Product ID was not submitted, redirect to homepage
    header('Location: http://localhost/wealth-affairs/clients/front_end/dashboard.php');
    exit();
}

// Get the current client ID
$current_clientid = $_SESSION['ClientID'];

// Get the product ID from the submitted form
$approved_id = $_POST['ApprovedID'];

// Establish database connection
require_once 'dbconnect.php';
$db = $conn;

// Check if the product exists in the database
$sql = "SELECT * FROM approvedideas WHERE ApprovedID = $approved_id";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) == 0) {
    // Product does not exist, redirect to homepage
    header('Location: http://localhost/wealth-affairs/clients/front_end/dashboard.php');
    exit();
}


// Check if the product is already in the wishlist
$sql = "SELECT * FROM wishlist WHERE ClientID = $current_clientid AND ApprovedID = $approved_id";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // Product already exists in the wishlist, delete it
    $sql = "DELETE FROM wishlist WHERE ClientID = $current_clientid AND ApprovedID = $approved_id";
    mysqli_query($db, $sql);
}

// Add the product to the wishlist
$sql = "INSERT INTO wishlist (ClientID, ApprovedID) VALUES ($current_clientid, $approved_id)";
mysqli_query($db, $sql);


// Close database connection
mysqli_close($db);

// Redirect to the wishlist page
header('Location: http://localhost/wealth-affairs/clients/back_end/add_to_wishlist.php');
exit();
?>
