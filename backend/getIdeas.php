<?php 
    $databaseConnection = new mysqli("localhost", "root", "", "wealth_affairs");
    if ($databaseConnection -> connect_error){
        die("Connection failed. " . $databaseConnection -> connect_error);
    };

    $result = mysqli_query($databaseConnection, "SELECT * FROM `ideas`");
    
    if (mysqli_num_rows($result) > 0) {
        $resultas = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // Display the data from each row
            // echo "Idea ID: " . $row['IdeaID'] . "<br>";
            // echo "Instrument Name: " . $row['InstrumentName'] . "<br>";
            // echo "Basic Securities: " . $row['BasicSecurities'] . "<br>";
            // echo "Derivatives: " . $row['Derivatives'] . "<br>";
            // echo "Industry: " . $row['Industry'] . "<br>";
            // echo "Created At: " . $row['CreatedAt'] . "<br>";
            // echo "Updated At: " . $row['updated_at'] . "<br><br>";
            // Covert the data to a PHP array
            $resultas[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($resultas);
        echo $json;
    } else {
        echo "No results found.";
    }

    mysqli_free_result($result);
    mysqli_close($databaseConnection);
?>