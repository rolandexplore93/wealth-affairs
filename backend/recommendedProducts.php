<?php 
    include "dbconnection.php";

    $request_body = file_get_contents('php://input'); // This retrieves and reads the raw data in the POST request sent by javascript to this php script
    $request_data = json_decode($request_body, true); // This parse the raw json data into PHP associative array

    if ($request_data === null) {
        // JSON decoding failed
        $message = array('message' => 'Error decoding JSON');
    } else {
        // Access the decoded data
        $ProductID = isset($request_data['ProductID']) ? $request_data['ProductID'] : '';
        $ClientID = isset($request_data['ClientID']) ? $request_data['ClientID'] : '';
        $firstname = isset($request_data['firstname']) ? $request_data['firstname'] : '';
        $lastname = isset($request_data['lastname']) ? $request_data['lastname'] : '';
        $InstrumentName = isset($request_data['InstrumentName']) ? $request_data['InstrumentName'] : '';
        $InstrumentDn = isset($request_data['InstrumentDn']) ? $request_data['InstrumentDn'] : '';
        $ProductType = isset($request_data['ProductType']) ? $request_data['ProductType'] : '';
        $Industry = isset($request_data['Industry']) ? $request_data['Industry'] : '';
        $RiskLevel = isset($request_data['RiskLevel']) ? $request_data['RiskLevel'] : '';
        $Denomination = isset($request_data['Denomination']) ? $request_data['Denomination'] : '';
        $PriceCurrency = isset($request_data['PriceCurrency']) ? $request_data['PriceCurrency'] : '';
        $ClosingPrice = isset($request_data['ClosingPrice']) ? $request_data['ClosingPrice'] : '';
        $PriceClosingDate = isset($request_data['PriceClosingDate']) ? $request_data['PriceClosingDate'] : '';
        $StockExchange = isset($request_data['StockExchange']) ? $request_data['StockExchange'] : '';
        $Issuer = isset($request_data['Issuer']) ? $request_data['Issuer'] : '';
        $Isin = isset($request_data['Isin']) ? $request_data['Isin'] : '';
        $Ticker = isset($request_data['Ticker']) ? $request_data['Ticker'] : '';
        $Region = isset($request_data['Region']) ? $request_data['Region'] : '';
        $Country = isset($request_data['Country']) ? $request_data['Country'] : '';
        $RiskLevelBrief = isset($request_data['RiskLevelBrief']) ? $request_data['RiskLevelBrief'] : '';
        $RiskLevelDescription = isset($request_data['RiskLevelDescription']) ? $request_data['RiskLevelDescription'] : '';
        // $CreatedAtRec = isset($request_data['CreatedAtRec']) ? $request_data['CreatedAtRec'] : '';
        $IdeaID = isset($request_data['IdeaID']) ? $request_data['IdeaID'] : '';
        $RmID = isset($request_data['RmID']) ? $request_data['RmID'] : '';

        // Set the time zone to Europe/London and get current timestamp
        date_default_timezone_set('Europe/London');
        $currentTime = date('Y-m-d H:i:s');

        $query = mysqli_query($databaseConnection, "SELECT * FROM `recommendedideas` WHERE ProductID = $ProductID AND ClientId = $ClientID;
        ");

        if (mysqli_num_rows($query) == 0) {
            mysqli_query($databaseConnection, "INSERT INTO `recommendedideas`(`ProductID`, `ClientID`, 
            `firstname`, `lastname`, `InstrumentName`, `InstrumentDn`, `ProductType`, 
            `Industry`, `RiskLevel`, `Denomination`, `PriceCurrency`, `ClosingPrice`, 
            `PriceClosingDate`, `StockExchange`, `Issuer`, `Isin`, `Ticker`, `Region`, 
            `Country`, `RiskLevelBrief`, `RiskLevelDescription`, `CreatedAtRec`, `IdeaID`, `RmID`) 
            VALUES ('$ProductID','$ClientID','$firstname','$lastname',
            '$InstrumentName','$InstrumentDn','$ProductType','$Industry','$RiskLevel','$Denomination','$PriceCurrency',
            '$ClosingPrice','$PriceClosingDate','$StockExchange', '$Issuer','$Isin','$Ticker','$Region',
            '$Country','$RiskLevelBrief','$RiskLevelDescription','$currentTime','$IdeaID','$RmID')
            ");
    
            $message = array('InstrumentName' => $InstrumentName, 'firstname' => $currentTime, 'ClientID' => $ClientID, 'Message' => "$firstname $lastname added to recommended ideas list matching $InstrumentName product");

        } else {
            $message = array('Message' => "$firstname $lastname already exists for $InstrumentName");
        }
        mysqli_free_result($query);
    }
    
    $json = json_encode($message);
    echo $json;




    mysqli_close($databaseConnection);
?>