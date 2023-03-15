<?php 
    $databaseConnection = new mysqli("localhost", "root", "", "wealth_affairs");
    if ($databaseConnection -> connect_error){
        die("Connection failed. " . $databaseConnection -> connect_error);
    };
    // echo "Connection successful";

    $result = mysqli_query($databaseConnection, "SELECT * FROM `idea`");
    
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
            $resultas[] = $row;
            // echo $resultas;
        }
        $json = json_encode($resultas);
        echo $json;
    } else {
        echo "No results found.";
    }

    mysqli_free_result($result);


      // fetch the data as an associative array
//   $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
//   // encode the data as JSON
//   $json = json_encode($data);
  
//   // send the JSON response
//   header('Content-Type: application/json');
//   echo $json;

  
// Convert data to a PHP array
// $result1 = array();
// while ($row = mysqli_fetch_assoc($data)) {
//     $result1[] = $row;
// }

// // Convert PHP array to JSON string
// $json = json_encode($result1);

// // Return JSON string to the client
// echo $json;
?>