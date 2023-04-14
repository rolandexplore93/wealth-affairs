<?php 
    include "dbconnection.php";
    $clients = mysqli_query($databaseConnection, "SELECT * FROM `clients`");
    
    if (mysqli_num_rows($clients) > 0) {
        $allClients = array();
        while ($row = mysqli_fetch_assoc($clients)) {
            // Display the data from each row
            // echo "Product ID: " . $row['ProductID'] . "<br>";
            // echo "Instrument Name: " . $row['InstrumentName'] . "<br>";
            // echo "Basic Securities: " . $row['BasicSecurities'] . "<br>";
            // echo "Derivatives: " . $row['Derivatives'] . "<br>";
            // echo "Industry: " . $row['Industry'] . "<br>";
            // echo "Created At: " . $row['CreatedAt'] . "<br>";
            // echo "Updated At: " . $row['updated_at'] . "<br><br>";

            // Covert the data to a PHP array
            $allClients[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($allClients);
        echo $json;
    } else {
        echo json_encode("No client found");
    }

    // mysqli_free_result($clients);
    mysqli_close($databaseConnection);

?>