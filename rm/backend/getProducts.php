<?php 
    require_once "dbconnection.php";
    $result = mysqli_query($databaseConnection, "SELECT * FROM `products`");
    
    if (mysqli_num_rows($result) > 0) {
        $allProducts = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // Display the data from each row
            // echo "Product ID: " . $row['ProductID'] . "<br>";
            // echo "Instrument Name: " . $row['InstrumentName'] . "<br>";
            // echo "Basic Securities: " . $row['BasicSecurities'] . "<br>";
            // echo "Derivatives: " . $row['Derivatives'] . "<br>";
            // echo "Industry: " . $row['Industry'] . "<br>";
            // echo "Created At: " . $row['CreatedAt'] . "<br>";
            // echo "Updated At: " . $row['updated_at'] . "<br><br>";

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

