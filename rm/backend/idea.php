<?php
    include "dbconnection.php";

    $instrumentName = $_POST["InstrumentName"];
    $instrumentDn = $_POST["InstrumentDn"];
    $BasicSecurities = $_POST["BasicSecurities"];
    $Derivatives = $_POST["Derivatives"];
    $Industry = $_POST["Industry"];
    $RiskLevel = $_POST["RiskLevel"];
    $Denomination = $_POST["Denomination"];
    $PriceCurrency = $_POST["PriceCurrency"];
    $ClosingPrice = $_POST["ClosingPrice"];
    $StockExchange = $_POST["StockExchange"];
    $Issuer = $_POST["Issuer"];
    $Isin = $_POST["Isin"];
    $Ticker = $_POST["Ticker"];
    $Region = $_POST["Region"];
    $Country = $_POST["Country"];
    $Ticker = $_POST["Ticker"];

    if ($_POST["Derivatives"] == ''){
        $Derivatives = NULL;
    } else {
        $Derivatives = $_POST["Derivatives"];
    }

    echo $instrumentName;
    echo $instrumentDn;
    echo $BasicSecurities;
    echo $Derivatives;
    echo $Industry;
    echo $RiskLevel;
    echo $Denomination;
    echo $PriceCurrency;
    echo $ClosingPrice;
    echo $StockExchange;
    echo $Issuer;
    echo $Isin;
    echo $Ticker;
    echo $Region;
    echo $Country;
    echo $Ticker;

    mysqli_query($databaseConnection, "INSERT INTO `idea`(`InstrumentName`, `InstrumentDn`, `BasicSecurities`, `Derivatives`, `Industry`, `RiskLevel`, `Denomination`, `PriceCurrency`, `ClosingPrice`, `StockExchange`, `Issuer`, `Isin`, `Ticker`, `Region`, `Country`) 
    VALUES ('$instrumentName','$instrumentDn','$BasicSecurities','$Derivatives','$Industry','$RiskLevel','$Denomination','$PriceCurrency','$ClosingPrice','$StockExchange','$Issuer','$Isin','$Ticker','$Region','$Country')");

    mysqli_close($databaseConnection);
?>