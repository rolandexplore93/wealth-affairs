<?php 
    // Connection to the database
    include "dbconnection.php";
    // Select all ideas
    $result = mysqli_query($databaseConnection, "SELECT * FROM `ideas`");
    if (mysqli_num_rows($result) > 0) {
        $resultas = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // Covert the data to a PHP array
            $resultas[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($resultas);
        echo $json;
    } else {
        echo json_encode("No results found.");
    }

    mysqli_free_result($result);
    mysqli_close($databaseConnection);
?>