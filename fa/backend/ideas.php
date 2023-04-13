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
    $Ticker = $_POST["Ticker"];
    $Region = $_POST["Region"];
    $Country = $_POST["Country"];

    do {
        if ( empty($InstrumentName) || empty($InstrumentDn) || empty($IdeaDescription)|| empty($ProductType) || empty($Industry) || empty($RiskLevel) || empty($Denomination) || empty($PriceCurrency) || empty($ClosingPrice) || empty($PriceClosingDate) || empty($StockExchange) || empty($Issuer) || empty($Ticker) || empty($Region) || empty($Country) || empty($IssueDate) || empty($MaturityDate)) { 
            $errorMessage = "All the fields are required. Redirecting to idea creation page in 3 seconds...";
            echo $errorMessage;
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'http://localhost/wealth_affairs/fa/createIdea.php';
                }, 3000); // 3000 milliseconds = 3 seconds
            </script>";
            break;
        }

        $FaID = 1;
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
        echo $StockExchange;
        echo $Issuer;
        echo $Ticker;
        echo $Region;
        echo $Country;
        echo $RiskLevelBrief;
        echo $RiskLevelDescription;
        echo $IssueDate;
        echo $MaturityDate;
        echo $FaID;

        $successMessage = "Idea successfully created. Redirecting to homepage in 3 seconds...";
        $sql = "INSERT INTO `ideas` (`InstrumentName`, `InstrumentDn`, `IdeaDescription`, `ProductType`, 
        `Industry`, `RiskLevel`, `Denomination`, `PriceCurrency`, `ClosingPrice`, `PriceClosingDate`, 
        `StockExchange`, `Issuer`, `Ticker`, `Region`, `Country`, `RiskLevelBrief`, 
        `RiskLevelDescription`, `IssueDate`, `FaID`, `MaturityDate` )
        VALUES('$InstrumentName','$InstrumentDn', '$IdeaDescription','$ProductType',
        '$Industry','$RiskLevel', '$Denomination', '$PriceCurrency', '$ClosingPrice', 
        '$PriceClosingDate', '$StockExchange', '$Issuer', ' $Ticker', '$Region', 
        '$Country', '$RiskLevelBrief', '$RiskLevelDescription', '$IssueDate', '$FaID', '$MaturityDate'
        )";
        $result = $databaseconnection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $databaseconnection->error;
            break;
        }

        echo $successMessage;
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'http://localhost/wealth_affairs/fa/index.php';
                }, 3000);
            </script>";
            break;
    } while (false);
}

exit;
?>