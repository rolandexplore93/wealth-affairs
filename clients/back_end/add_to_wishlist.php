<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['Client_ID'])) {
    // User is not logged in, redirect to login page
    header('Location: http://localhost/wealth-affairs/clients/front_end/login.php');
    exit();
}

// Check if the product ID was submitted
if (!isset($_POST['ProductID'])) {
    // Product ID was not submitted, redirect to homepage
    header('Location: http://localhost/wealth-affairs/clients/front_end/dashboard.php');
    exit();
}

// Get the current client ID
$current_clientid = $_SESSION['Client_ID'];

// Get the product ID from the submitted form
$product_id = $_POST['ProductID'];

// Connect to database
$db = mysqli_connect('localhost', 'root', '', 'wealthaffairsdb');

// Check if the product exists in the database
$sql = "SELECT * FROM product WHERE ProductID = $product_id";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) == 0) {
    // Product does not exist, redirect to homepage
    header('Location: http://localhost/wealth-affairs/clients/front_end/dashboard.php');
    exit();
}


// Check if the product is already in the wishlist
$sql = "SELECT * FROM wishlist WHERE ClientID = $current_clientid AND ProductID = $product_id";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // Product already exists in the wishlist, delete it
    $sql = "DELETE FROM wishlist WHERE ClientID = $current_clientid AND ProductID = $product_id";
    mysqli_query($db, $sql);
}

// Add the product to the wishlist
$sql = "INSERT INTO wishlist (ClientID, ProductID) VALUES ($current_clientid, $product_id)";
mysqli_query($db, $sql);


// Close database connection
mysqli_close($db);

// Redirect to the wishlist page
header('Location: http://localhost/wealth-affairs/clients/back_end/add_to_wishlist.php');
exit();
?>
