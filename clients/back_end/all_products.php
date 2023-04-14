<?php

// Start the session if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION['ClientID'])) {
    // User is already logged in, no need for authentication
    $current_clientid = $_SESSION['ClientID'];
} else {
    // Require authentication
    require_once 'basicAuth_v3_PDO.php';
}

// Establish database connection
require_once 'dbconnect.php';
$db = $conn;

// Define SQL query
$sql = "SELECT *
        FROM approvedideas 
        ORDER BY RAND()";

// Execute SQL query
$result = mysqli_query($db, $sql);

// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    // Start table
    echo '<table class="my-table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Instrument Name</th>';
    echo '<th>Instrument Description</th>';
    echo '<th>Industry</th>';
    echo '<th>Risk Level</th>';
    echo '<th>Country</th>';
    echo '<th>Details</th>';
    echo '<th>Add to Wishlist</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    // Loop through results and output each product in a row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['InstrumentName'] . '</td>';
        echo '<td>' . $row['InstrumentDn'] . '</td>';
        echo '<td>' . $row['Industry'] . '</td>';
        echo '<td>' . $row['RiskLevel'] . '</td>';
        echo '<td>' . $row['Country'] . '</td>';
        echo '<td>';
        
        // Check if there is data in the "details" section
        if (!empty($row['Denomination']) || !empty($row['ProductType']) || !empty($row['StockExchange'])) {
            echo '<ul>';
            echo '<li><strong>Denomination:</strong> ' . $row['Denomination'] . '</li>';
            echo '<li><strong>Product Type:</strong> ' . $row['ProductType'] . '</li>';
            echo '<li><strong>Stock Exchange:</strong> ' . $row['StockExchange'] . '</li>';
            echo '</ul>';
        }
        
        echo '</td>';
        echo '<td>';
        echo '<button class="add-to-wishlist-btn" onclick="addToWishlist(' . $row['ApprovedID'] . ')">Add to Wishlist</button>';
        echo '</td>';
        echo '</tr>';
    }
    
    // End table
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Please complete your profile to get tailored recommendations.</p>';
}

// Close database connection
mysqli_close($db);
?>

<script>
    approvedId = 'ApprovedID'
function addToWishlist(approvedId) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      alert('Product added to wishlist successfully!');
    }
  };
  xhr.open('POST', 'http://localhost/wealth_affairs/clients/back_end/add_to_wishlist.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('ApprovedID=' + approvedId);
}
</script>

<style>
    .my-table {
        border-collapse: collapse;
        border: 1px solid black;
    }
    .my-table th, .my-table td {
        border: 1px solid black;
        padding: 5px;
    }
</style>
