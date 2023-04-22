<?php 
    // Connection to the database
    require_once "dbconnection.php";
    
    // Select all approved ideas
    $result = mysqli_query($databaseConnection, "SELECT * FROM `approvedideas`");
    if (mysqli_num_rows($result) > 0) {
        $allProducts = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // Covert the data to a PHP array
            $allProducts[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($allProducts);
        echo $json;
    } else {
        // echo "No product found.";
        echo json_encode("No product found");
    }

    mysqli_free_result($result);
    mysqli_close($databaseConnection);
?>

