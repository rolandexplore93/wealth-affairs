<?php 
    $databaseConnection = new mysqli("localhost", "root", "", "wealth_affairs");
    if ($databaseConnection -> connect_error){
        die("Connection failed. " . $databaseConnection -> connect_error);
    };

$request_body = file_get_contents('php://input');
$request_data = json_decode($request_body, true);

if (isset($request_data['productID'])) {
    $ProductID = $request_data['productID'];
} else {
    $ProductID = null;
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

// echo "productID: " . $ProductID . "<br>";
// echo "riskLevel: " . $RiskLevel . "<br>";
// echo "productType: " . $ProductType . "<br>";
// echo "industry: " . $Industry . "<br>";
// echo "country: " . $Country . "<br>";
// echo "region: " . $Region . "<br>";


    $query = mysqli_query($databaseConnection, "With CTE as ( SELECT aa.ClientID, firstname, lastname, selectedRiskLevel, ProductType, Country, region, Industry 
        FROM client aa
        left join COUNTRIES a on a.ClientID=aa.ClientID
        left join regions b on aa.ClientID=b.ClientID
        left join industries c on aa.ClientID=c.ClientID
        left join producttypes pdt on aa.ClientID=pdt.ClientID)
        select DISTINCT a.*, pp.InstrumentName, pp.RiskLevel from products pp left join CTE a on pp.risklevel=a.selectedrisklevel
        WHERE RiskLevel=$RiskLevel
        AND ProductID=$ProductID
        AND FIND_IN_SET('$ProductType', a.ProductType)
        AND FIND_IN_SET('$Industry', a.Industry)
        AND FIND_IN_SET('$Country', a.Country)
        AND FIND_IN_SET('$Region', a.region)
    ");

    if (mysqli_num_rows($query) > 0) {
        $matchedClients = array();
        while ($row = mysqli_fetch_assoc($query)) {
            // Display the data from each row
            // echo "Idea ID: " . $row['IdeaID'] . "<br>";
            // echo "Instrument Name: " . $row['InstrumentName'] . "<br>";
            // echo "Basic Securities: " . $row['BasicSecurities'] . "<br>";
            // echo "Derivatives: " . $row['Derivatives'] . "<br>";
            // echo "Industry: " . $row['Industry'] . "<br>";
            // echo "Created At: " . $row['CreatedAt'] . "<br>";
            // echo "Updated At: " . $row['updated_at'] . "<br><br>";
            // Covert the data to a PHP array
            $matchedClients[] = $row;
        }
        // Convert PHP array to JSON string and send it to the client
        $json = json_encode($matchedClients);
        echo $json;
    } else {
        echo "No Client found.";
    }

    // mysqli_free_result($result);

    mysqli_close($databaseConnection);

?>