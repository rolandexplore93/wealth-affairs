<?php 
    // Connection to the database
    include "dbconnection.php";

    // Select all clients from clients table
    $clients = mysqli_query($databaseConnection, "SELECT * FROM `clients`");
    if (mysqli_num_rows($clients) > 0) {
        $allClients = array();
        while ($row = mysqli_fetch_assoc($clients)) {
            // Covert each data to a PHP array
            $allClients[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($allClients);
        echo $json;
    } else {
        echo json_encode("No client found");
    }

    mysqli_close($databaseConnection);

?>