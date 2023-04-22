<?php 
    include "dbconnection.php";

    $request_body = file_get_contents('php://input');  // This allow this PHP script to read the raw data from the HTTP request body sent by javascript
    $request_data = json_decode($request_body, true);  // This parse the raw json data into PHP associative array

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

    // CTE (Common Table Expression) is used to derive a table that joins data from multiple tables and select specific columns
    // This strict matches all clients that have the same preferences (risk level, product type, industry and country)
    $query = mysqli_query($databaseConnection, "With CTE as ( SELECT cl.ClientID, Firstname, Lastname, RiskLevel as RiskLevelPref, ProductType as ProductTypePref, Country as CountryPref, Industry as IndustryPref 
        FROM clients cl
        left join COUNTRIES co on co.ClientID=cl.ClientID
        left join industries ind on ind.ClientID=cl.ClientID
        left join producttypes pdt on pdt.ClientID=cl.ClientID)
        select DISTINCT a.*, ai.*
        from approvedideas ai left join CTE a on ai.risklevel=a.RiskLevelPref
        WHERE RiskLevel=$RiskLevel
        AND ApprovedID=$ApprovedID
        AND FIND_IN_SET('$ProductType', a.ProductTypePref)
        AND FIND_IN_SET('$Industry', a.IndustryPref)
        AND FIND_IN_SET('$Country', a.CountryPref)
    ");


    // This code was written to priortise only clients' risk level and product types and make clients' countries and industry preferences optional when recommending product to them. 
    // However, the multiple data sent from the client preference page has to been strictly formatted to merit MySQL SET data type in the database.
    // $query = mysqli_query($databaseConnection, "With CTE as ( SELECT cl.ClientID, Firstname, Lastname, RiskLevel as RiskLevelPref, ProductType as ProductTypePref, Country as CountryPref, Industry as IndustryPref 
    //     FROM clients cl
    //     left join COUNTRIES co on co.ClientID=cl.ClientID
       
    //     left join industries ind on ind.ClientID=cl.ClientID
    //     left join producttypes pdt on pdt.ClientID=cl.ClientID)
    //     select DISTINCT a.*, ai.*
    //     from approvedideas ai left join CTE a on ai.risklevel=a.RiskLevelPref
    //     WHERE RiskLevel=$RiskLevel
    //     AND ApprovedID=$ApprovedID
    //     AND FIND_IN_SET('$ProductType', a.ProductTypePref)
    //     AND (
    //         FIND_IN_SET('$Industry', a.IndustryPref)
    //         OR FIND_IN_SET('$Country', a.CountryPref)
            
    //     )
    // ");

    if (mysqli_num_rows($query) > 0) {
        $matchedClients = array();
        while ($row = mysqli_fetch_assoc($query)) {
            // Covert the data to a PHP array
            $matchedClients[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($matchedClients);
        header('HTTP/1.1 200 OK'); // Set HTTP status code to 200 OK
        echo $json;
    } else {
        // If no client is found, format the response as JSON
        $message = array('message' => 'No Client matched');
        $json = json_encode($message);
        header('HTTP/1.1 200 OK'); // Set HTTP status code to 200 OK
        echo $json;
    }
    mysqli_close($databaseConnection);
?>