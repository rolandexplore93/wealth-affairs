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
    require_once 'basicAuth_c.php';
}

// Establish database connection
require_once 'dbconnect.php';

// Define SQL query
$sql = "SELECT *
        FROM approvedideas 
        INNER JOIN clients ON clients.RiskLevel = approvedideas.RiskLevel
        INNER JOIN countries ON countries.ClientID = clients.ClientID
        INNER JOIN industries ON industries.ClientID = clients.ClientID
        INNER JOIN producttypes ON producttypes.ClientID = clients.ClientID
        WHERE clients.ClientID = $current_clientid
        AND approvedideas.Industry = industries.Industry
        AND approvedideas.ProductType = producttypes.ProductType
        AND approvedideas.Country = countries.Country
        ORDER BY RAND()";

// Execute SQL query
$result = mysqli_query($conn, $sql);


// Output result set in cards
$counter = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card d-inline-block" style="width: 20%;">'; // Set the width to 20%
         // Limit to 4 cards
         if ($counter >= 5) {
            break;
        }
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['InstrumentName'] . '</h5>';
            echo '<h6 class="card-subtitle mb-2 text-muted">' . $row['IdeaDescription'] . '</h6>';
            echo '<hr>';
            echo '<div class="row">';
            echo '<div class="col-md-6">';
            echo '<p class="card-text"><strong>Industry:</strong> ' . $row['Industry'] . '</p>';
            echo '</div>';
            echo '<div class="col-md-6">';
            echo '<p class="card-text"><strong>Risk Level:</strong> ' . $row['RiskLevel'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<p class="card-text"><strong>Country:</strong> ' . $row['Country'] . '</p>';
            echo '<div class="text-center">';
            echo '<a href="#" class="btn btn-primary" onclick="toggleDetails(' . $row['ApprovedID'] . ')">View Details</a>'.'<br>';
            echo '<a href="#" class="btn btn-secondary" onclick="addToWishlist(' . $row['ApprovedID'] . ')">Add to Wishlist</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        $counter++;
        
        // Check if there is data in the "details" section
        if (!empty($row['Denomination']) || !empty($row['ProductType']) || !empty($row['StockExchange'])) {
            echo '<div class="card mt-3" id="details-' . $row['ApprovedID'] . '" style="display:none;">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Details</h5>';
            echo '<div class="row">';
            echo '<div class="col-md-4">';
            echo '<p class="card-text"><strong>Denomination:</strong></p>';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<p class="card-text">' . $row['Denomination'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="col-md-4">';
            echo '<p class="card-text"><strong>Product Type:</strong></p>';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<p class="card-text">' . $row['ProductType'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="col-md-4">';
            echo '<p class="card-text"><strong>Currency:</strong></p>';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<p class="card-text">' . $row['PriceCurrency'] . '<p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        
    }
} else {
    echo '<p>Please complete your profile to get tailored recommedations </p>';
}


// Close database connection
mysqli_close($conn);

?>

<script>
    approvedId = 'ApprovedID'
function toggleDetails(approvedId) {
    var detailsElement = document.getElementById('details-' + approvedId);
    if (detailsElement.style.display === 'none') {
        detailsElement.style.display = 'block';
    } else {
        detailsElement.style.display = 'none';
    }
}
</script>
<script>
    approvedId = 'ApprovedID'
function addToWishlist(approvedId) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      alert('Idea added to wishlist successfully!');
    }
  };
  xhr.open('POST', 'http://localhost/wealth_affairs/clients/back_end/add_to_wishlist.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('ApprovedID=' + approvedId);
}
</script>


