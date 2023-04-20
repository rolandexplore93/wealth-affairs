<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style3.css">
    <title>Wealth Affairs - Create Idea</title>
</head>
<?php 
// // checks if user is logged in or not by checking if the 'FaID' session variable is set
session_start();
if ( !isset($_SESSION['FaID'] )){
    header('Location: http://localhost/wealth_affairs/auth/login.html');
    exit();
}
?>
<body>
    <?php
        $InstrumentName ="";
        $InstrumentDn ="";
        $IdeaDescription ="";
        $ProductType ="";
        $Industry ="";
        $RiskLevel ="";
        $Denomination ="";
        $PriceCurrency ="";
        $ClosingPrice = "";
        $PriceClosingDate ="";
        $StockExchange = "";
        $Issuer ="";
        $Ticker ="";
        $Region ="";
        $Country ="";
        $RiskLevelBrief = "";
        $RiskLevelDescription = "";
        $IssueDate ="";
        $FaID ="";
        $MaturityDate ="";

        $errorMessage = "";
        $successMessage = "";
    ?>

    <h2><a href="http://localhost/wealth_affairs/fa/index.php">Back to Homepage</a></h2>
    <div class="container">
        <h1>Investment Ideas Upload</h1>
        <?php
        if ( !empty($errorMessage) ) {
            echo "<div><strong>$errorMessage</strong></div>";
        }
        ?>

        <form action="http://localhost/wealth_affairs/fa/backend/ideas.php" method="POST">
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
            <label for="ProductType">ProductType:</label>
            <select id="ProductType" name="ProductType" value="<?php echo $ProductType; ?>"  >>
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
                <label for="industry">Industry:</label>
                <select id="industry" name="Industry">
                <option value="">-- Select an Industry --</option>
                <!-- <option value="Technology">Technology</option>
                <option value="Finance">Finance</option>
                <option value="Renewable Energy">Renewable Energy</option>
                <option value="Healthcare">Healthcare</option> -->
                <option value="Energy">Energy</option>
                <option value="Chemicals">Chemicals</option>
                <option value="Industrial Goods">Industrial Goods</option>
                <option value="Automobiles & Auto Parts">Automobiles & Auto Parts</option>
                <option value="Food & Beverages">Food & Beverages</option>
                <option value="Banking & Investment Services">Banking & Investment Services</option>
                <option value="Healthcare Services">Healthcare Services</option>
                <option value="Technology Equipment">Technology Equipment</option>
                <option value="Telecommunication">Telecommunication</option>
                <option value="Utilities">Utilities</option>

                </select>
            </div>
            <hr />
            <div class="form-group">
                <label for="RiskLevel">RiskLevel:</label>
                <select id= "RiskLevel" name="RiskLevel" value="<?php  echo $RiskLevel; ?>"  >>
                    <option value="">-- Select a Risk Level --</option>
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
            <label for="PriceCurrency">PriceCurrency:</label>
            <input type="text" id="PriceCurrency" name="PriceCurrency" value="<?php  echo $PriceCurrency; ?>" >
            </div>
            <hr />
            <div class="form-group">
            <label for="Closing Price">ClosingPrice:</label>
            <input type="text" id="Closing Price" name="ClosingPrice" value="<?php  echo $ClosingPrice; ?>">
            </div>
            <hr />
            <div class="form-group">
            <label for="PriceClosingDate">PriceClosingDate:</label>
            <input type="date" id="PriceClosingDate" name="PriceClosingDate" value="<?php  echo $PriceClosingDate; ?>" >
            </div>
            <hr />
            <div class="form-group">
            <label for="StockExchange">StockExchange:</label>
            <input type="text" id="StockExchange" name="StockExchange" value="<?php  echo $StockExchange; ?>" >
            </div>
            <hr />
            <div class="form-group">
            <label for="Issuer">Issuer:</label>
            <input type="text" id="Issuer" name="Issuer" value="<?php  echo $Issuer; ?>"  >
            </div>
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
                    <option value="South America">South America</option>
                    <option value="Europe">Europe</option>
                    <option value="Asia">Asia</option>
                    <option value="Africa">Africa</option>
                    <option value="Oceania">Oceania</option>
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
                    <option value="Albania">Albania</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Brazil">Brazil</option>
                    <option value="Canada">Canada</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                    <option value="Greece">Greece</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Italy">Italy</option>
                    <option value="Japan">Japan</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Russia">Russia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Spain">Spain</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Ghana">Ghana</option>
                </select>
            </div>
            <div class="form-group">
            <label for="IssueDate">IssueDate:</label>
            <input type="date" id="IssueDate" name="IssueDate" value="<?php  echo $IssueDate; ?>" >
            </div>
            <hr />
            <div class="form-group">
            <label for="MaturityDate">MaturityDate:</label>
            <input type="date" id="MaturityDate" name="MaturityDate" value="<?php  echo $MaturityDate; ?>" >
            </div>
            <hr />

            <?php
            // checks whether the variable $successMessage is not empty
            if ( !empty ($successMessage) ) {
            echo "
            <div><strong>$successMessage</strong></div>
            ";
            }
            ?>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>