<?php 
    $instrumentName = $_POST["InstrumentName"];
    $instrumentDn = $_POST["InstrumentDn"];
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
    if(isset($_POST["BasicSecurities"])) {
        $BasicSecurities = $_POST["BasicSecurities"];
        echo $BasicSecurities;
    }

    if(isset($_POST["Derivatives"])) {
        $Derivatives = $_POST["Derivatives"];
        echo $Derivatives;
    }

    $RiskLevelBrief;
    $RiskLevelDescription;
    if ($RiskLevel == 1){
        $RiskLevelBrief = 'Suitable for very conservative investors';
        $RiskLevelDescription = 'Investors who hope to experience minimal fluctuations in portfolio value over a rolling one year period and are generally only willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) at a price close to the recently observed market value.';
    } else if($RiskLevel == 2) {
        $RiskLevelBrief = 'Suitable for conservative investors';
        $RiskLevelDescription = 'Investors who hope to experience no more than small portfolio losses over a rolling one-year period and are generally only willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) although the investor may at times buy individual investments that entail greater risk.';
    } else if($RiskLevel == 3) {
        $RiskLevelBrief = 'Suitable for moderate investors';
        $RiskLevelDescription = 'Investors who hope to experience no more than moderate portfolio losses over a rolling one year period in attempting to enhance longer-term performance and are generally willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) in stable markets although the investor may at times buy individual investments that entail greater risk and are less liquid.';
    } else if($RiskLevel == 4) {
        $RiskLevelBrief = 'Suitable for aggressive investors';
        $RiskLevelDescription = 'Investors who are prepared to accept greater portfolio losses over a rolling one year period while attempting to enhance longer-term performance and are willing to buy investments or enter into contracts that may be difficult to sell or close within a short time-frame or have an uncertain realizable value at any given time.';
    } else {
        $RiskLevelBrief = 'Suitable for very aggressive investors';
        $RiskLevelDescription = 'Investors who are prepared to accept large portfolio losses up to the value of their entire portfolio over a one year period and are generally willing to buy investments or enter into contracts that may be difficult to sell or close for an extended period or have an uncertain realizable value at any given time.';
    }

    // echo $instrumentName;
    // echo $instrumentDn;
    // echo $BasicSecurities;
    // echo $Derivatives;
    // echo $Industry;
    echo $RiskLevel;
    echo $RiskLevelBrief;
    echo $RiskLevelDescription;
    // echo $Denomination;
    // echo $PriceCurrency;
    // echo $ClosingPrice;
    // echo $StockExchange;
    // echo $Issuer;
    // echo $Isin;
    // echo $Ticker;
    // echo $Region;
    // echo $Country;
    // echo $Ticker;


?>