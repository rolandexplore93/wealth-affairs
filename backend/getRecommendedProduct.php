<?php 
    include "dbconnection.php";
    $ClientID = 1; // this value should be the clientId from the session

    $getRecommendedProducts = mysqli_query($databaseConnection, "SELECT * FROM `recommendedideas` WHERE ClientID = $ClientID");
    
    if (mysqli_num_rows($getRecommendedProducts) > 0) {
        $allProducts = array();
        while ($row = mysqli_fetch_assoc($getRecommendedProducts)) {
            // Covert the data to a PHP array
            $allProducts[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($allProducts);
        echo $json;
    } else {
        echo json_encode("You do not have recommended products yet");
    }

    mysqli_free_result($getRecommendedProducts);
    mysqli_close($databaseConnection);
?>