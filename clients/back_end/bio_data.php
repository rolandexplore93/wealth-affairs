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

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $phone = !empty($_POST['pnumber']) ? $_POST['pnumber'] : '';
    $address = !empty($_POST['adds']) ? $_POST['adds'] : '';
    $postcode = !empty($_POST['pcode']) ? $_POST['pcode'] : '';
    $country = !empty($_POST['country']) ? $_POST['country'] : '';


     // Check if email already exists in database
     if (!empty($email)) {
        $stmt = $conn->prepare("SELECT Client_ID FROM client WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Error: Email already exists in the database.'); 
                  setTimeout(function() 
                   { window.location.href = 'http://localhost/wealth-affairs/clients/front_end/profile.php'; }, 1000);
                    </script>";
            exit();
        }
        $stmt->close();
    }

    // Check if phone number already exists in database
    if (!empty($phone)) {
        $stmt = $conn->prepare("SELECT Client_ID FROM client WHERE PhoneNo = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Error: Phone number already exists in the database'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth-affairs/clients/front_end/profile.php'; }, 1000);
                    </script>";
            exit();
        }
        $stmt->close();
    }

    // Prepare and execute SQL query to update client record
    $setClause = '';
    $params = array();

    if (!empty($phone)) {
        $setClause .= 'PhoneNo=?, ';
        $params[] = $phone;
    }

    if (!empty($address)) {
        $setClause .= 'Address=?, ';
        $params[] = $address;
    }

    if (!empty($postcode)) {
        $setClause .= 'Postcode=?, ';
        $params[] = $postcode;
    }

    if (!empty($country)) {
        $setClause .= 'Country=?, ';
        $params[] = $country;
    }

    if (count($params) > 0) {
        // Remove the trailing comma and space from the set clause
        $setClause = substr($setClause, 0, -2);

        // Add the client ID to the end of the params array
        $params[] = $current_clientid;

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("UPDATE client SET $setClause WHERE Client_ID=?");
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);

        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Record updated successfully'); 
                  setTimeout(function() 
                    { window.location.href = 'http://localhost/wealth-affairs/clients/front_end/profile.php'; }, 1000);
                    </script>";
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $stmt->close();
    }
}

// Close the database connection
$conn->close();