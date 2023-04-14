<?php 
    include "dbconnection.php";

    $request_body = file_get_contents('php://input');
    $request_data = json_decode($request_body, true);

    if (isset($request_data['approvedIdeaDataID'])) {
        $ApprovedID = $request_data['approvedIdeaDataID'];
    } else {
        $ApprovedID = null;
    }

    if (isset($request_data['riskLevel'])) {
        $RiskLevel = $request_data['riskLevel'];
    } else {
        $RiskLevel = null;
    }

    if (isset($request_data['productType'])) {
        $ProductType = $request_data['productType'];
    } else {
        $ProductType = null;
    }

    if (isset($request_data['industry'])) {
        $Industry = $request_data['industry'];
    } else {
        $Industry = null;
    }

    if (isset($request_data['country'])) {
        $Country = $request_data['country'];
    } else {
        $Country = null;
    }

    if (isset($request_data['region'])) {
        $Region = $request_data['region'];
    } else {
        $Region = null;
    }
    // echo "productType: " . $ProductType . "<br>";

    $query = mysqli_query($databaseConnection, "With CTE as ( SELECT cl.ClientID, Firstname, Lastname, RiskLevel as RiskLevelPref, ProductType as ProductTypePref, Country as CountryPref, Region as RegionPref, Industry as IndustryPref 
        FROM clients cl
        left join COUNTRIES co on co.ClientID=cl.ClientID
        left join regions re on re.ClientID=cl.ClientID
        left join industries ind on ind.ClientID=cl.ClientID
        left join producttypes pdt on pdt.ClientID=cl.ClientID)
        select DISTINCT a.*, ai.*
        from approvedideas ai left join CTE a on ai.risklevel=a.RiskLevelPref
        WHERE RiskLevel=$RiskLevel
        AND ApprovedID=$ApprovedID
        AND FIND_IN_SET('$ProductType', a.ProductTypePref)
        AND (
            FIND_IN_SET('$Industry', a.IndustryPref)
            OR FIND_IN_SET('$Country', a.CountryPref)
            OR FIND_IN_SET('$Region', a.RegionPref)
        )
    ");

    if (mysqli_num_rows($query) > 0) {
        $matchedClients = array();
        while ($row = mysqli_fetch_assoc($query)) {
            // Display the data from each row
            // echo "Idea ID: " . $row['IdeaID'] . "<br>";
            // echo "productType: " . $ProductType . "<br>";
            // echo "Instrument Name: " . $row['InstrumentName'] . "<br>";
            // echo "Industry: " . $row['Industry'] . "<br>";
            // echo "Created At: " . $row['CreatedAt'] . "<br>";
            // echo "Updated At: " . $row['updated_at'] . "<br><br>";
            // Covert the data to a PHP array
            $matchedClients[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($matchedClients);
        header('HTTP/1.1 200 OK'); // Set HTTP status code to 200 OK
        echo $json;
    } else {
        // If no client is found, format the error message as JSON
        $error = array('error' => 'No Client matched');
        $json = json_encode($error);
        header('HTTP/1.1 200 OK'); // Set HTTP status code to 200 OK
        echo $json;
    }
    mysqli_close($databaseConnection);
?>