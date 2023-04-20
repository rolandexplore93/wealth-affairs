<?php 
    include "dbconnection.php";

    $request_body = file_get_contents('php://input'); // This retrieves and reads the raw data in the POST request sent by javascript to this php script
    $request_data = json_decode($request_body, true); // This parse the raw json data into PHP associative array

    if ($request_data === null) {
        // JSON decoding failed
        $message = array('message' => 'Error decoding JSON');
    } else {
        // Access the decoded data
        $ApprovedID = isset($request_data['ApprovedID']) ? $request_data['ApprovedID'] : '';
        $ClientID = isset($request_data['ClientID']) ? $request_data['ClientID'] : '';
        $Firstname = isset($request_data['Firstname']) ? $request_data['Firstname'] : '';
        $Lastname = isset($request_data['Lastname']) ? $request_data['Lastname'] : '';
        $InstrumentName = isset($request_data['InstrumentName']) ? $request_data['InstrumentName'] : '';
        $InstrumentDn = isset($request_data['InstrumentDn']) ? $request_data['InstrumentDn'] : '';
        $IdeaDescription = isset($request_data['IdeaDescription']) ? $request_data['IdeaDescription'] : '';
        $ProductType = isset($request_data['ProductType']) ? $request_data['ProductType'] : '';
        $Industry = isset($request_data['Industry']) ? $request_data['Industry'] : '';
        $RiskLevel = isset($request_data['RiskLevel']) ? $request_data['RiskLevel'] : '';
        $Denomination = isset($request_data['Denomination']) ? $request_data['Denomination'] : '';
        $PriceCurrency = isset($request_data['PriceCurrency']) ? $request_data['PriceCurrency'] : '';
        $ClosingPrice = isset($request_data['ClosingPrice']) ? $request_data['ClosingPrice'] : '';
        $PriceClosingDate = isset($request_data['PriceClosingDate']) ? $request_data['PriceClosingDate'] : '';
        $StockExchange = isset($request_data['StockExchange']) ? $request_data['StockExchange'] : '';
        $Issuer = isset($request_data['Issuer']) ? $request_data['Issuer'] : '';
        $Ticker = isset($request_data['Ticker']) ? $request_data['Ticker'] : '';
        $Region = isset($request_data['Region']) ? $request_data['Region'] : '';
        $Country = isset($request_data['Country']) ? $request_data['Country'] : '';
        $IssueDate = isset($request_data['IssueDate']) ? $request_data['IssueDate'] : '';
        $MaturityDate = isset($request_data['MaturityDate']) ? $request_data['MaturityDate'] : '';
        $RiskLevelBrief = isset($request_data['RiskLevelBrief']) ? $request_data['RiskLevelBrief'] : '';
        $RiskLevelDescription = isset($request_data['RiskLevelDescription']) ? $request_data['RiskLevelDescription'] : '';
        // $CreatedAtRec = isset($request_data['CreatedAtRec']) ? $request_data['CreatedAtRec'] : '';
        $IdeaID = isset($request_data['IdeaID']) ? $request_data['IdeaID'] : '';
        $RmID = isset($request_data['RmID']) ? $request_data['RmID'] : '';

        // Set the time zone to Europe/London and get current timestamp
        date_default_timezone_set('Europe/London');
        $CurrentTime = date('Y-m-d H:i:s');

        $query = mysqli_query($databaseConnection, "SELECT * FROM `recommendedideas` WHERE ApprovedID = $ApprovedID AND ClientId = $ClientID;
        ");

        if (mysqli_num_rows($query) == 0) {
            mysqli_query($databaseConnection, "INSERT INTO `recommendedideas`(`ApprovedID`, `ClientID`, 
            `Firstname`, `Lastname`, `InstrumentName`, `InstrumentDn`, `IdeaDescription`, `ProductType`, 
            `Industry`, `RiskLevel`, `Denomination`, `PriceCurrency`, `ClosingPrice`, 
            `PriceClosingDate`, `StockExchange`, `Issuer`, `Ticker`, `Region`, 
            `Country`, `IssueDate`, `MaturityDate`, `RiskLevelBrief`, `RiskLevelDescription`, 
            `CreatedAtRec`, `IdeaID`, `RmID`) 
            VALUES ('$ApprovedID','$ClientID','$Firstname','$Lastname',
            '$InstrumentName','$InstrumentDn', '$IdeaDescription', '$ProductType','$Industry','$RiskLevel',
            '$Denomination','$PriceCurrency',
            '$ClosingPrice','$PriceClosingDate','$StockExchange', '$Issuer', '$Ticker','$Region',
            '$Country', '$IssueDate', '$MaturityDate', '$RiskLevelBrief','$RiskLevelDescription',
            '$CurrentTime', '$IdeaID', '$RmID')
            ");

            $message = array('InstrumentName' => $InstrumentName, 'Timenow' => $CurrentTime, 'ClientID' => $ClientID, 'Message' => "$Firstname $Lastname added to recommended ideas list matching $InstrumentName product");

        } else {
            $message = array('Message' => "$Firstname $Lastname already exists for $InstrumentName");
        }
        mysqli_free_result($query);
    }
    
    $json = json_encode($message);
    echo $json;

    mysqli_close($databaseConnection);
?>