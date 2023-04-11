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

// Create database connection
$conn = new mysqli('localhost', 'root', '', 'wealthaffairsdb');

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected checkbox values
    $industry = isset($_POST['industry']) ? $_POST['industry'] : array();
    $productType = isset($_POST['productType']) ? $_POST['productType'] : array();
    $countries= isset($_POST['Pcountry']) ? $_POST['Pcountry'] : array();
    $riskLevel = isset($_POST['riskLevel']) ? intval($_POST['riskLevel']) : 0;
    
    $updated = false;

    // Update industry records for the selected industries
    if (!empty($industry)) {
        // Check if industry record already exists
        $sql = "SELECT * FROM industry WHERE Client_ID=$current_clientid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Delete existing industry records for the client ID
            $sql = "DELETE FROM industry WHERE Client_ID=$current_clientid";
            $conn->query($sql);
        }

        // Insert new industry records for the selected industries
        foreach ($industry as $ind) {
            $sql = "INSERT INTO industry (Client_ID, industries) VALUES ($current_clientid, '$ind')";
            $conn->query($sql);
        }

        $updated = true;
    }

    // Update product type records for the selected product types
    if (!empty($productType)) {
        // Check if product type record already exists
        $sql = "SELECT * FROM producttype WHERE ClientID=$current_clientid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Delete existing product type records for the client ID
            $sql = "DELETE FROM producttype WHERE ClientID=$current_clientid";
            $conn->query($sql);
        }

        // Insert new product type records for the selected product types
        foreach ($productType as $prod) {
            $sql = "INSERT INTO producttype (ClientID, Products) VALUES ($current_clientid, '$prod')";
            $conn->query($sql);
        }

        $updated = true;
    }

    // Update country records for the selected countries
    if (!empty($countries)) {
        // Check if country record already exists
        $sql = "SELECT * FROM country WHERE Client_ID=$current_clientid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Delete existing country records for the client ID
            $sql = "DELETE FROM country WHERE Client_ID=$current_clientid";
            $conn->query($sql);
        }

        // Insert new country records for the selected countries
        foreach ($countries as $country) {
            $sql = "INSERT INTO country (Client_ID, Countries) VALUES ($current_clientid, '$country')";
            $conn->query($sql);
        }

        $updated = true;
    }


    // Update risk level record
    if (!empty($riskLevel)) {
        // Check if risk level record already exists
        $sql = "SELECT * FROM client WHERE Client_ID=$current_clientid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Update the existing record with the new selected risk level value
            $sql = "UPDATE client SET SelectRiskLevel=$riskLevel WHERE Client_ID=$current_clientid";
            $conn->query($sql);
        } else {
            // Insert a new record with the selected risk level value
            $sql = "INSERT INTO client (SelectRiskLevel) VALUES ('$riskLevel')";
            $conn->query($sql);
        }

        $updated = true;
    }

    if ($updated) {
        echo "<script>alert('Preferences updated successfully'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth-affairs/clients/front_end/profile.php'; }, 1000);
                    </script>";
        exit();
    }
}

// Close the database connection
$conn->close();