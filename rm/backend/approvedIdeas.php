<?php
// Connection to the database
include "dbconnection.php";
// Confirm if the request method is a POST request
// If this is true, store all the data in a variable and insert it into approvedideas table
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $InstrumentName = $_POST["InstrumentName"];
    $InstrumentName = $_POST["InstrumentDn"];
    $IdeaDescription = $_POST["IdeaDescription"];
    if(isset($_POST["ProductType"])) { $ProductType = $_POST["ProductType"];}    // echo $ProductType;
    $Industry = $_POST["Industry"];
    $RiskLevel = $_POST["RiskLevel"];
    $Denomination = $_POST["Denomination"];
    $PriceCurrency = $_POST["PriceCurrency"];
    $ClosingPrice = $_POST["ClosingPrice"];
    $PriceClosingDate = $_POST["PriceClosingDate"];
    $StockExchange = $_POST["StockExchange"];
    $Issuer = $_POST["Issuer"];
    $Ticker = $_POST["Ticker"];
    $Region = $_POST["Region"];
    $Country = $_POST["Country"];
    $IssueDate = $_POST["IssueDate"];
    $MaturityDate = $_POST["MaturityDate"];
    $IdeaID = $_POST["IdeaID"];
    $RmID = 1; // this value should be the RmID from the RM session login but since we're using 1 RM in the company, we pass in the value as 1
    // Assigned respective risk level details based on each risk level value
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
    // Check if approved or rejected button is clicked
    if (isset($_POST["reject"])){
        // Update this idea status to 'Rejected' inside the main ideas table
        $updateIdeasTableStatus = mysqli_query($databaseConnection, "UPDATE ideas SET Status = 'Rejected' WHERE IdeaId = $IdeaID");
        $ideaRejected = "This Investment idea is rejected. Redirecting to homepage in 3 seconds...";
        echo $ideaRejected;
        echo "<script>
            setTimeout(function() {
                window.location.href = 'http://localhost/wealth_affairs/rm/index.php';
            }, 3000);
        </script>";
        exit;
    } elseif (isset($_POST["approve"])){
        // Approve the idea and create it in the new approvedideas table
        $approveIdea = mysqli_query($databaseConnection, "INSERT INTO `approvedideas`(`InstrumentName`, `InstrumentDn`, `IdeaDescription`, 
        `ProductType`, `Industry`, `RiskLevel`, `Denomination`, `PriceCurrency`, `ClosingPrice`, 
        `PriceClosingDate`, `StockExchange`, `Issuer`, `Ticker`, `Region`, `Country`, `IssueDate`, 
        `MaturityDate`, `RiskLevelBrief`, `RiskLevelDescription`, `IdeaID`, `RmID`) 
        VALUES ('$InstrumentName','$InstrumentName', '$IdeaDescription',
        '$ProductType','$Industry','$RiskLevel','$Denomination','$PriceCurrency','$ClosingPrice',
        '$PriceClosingDate','$StockExchange','$Issuer', '$Ticker','$Region','$Country', '$IssueDate',
        '$MaturityDate', '$RiskLevelBrief','$RiskLevelDescription','$IdeaID','$RmID')");

        if ($approveIdea) {
            $updateIdeasTableStatus = mysqli_query($databaseConnection, "UPDATE ideas SET status = 'Approved' WHERE IdeaId = $IdeaID");
        }

        $successMessage = "Idea Approved successfully. Redirecting to approved idea page in 3 seconds...";
        // echo "Data posted <br>";
        // echo $InstrumentName . "<br>";
        // echo $InstrumentName . "<br>"; 
        // echo $IdeaDescription . "<br>";
        // echo $ProductType . "<br>";
        // echo $Industry . "<br>";
        // echo $RiskLevel . "<br>";
        // echo $Denomination . "<br>";
        // echo $PriceCurrency . "<br>";
        // echo $ClosingPrice . "<br>";
        // echo $PriceClosingDate . "<br>";
        // echo $StockExchange . "<br>";
        // echo $Issuer . "<br>";
        // echo $Ticker . "<br>";
        // echo $Region . "<br>";
        // echo $Country . "<br>";
        // echo $IssueDate . "<br>";
        // echo $MaturityDate . "<br>";
        // echo $RiskLevelBrief . "<br>";
        // echo $RiskLevelDescription . "<br>";
        // echo $IdeaID . "<br>";
        // echo $RmID . "<br>";

        echo $successMessage;
        echo "<script>
            setTimeout(function() {
                window.location.href = 'http://localhost/wealth_affairs/rm/index.php';
            }, 3000);
        </script>";
    }
    exit;
}
mysqli_close($databaseConnection);
?>