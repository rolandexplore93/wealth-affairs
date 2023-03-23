// fetch('/Supporting-data-for-investment-idea-setup.csv')
//   .then(response => response.text())
//   .then(data => {
//     console.log(data);
//     const countries = data.split('\n');
//     // Remove the last empty row if necessary
//     if (countries[countries.length - 1] === '') {
//       countries.pop();
//     }
//     // Add the country names to the <select> element
//     const select = document.getElementById('country');
//     for (const country of countries) {
//       const option = document.createElement('option');
//       option.value = country;
//       option.textContent = country;
//       // select.appendChild(option);/
//     }
// });


// let productData;
// fetch('http://localhost/wealth-affairs/backend/product.php')
//   .then(response => response.json())
//   .then(data => {
//     // do something with the data
//   })
//   .catch(error => console.error(error));


// getProducts
// fetch('http://localhost/wealth-affairs/backend/getProducts.php')
//   .then(response => response.json())
//   .then(data => {
//     // do something with the data
//     console.log(data)
//   })
//   .catch(error => console.error(error));


  // const ideass = [
  //   {
  //       id: 1,
  //       dateCreated: '12/12/2022',
  //       instrumentName: 'Amazon.com, Inc',
  //       assetType: 'Derivatives',
  //       price: 1,
  //       currency: 'USD',
  //       stock: 127.72,
  //       closingDate: '01/05/2023',
  //       riskLevel: 1,
  //       riskLevelBrief: 'Suitable for very conservative investors',
  //       riskLevelDescription: 'Investors who hope to experience minimal fluctuations in portfolio value over a rolling one year period and are generally only willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) at a price close to the recently observed market value.',
  //       status: 'pending'
  //   },
  //   {
  //       id: 2,
  //       dateCreated: '1/12/2022',
  //       instrumentName: 'AWS NOX',
  //       assetType: 'Equities',
  //       price: 2,
  //       currency: 'USD',
  //       stock: 120,
  //       closingDate: '01/05/2023',
  //       riskLevel: 5,
  //       riskLevelBrief: 'Suitable for very aggressive investors',
  //       riskLevelDescription: 'Investors who are prepared to accept large portfolio losses up to the value of their entire portfolio over a one year period and are generally willing to buy investments or enter into contracts that may be difficult to sell or close for an extended period or have an uncertain realizable value at any given time.',
  //       status: 'created'
  //   },
  //   {
  //       id: 003,
  //       dateCreated: '11/12/2022',
  //       instrumentName: 'Apple',
  //       assetType: 'Bonds',
  //       price: 20,
  //       currency: 'G BP',
  //       stock: 10,
  //       closingDate: '21/05/2023',
  //       riskLevel: 2,
  //       riskLevelBrief: 'Suitable for conservative investors',
  //       riskLevelDescription: 'Investors who hope to experience no more than small portfolio losses over a rolling one-year period and are generally only willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) although the investor may at times buy individual investments that entail greater risk.',
  //       status: 'created'
  //   },
  // ]





  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="rm">
                <img class="photo" src="../images/relational-manager-photo.jfif" alt="rm-image" />
                <p class="name">Roland, O. O</p>
                <p class="title">Relational Manager</p>
            </div>
            <div class="">
                <p><a href="javascript:void(0)" onclick="expanded()">Dashboard</a></p>
                <p><a href="">Profile</a></p>
            </div>
            <div class="logout">
                <button>Logout</button>
                <p><a href="../index.html">Go to homepage</a></p>
            </div>
        </div>
        <!-- Page content -->
        <div class="main">
            <div class="summary">
                <h1>Investment Portal Dashboard</h1>  
                <div>Cards</div>
            </div>
            <div class="tabs">
                <div class="tablink " id="tab__products" onclick="openTabContent(event, 'products');">
                    <a href="javascript:void(0)" >All products</a>
                </div>
                <div class="tablink " id="tab__products" onclick="openTabContent(event, 'ideas');">
                    <a href="javascript:void(0)" >All Ideas</a>
                </div>
                <div class="tablink " id="tab__products" onclick="openTabContent(event, 'clients');">
                    <a href="javascript:void(0)" >All Clients</a>
                </div>
            </div>
            <!-- content display for all products -->
            <div id="products" class="tab__content" style="isplay: one;">
                <div class="searchbar">
                    <input type="text">
                    <button class="filter">Filter</button>
                    <button class="sort">Sort</button>
                </div>
                <div class="products">
                    <!-- <div class="card">
                        <div class="product-title">
                            <p class="product-symbol">IBM</p>
                            <p class="product-name">IBM Common Stock</p>
                        </div>
                        <div class="product-type">
                            <p class="product-cat">Basic Securities</p>
                            <p class="product-group">Equities</p>
                            <div>
                                <p>2</p>
                            </div>
                        </div>
                        <div class="product-stock">
                            <p class="product-stock-title">Stock Exchange:</p>
                            <p class="product-stock-category">NYSE</p>
                        </div>
                        <div class="product-deal">
                            <p class="product-offer">Offer: 127.57 stocks / 1 USD</p>
                        </div>
                        <button class="product-view" id="product-view" style="cursor: pointer;">View product</button>
                    </div> -->
                    <created-investment-cards class="cards"></created-investment-cards>
                    <!-- View product page -->
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content product-details">
                            <span class="close">&times;</span>
                            <!-- <div class="product-details-r1" style="display: flex;">
                                <div class="product-details-tag" style="display: flex;">
                                    <div class="product-details-logo"><p >IBM</p></div>
                                    <p class="product-details-name">IBM Common Stock</p>
                                </div>
                                <div class="product-details-preferences">
                                    <div class="multi-select">
                                        <div class="toggle-dropdown">
                                            <input type="checkbox" name="" id="">
                                            <span>Basic Instrument Products</span>
                                        </div>
                                        <div class="dropdown">
                                            <div class="options">
                                                <label><input type="checkbox" value="Bonds">Bonds</label>
                                                <label><input type="checkbox" value="Equities">Equities</label>
                                                <label><input type="checkbox" value="FX">FX</label>
                                                <label><input type="checkbox" value="Money Market">Money Market</label>
                                                <label><input type="checkbox" value="Loan">Loan</label>
                                                <label><input type="checkbox" value="Commodities">Commodities</label>
                                                <label><input type="checkbox" value="Index">Index</label>
                                                <label><input type="checkbox" value="Hedge Funds">FX</label>
                                                <label><input type="checkbox" value="Private Equity">Private Equity</label>
                                                <label><input type="checkbox" value="Insurance">Insurance</label>
                                                <label><input type="checkbox" value="Collective Investment">Collective Investment</label>
                                                <label><input type="checkbox" value="Digital Asset">Digital Asset</label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <basic-security-products></basic-security-products> -->
                                    <!-- <div class="multi-select">
                                        <button class="toggle-dp">Derivatives Products</button>
                                        <div class="dropdown-dp">
                                        <div class="options-dp options">
                                            <label><input type="checkbox" value="Security Derivatives">Security Derivatives</label>
                                            <label><input type="checkbox" value="FX and Money Market">FX and Money Market</label>
                                            <label><input type="checkbox" value="Credit Derivatives">Credit Derivatives</label>
                                            <label><input type="checkbox" value="Insurance Derivatives">Insurance Derivatives</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-details-offer">
                                    <p>Offer: <span id="stock-unit">127.57</span> stocks per <span id="stock-price">1</span> <span id="stock-currency">USD</span></p>
                                </div>
                            </div> -->
                            <!-- <div class="product-details-r2 " style="display: flex;">
                                <div class="product-details-stock-info" style="border: 1px solid black;">
                                    <p class="product-details-stock">Stock Exchange: <span id="stock">NYSE</span></p>
                                    <p class="product-details-issuer">Issuer: <span id="issuer">International Business Machines Corporation</span></p>
                                    <div class="product-details-codes">
                                        <p>ISIN: <span id="isin">N/A</span></p>
                                        <p>Ticker: <span id="ticker">IBM</span></p>
                                    </div>
                                </div>
                                <div class="product-details-risk" style="display: flex;">
                                    <p id="risk-rating">1</p>
                                    <p id="risk-brief">Suitable for very conservative investors</p>
                                    <p id="risk-description">Investors who hope to experience minimal fluctuations in portfolio value over a rolling one year period and are generally only willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) at a price close to the recently observed market value.</p>
                                </div>
                            </div> -->
                            <!-- <div class="product-details-r3" style="display: flex;">
                                <div class="product-details-preferences-2">
                                    <div class="industry-cat" style="display: fle;">
                                        <label for="select-industry">Domicile Product Industry:</label>
                                        <select name="industry" id="industry">
                                            <option value="" disabled selected>Select Industry</option>
                                            <option value="Energy">Energy</option>
                                            <option value="Basic Materials">Basic Materials</option>
                                            <option value="Industrials">Industrials</option>
                                            <option value="Consumer Cyclicals">Consumer Cyclicals</option>
                                            <option value="Consumer Non-cyclicals">Consumer Non-cyclicals</option>
                                            <option value="Financials">Financials</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Technology">Technology</option>
                                            <option value="Telecommunication Services">Telecommunication Services</option>
                                            <option value="Utilities">Utilities</option>
                                        </select>
                                    </div>
                                    <div class="industry-cat" style="display: fle;">
                                        <label for="select-industry">Domiciled Region:</label>
                                        <select name="industry" id="industry">
                                            <option value="" disabled selected>Select Region</option>
                                            <option value="Africa">Africa</option>
                                            <option value="Americas">Americas</option>
                                            <option value="Europe">Europe</option>
                                        </select>
                                    </div>
                                    <div class="industry-cat" style="display: fle;">
                                        <label for="select-industry">Trading Country:</label>
                                        <select name="industry" id="industry">
                                            <option value="" disabled selected>Select Country</option>
                                            <option value="Energy">Nigeria</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="India">India</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product-details-recom" style="display: flex;">
                                    <button id="filter-client">Suggested to Clients (2)</button>
                                    <button id="rec-to-client">Recommend to Clients</button>
                                </div>
                            </div> -->
                      
                        </div>
                    </div>
                </div>
                <div class="navigation">
                    <button>Previous</button> 1 <button>Next</button>
                </div>
            </div>
            <!-- content display for all ideas -->
            <div id="ideas" class="tab__content" style="display: none;">
                <ideas-pro></ideas-pro>
            </div>
            <!-- content display for all registered clients -->
            <div id="clients" class="tab__content" style="display: none;">
                <client-profile></client-profile>
            </div>
        </div>
    </div>





    <!-- Javascript files -->
    <script src="./script.js" type="text/javascript"></script>
    <script type="text/javascript" src="./clients/clients.js"></script>
    <script type="text/javascript" src="../data.js"></script>
    <!-- <script src="./products.js" type="text/javascript"></script> -->
    <!-- <script src="./ideas/ideas.js" type="text/javascript"></script> -->
</body>
</html>