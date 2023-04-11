<?php 
    include "dbconnection.php";

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $InstrumentName = $_POST["InstrumentName"];
        $InstrumentDn = $_POST["InstrumentDn"];
        $IdeaDescription = $_POST["IdeaDescription"];
        $ProductType = $_POST["ProductType"];
        $Industry = $_POST["Industry"];
        $RiskLevel = $_POST["RiskLevel"];
        $Denomination = $_POST["Denomination"];
        $PriceCurrency = $_POST["PriceCurrency"];
        $ClosingPrice = $_POST["ClosingPrice"];
        $PriceClosingDate = $_POST["PriceClosingDate"];
        $IssueDate = $_POST["IssueDate"];;
        $MaturityDate =$_POST["MaturityDate"];
        $StockExchange = $_POST["StockExchange"];
        $Issuer = $_POST["Issuer"];
        // $Isin = $_POST["Isin"];
        $Ticker = $_POST["Ticker"];
        $Region = $_POST["Region"];
        $Country = $_POST["Country"];
    
        do {
            if ( empty($InstrumentName) || empty($InstrumentDn) || empty($IdeaDescription)|| empty($ProductType) || empty($Industry) || empty($RiskLevel) || empty($Denomination) || empty($PriceCurrency) || empty($ClosingPrice) || empty($PriceClosingDate) || empty($IssueDate) || empty($MaturityDate) || empty($StockExchange) || empty($Issuer) || empty($Ticker) || empty($Region) || empty($Country) 
        ) { 
            $errorMessage = "All the fields are required";
            echo $errorMessage;
            break;
        }

    echo $InstrumentName;
    echo $InstrumentDn;
    echo $IdeaDescription;
    echo $ProductType;
    echo $Industry;
    echo $RiskLevel;
    echo $Denomination;
    echo $PriceCurrency;
    echo $ClosingPrice;
    echo $PriceClosingDate;
    echo $IssueDate;
    echo $MaturityDate;
    echo $StockExchange;
    echo $Issuer;
    // echo $Isin;
    echo $Ticker;
    echo $Region;
    echo $Country;

    $successMessage = "Idea successfully created";
    $sql = "INSERT INTO ideas (InstrumentName, InstrumentDn, ProductType, Industry, RiskLevel, Denomination, PriceCurrency, ClosingPrice, PriceClosingDate, IssueDate, MaturityDate, StockExchange, Issuer, Ticker, Region, Country)
    VALUES('$InstrumentName','$InstrumentDn', '$IdeaDescription','$ProductType','$Industry','$RiskLevel', '$Denomination', '$PriceCurrency', '$ClosingPrice', '$PriceClosingDate', '$IssueDate', '$MaturityDate','$StockExchange', '$Issuer','$Ticker', '$Region', '$Country')
    ";
    $result = $databaseconnection->query($sql);

    if (!$result) {
        $errorMessage = "Invalid query: " . $databaseconnection->error;
        break;
    }

    echo $successMessage;
    } while (false);
}


?>