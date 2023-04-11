<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style3.css">
    <title>Create Form</title>
</head>
<body>
<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "wealth_affairs";

// $connection = new mysqli($servername, $username, $password, $database);

// echo "Connected";

$InstrumentName ="";
$InstrumentDn ="";
$IdeaDescription ="";
$ProductType ="";
$Industry ="";
$RiskLevel ="";
$Issuer ="";
$Denomination ="";
$Ticker ="";
$ClosingPrice = "";
$PriceClosingDate ="";
$IssueDate ="";
$MaturityDate ="";
$StockExchange = "";
$Issuer ="";
$PriceCurrency ="";
$Region ="";
$Country ="";

$errorMessage = "";
$successMessage = "";

// if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
//     $InstrumentName = $_POST["InstrumentName"];
//     $InstrumentDn = $_POST["InstrumentDn"];
//     $IdeaDescription = $_POST["IdeaDescription"];
//     $ProductType = $_POST["ProductType"];
//     $Industry = $_POST["Industry"];
//     $RiskLevel = $_POST["RiskLevel"];
//     $Denomination = $_POST["Denomination"];
//     $PriceCurrency = $_POST["PriceCurrency"];
//     $ClosingPrice = $_POST["ClosingPrice"];
//     $PriceClosingDate = $_POST["PriceClosingDate"];
//     $IssueDate = $_POST["IssueDate"];
//     $MaturityDate = $_POST["MaturityDate"];
//     $StockExchange = $_POST["StockExchange"];
//     $Issuer = $_POST["Issuer"];
//     $Isin = $_POST["Isin"];
//     $Ticker = $_POST["Ticker"];
//     $Region = $_POST["Region"];
//     $Country = $_POST["Country"];

//     do {
//         if ( empty($instrumentName) || empty($instrumentDn) || empty($ProductType) || empty($Industry) || empty($RiskLevel) || empty($Denomination) || empty($PriceCurrency) || empty($ClosingPrice) || empty($PriceClosingDate) || empty($StockExchange) || empty($Issuer) || empty($Isin) || empty($Ticker) || empty($Region) || empty($Country) 
//     ) { $errorMessage = "All the fields are required";
//         break;
//     }

    // $sql = "INSERT INTO ideas (InstrumentName, InstrumentDn, ProductType, Industry, RiskLevel, Denomination, PriceCurrency, ClosingPrice, PriceClosingDate, StockExchange, Issuer, Isin, Ticker, Region, Country)";
    // $result = $connection->query($sql);

    // if (!$result) {
    //     $errorMessage = "Invalid query: " . $connection->error;
    //     break;
    // }

    // echo $InstrumentName;
    // echo $InstrumentDn;
    // echo $IdeaDescription;
    // echo $ProductType;
    // echo $Industry;
    // echo $RiskLevel;
    // echo $Denomination;
    // echo $PriceCurrency;
    // echo $ClosingPrice;
    // echo $PriceClosingDate;
    // echo $IssueDate;
    // echo $MaturityDate;
    // echo $StockExchange;
    // echo $Issuer;
    // echo $Isin;
    // echo $Ticker;
    // echo $Region;
    // echo $Country;

//     $successMessage = "Idea successfully created";

//     } while (false);
// }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wealth Affairs</title>
</head>
<body>
  <div class="container">
        <h1>Investment Ideas Upload</h1>
        <?php
        if ( !empty($errorMessage) ) {
            echo "<div><strong>$errorMessage</strong></div>";
        }
        ?>

    <form action="http://localhost/webdevelopment/wealth-affairs/fa/backend/ideas.php" method="POST">
        <div class="form-group">
        <label for="InstrumentName">Instrument Name:</label>
        <input type="text" id="InstrumentName" name="InstrumentName" value="<?php echo $InstrumentName; ?>" >
        </div>
        <hr />
        <div class="form-group">
        <label for="InstrumentDn">InstrumentDn:</label>
        <input type="text" id="InstrumentDn" name="InstrumentDn" value="<?php echo $InstrumentDn; ?>">
        </div>
        <hr />
        <div class="form-group">
        <label for="IdeaDescription">IdeaDescription:</label>
        <input type="text" id="IdeaDescription" name="IdeaDescription" value="<?php echo $IdeaDescription; ?>">
        </div>
        <hr />
        <div class="form-group">
        <label for="Product Type">ProductType:</label>
        <select id="Product Type" name="ProductType" value="<?php  echo $ProductType; ?>"  >>
            <option value="">-- Select an Instrument --</option>
            <option value="Stocks">Stocks</option>
            <option value="Bonds">Bonds</option>
            <option value="ETFs">ETFs</option>
            <option value="Mutual Funds">Mutual Funds</option>
            <option value="Security Derivatives">Security Derivatives</option>
            <option value="FX and Money Market">FX and Money Market</option>
            <option value="Credit Derivatives">Credit Derivatives</option>
            <option value="Insurance Derivatives">Insurance Derivatives</option>
        </select>
        </div>
        <hr />
        <div class="form-group">
        <label for="Industry">Industry:</label>
        <input type="text" id="Industry" name="Industry" value="<?php  echo $Industry; ?>"  >
        </div>
        <hr />
        <div class="form-group">
        <label for="Risk Level">RiskLevel:</label>
        <select id= "Risk Level" name="RiskLevel" value="<?php  echo $RiskLevel; ?>"  >>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        </select>
        </div>
        <hr />
        <div class="form-group">
        <label for="Denomination">Denomination:</label>
        <input type="text" id="Denomination" name="Denomination" value="<?php  echo $Denomination; ?>"  >
        </div>
        <hr />
        <div class="form-group">
        <label for="Price Currency">PriceCurrency:</label>
        <input type="text" id="Price Currency" name="PriceCurrency" value="<?php  echo $PriceCurrency; ?>" >
        </div>
        <hr />
        <div class="form-group">
        <label for="Closing Price">ClosingPrice:</label>
        <input type="text" id="Closing Price" name="ClosingPrice" value="<?php  echo $ClosingPrice; ?>">
        </div>
        <hr />
        <div class="form-group">
        <label for="Price Closing Date">PriceClosingDate:</label>
        <input type="text" id="Price Closing Date" name="PriceClosingDate" value="<?php  echo $PriceClosingDate; ?>" >
        </div>
        <hr />
        <div class="form-group">
        <label for="IssueDate">IssueDate:</label>
        <input type="text" id="IssueDate" name="IssueDate" value="<?php  echo $IssueDate; ?>" >
        </div>
        <hr />
        <div class="form-group">
        <label for="MaturityDate">MaturityDate:</label>
        <input type="text" id="MaturityDate" name="MaturityDate" value="<?php  echo $MaturityDate; ?>" >
        </div>
        <hr />
        <div class="form-group">
        <label for="Stock Exchange">StockExchange:</label>
        <input type="text" id="Stock Exchange" name="StockExchange" value="<?php  echo $StockExchange; ?>" >
        </div>
        <hr />
        <div class="form-group">
        <label for="Issuer">Issuer:</label>
        <input type="text" id="Issuer" name="Issuer" value="<?php  echo $Issuer; ?>"  >
        </div>
        <!-- <hr />
        <div class="form-group">
        <label for="Isin">Isin:</label>
        <input type="text" id="Isin" name="Isin" value="">
        </div> -->
        <hr />
        <div class="form-group">
        <label for="Ticker">Ticker:</label>
        <input type="text" id="Ticker" name="Ticker" value="<?php  echo $Ticker; ?>">
        </div>
        <hr />
        <div class="form-group">
            <label for="Region">Region:</label>
            <select id="region" id="Region" name="Region" value="<?php  echo $Region; ?>" >
                <option value="">-- Select a Region --</option>
                <option value="North America">North America</option>
                <option value="Europe">Europe</option>
                <option value="Asia">Asia</option>
                <option value="Latin America">Latin America</option>
                <option value="Middle East">Middle East</option>
                <option value="Africa">Africa</option>
            </select>
        </div>
        <hr />
        <div class="form-group">
            <label for="Country">Country:</label>
            <select id="country" name="Country" value="<?php  echo $Country; ?>" >>
                <option value="">-- Select a Country --</option>
                <option value="United States">United States</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Algeria">Algeria</option>
                <option value="Argentina">Argentina</option>
                <option value="China">China</option>
                <option value="Ghana">Ghana</option>
            </select>
        </div>

        <?php
        if ( !empty ($successMessage) ) {
        echo "
        <div><strong>$successMessage</strong></div>
        ";
        }
        ?>

        <button type="submit"><a href="">Submit</a> </button>
        <!-- <button type="submit"><a href="/wealth-affairs/fa/index.php">Submit</a></button> -->
    </form>
  </div>
</body>
</html>