// tabs
const openTabContent = (e, tabName) => {
    let index, tabContent, tablinks;
    tabContent = document.getElementsByClassName('tab__content');
    // iterate over each tab content and set display to none
    for (index = 0; index < tabContent.length; index++){
        tabContent[index].style.display = "none";
    }
    // iterate over each tablink and remove default styling
    tablinks = document.getElementsByClassName('tablink');
    for (index = 0; index < tabContent.length; index++){
        tablinks[index].className = tablinks[index].className.replace(" active", "")
    }
    document.getElementById(tabName).style.display = "block";
    e.currentTarget.className += " active";    // Adds style to each tab click
}

// Get the modal
const modal = document.getElementById("myModal");

// Get the view product button that opens the modal
const btn = document.getElementById("product-view");

// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

// When the user clicks the view product button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// document.getElementById('product-view').addEventListener("click", () => {
//   document.getElementById("myModal").style.display = "block";
// })

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }

// Reusable created investment products
class CreatedInvestmentCards extends HTMLElement {
  connectedCallback(){
    this.innerHTML = `
      <div class="card">
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
      </div>
    `
  }
}
customElements.define('created-investment-cards', CreatedInvestmentCards);

// Resuable BasicSecurity components
class BasicSecurity extends HTMLElement {
  connectedCallback(){
    this.innerHTML = `
      <div class="multi-select">
        <button class="toggle-dropdown">Basic Instrument Products</button>
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
      </div>
    `;
  }
}
customElements.define('basic-security-products', BasicSecurity)

// Checkbox basic instrument preferences
const toggleDropdown = document.querySelector('.toggle-dropdown');
const dropdown = document.querySelector('.dropdown');

toggleDropdown.addEventListener('click', function() {
  dropdown.classList.toggle('show');
});

// checkbox derivatives products
const toggleDerivativesProducts = document.querySelector(".toggle-dp");
const dropdownDerivativesProducts = document.querySelector(".dropdown-dp");

toggleDerivativesProducts.addEventListener('click', function(){
  dropdownDerivativesProducts.classList.toggle("show");
})

  // Get value on checkbox toggle
const checkboxes = document.querySelectorAll('.options input[type="checkbox"]');
for (let i = 0; i < checkboxes.length; i++){
  checkboxes[i].addEventListener('change', function() {
    let selectedValues = [];
    for (let j = 0; j < checkboxes.length; j++){
      if (checkboxes[j].checked){
        selectedValues.push(checkboxes[j].value);
      }
    }
    console.log(selectedValues);
  })
}


const ideass = [
  {
      id: 1,
      dateCreated: '12/12/2022',
      instrumentName: 'Amazon.com, Inc',
      assetType: 'Derivatives',
      price: 1,
      currency: 'USD',
      stock: 127.72,
      closingDate: '01/05/2023',
      riskLevel: 1,
      riskLevelBrief: 'Suitable for very conservative investors',
      riskLevelDescription: 'Investors who hope to experience minimal fluctuations in portfolio value over a rolling one year period and are generally only willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) at a price close to the recently observed market value.',
      status: 'pending'
  },
  {
      id: 2,
      dateCreated: '1/12/2022',
      instrumentName: 'AWS NOX',
      assetType: 'Equities',
      price: 2,
      currency: 'USD',
      stock: 120,
      closingDate: '01/05/2023',
      riskLevel: 5,
      riskLevelBrief: 'Suitable for very aggressive investors',
      riskLevelDescription: 'Investors who are prepared to accept large portfolio losses up to the value of their entire portfolio over a one year period and are generally willing to buy investments or enter into contracts that may be difficult to sell or close for an extended period or have an uncertain realizable value at any given time.',
      status: 'created'
  },
  {
      id: 003,
      dateCreated: '11/12/2022',
      instrumentName: 'Apple',
      assetType: 'Bonds',
      price: 20,
      currency: 'G BP',
      stock: 10,
      closingDate: '21/05/2023',
      riskLevel: 2,
      riskLevelBrief: 'Suitable for conservative investors',
      riskLevelDescription: 'Investors who hope to experience no more than small portfolio losses over a rolling one-year period and are generally only willing to buy investments that are priced frequently and have a high certainty of being able to sell quickly (less than a week) although the investor may at times buy individual investments that entail greater risk.',
      status: 'created'
  },
]

fetch('http://localhost/wealth-affairs/backend/getIdeas.php')
  .then(response => response.json())
  .then(ideas => {
    // do something with the data
    // Define IdeasTable
class IdeasTable extends HTMLElement {
  connectedCallback(){
    const modal = document.createElement('div');
    modal.className = "modal";
    modal.innerHTML = `
      <div class="modal-content product-details">
        <span class="close">&times;</span>
        <div class="idea-modal-content"></div>
      </div>
    `;
    document.body.appendChild(modal);

    const modalContent = modal.querySelector('.idea-modal-content');
    const closeModal = modal.querySelector('.close');
    closeModal.onclick = function(){
      modal.style.display = 'none';
    };

    this.innerHTML =
        `
            <div id="" class="b__content" style="display: non;">
                <table>
                    <tr>
                        <th>Date Created</th>
                        <th>Instrument Name</th>
                        <th>Asset Type (Basic Securities)</th>
                        <th>Asset Type (Derivatives)</th>
                        <th>Offer</th>
                        <th>Price Closing Date</th>
                        <th>Risk level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    ${ideas.map(idea => (
                        `<tr>
                            <td>${idea.IdeaID}</td>
                            <td>${idea.InstrumentName}</td>
                            <td>${idea.BasicSecurities != '' ? idea.BasicSecurities : 'Not Applicable'}</td>
                            <td>${idea.Derivatives != '' ? idea.Derivatives : 'Not Applicable'}</td>
                            <td>${idea.PriceCurrency} ${idea.ClosingPrice} per ${idea.Denomination} units</td>
                            <td>${idea.PriceClosingDate}</td>
                            <td>${idea.RiskLevel}</td>
                            <td>${idea.Status}</td>
                            <td><button class="view-idea" data-id="${idea.IdeaID}" onclick="viewIdea()">View Idea</button></td>
                        </tr>`
                    ))
                    .join('')
                }
                </table>
            </div>
        `;
    
    const viewIdeaButton = this.querySelectorAll('.view-idea');
    console.log(viewIdeaButton);
    viewIdeaButton.forEach(eachIdea => {
      eachIdea.onclick = function(){
        const ideaId = eachIdea.dataset.id;
        console.log(ideaId);
        // console.log(ideas);
        const targetIdea = ideas.find(idea => idea.IdeaID == ideaId);
        console.log(targetIdea);
        
        modalContent.innerHTML = `
          <div class="product-details-r1" style="display: fle;">
            <div class="product-creation">
              <h1>Investment Ideas Upload</h1>
              <form action="http://localhost/wealth-affairs/backend/products.php" method="post">
                <div class="form-group">
                  <label for="instrument-name">Instrument Name:</label>
                  <input type="text" id="InstrumentName" name="InstrumentName" value='${targetIdea.InstrumentName}' >
                </div>
                <div class="form-group">
                  <label for="instrument-dn">Instrument-Dn:</label>
                  <input type="text" id="InstrumentDn" name="InstrumentDn" value='${targetIdea.InstrumentDn}' >
                </div>
                <div class="form-group">
                  <label for="basic instrument">Basic Instrument:</label>
                  <select id="basic instrument" name="BasicSecurities">
                    <option value="" disabled ${targetIdea.BasicSecurities == '' || targetIdea.BasicSecurities == null ? 'selected' : ''}>-- Select an Instrument --</option>
                    <option value="Stocks" ${targetIdea.BasicSecurities == 'Stocks' ? 'selected' : ''}>Stocks</option>
                    <option value="Bonds" ${targetIdea.BasicSecurities == 'Bonds' ? 'selected' : ''}>Bonds</option>
                    <option value="ETFs" ${targetIdea.BasicSecurities == 'ETFs' ? 'selected' : ''}>ETFs</option>
                    <option value="Mutual Funds" ${targetIdea.BasicSecurities == 'Mutual Funds' ? 'selected' : ''}>Mutual Funds</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="derivative">Derivatives:</label>
                  <select id="derivative" name="Derivatives">
                    <option value="" disabled ${targetIdea.Derivatives == '' || targetIdea.Derivative == null ? 'selected' : ''}>-- Select a Derivative --</option>
                    <option value="Security Derivatives" ${targetIdea.Derivatives == 'Security Derivatives' ? 'selected' : ''}>Security Derivatives</option>
                    <option value="FX and Money Market" ${targetIdea.Derivatives == 'FX and Money Market' ? 'selected' : ''}>FX and Money Market</option>
                    <option value="Credit Derivatives" ${targetIdea.Derivatives == 'Credit Derivatives' ? 'selected' : ''}>Credit Derivatives</option>
                    <option value="Insurance Derivatives" ${targetIdea.Derivatives == 'Insurance Derivatives' ? 'selected' : ''}>Insurance Derivatives</option>
                </select>
                </div>
                <div class="form-group">
                  <label for="industry">Industry:</label>
                  <select id="industry" name="Industry">
                    <option value="" disabled ${targetIdea.Industry == '' ? 'selected' : ''}>-- Select an Industry --</option>
                    <option value="Technology" ${targetIdea.Industry == 'Technology' ? 'selected' : ''}>Technology</option>
                    <option value="Finance" ${targetIdea.Industry == 'Finance' ? 'selected' : ''}>Finance</option>
                    <option value="Renewable Energy" ${targetIdea.Industry == 'Renewable Energy' ? 'selected' : ''}>Renewable Energy</option>
                    <option value="Healthcare" ${targetIdea.Industry == 'Healthcare' ? 'selected' : ''}>Healthcare</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="risk-level">Risk Level:</label>
                  <select id= "risk-level" name="RiskLevel">
                    <option value="" disabled ${targetIdea.RiskLevel == '' ? 'selected' : ''}>-- Select a Risk Level --</option>
                    <option value="1" ${targetIdea.RiskLevel == '1' ? 'selected' : ''}>1</option>
                    <option value="2" ${targetIdea.RiskLevel == '2' ? 'selected' : ''}>2</option>
                    <option value="3" ${targetIdea.RiskLevel == '3' ? 'selected' : ''}>3</option>
                    <option value="4" ${targetIdea.RiskLevel == '4' ? 'selected' : ''}>4</option>
                    <option value="5" ${targetIdea.RiskLevel == '5' ? 'selected' : ''}>5</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="denomination">Denomination:</label>
                  <input type="text" id="denomination" name="Denomination" value='${targetIdea.Denomination}'>
                </div>
                <div class="form-group">
                  <label for="priceCurrency">Price Currency:</label>
                  <input type="text" id="priceCurrency" name="PriceCurrency" value='${targetIdea.PriceCurrency}' >
                </div>
                <div class="form-group">
                  <label for="closingPrice">Closing Price:</label>
                  <input type="text" id="closingPrice" name="ClosingPrice" value='${targetIdea.ClosingPrice}' >
                </div>
                <div class="form-group">
                  <label for="stockExchange">Stock Exchange:</label>
                  <input type="text" id="stockExchange" name="StockExchange" value='${targetIdea.StockExchange}' >
                </div>
                <div class="form-group">
                  <label for="issuer">Issuer:</label>
                  <input type="text" id="issuer" name="Issuer" value='${targetIdea.Issuer}' >
                </div>
                <div class="form-group">
                  <label for="isin">ISIN:</label>
                  <input type="text" id="isin" name="Isin" value='${targetIdea.Isin}' >
                </div>
                <div class="form-group">
                  <label for="ticker">Ticker:</label>
                  <input type="text" id="ticker" name="Ticker" value='${targetIdea.Ticker}' >
                </div>
                <div class ="form-group">
                <label for="region">Region:</label>
                <select id="region" name="Region">
                  <option value="" disabled ${targetIdea.Region == '' ? 'selected' : ''}>-- Select a Region --</option>
                  <option value="North America" ${targetIdea.Region == 'North America' ? 'selected' : ''}>North America</option>
                  <option value="South America" ${targetIdea.Region == 'South America' ? 'selected' : ''}>South America</option>
                  <option value="Europe" ${targetIdea.Region == 'Europe' ? 'selected' : ''}>Europe</option>
                  <option value="Asia" ${targetIdea.Region == 'Asia' ? 'selected' : ''}>Asia</option>
                  <option value="Africa" ${targetIdea.Region == 'Africa' ? 'selected' : ''}>Africa</option>
                  <option value="Oceania" ${targetIdea.Region == 'Oceania' ? 'selected' : ''}>Oceania</option>
                </select>
                <div class="form-group">
                  <label for="country">Country:</label>
                  <select id="country" name="Country">
                    <option value="" disabled  ${targetIdea.Country == '' ? 'selected' : ''}>-- Select a Country --</option>
                    <option value="United States" ${targetIdea.Country == 'United States' && 'selected'}>United States</option>
                    <option value="Nigeria" ${targetIdea.Country == 'Nigeria' && 'selected'}>Nigeria</option>
                    <option value="Algeria" ${targetIdea.Country == 'Algeria' && 'selected'}>Algeria</option>
                    <option value="Argentina" ${targetIdea.Country == 'Argentina' && 'selected'}>Argentina</option>
                    <option value="China" ${targetIdea.Country == 'China' && 'selected'}>China</option>
                    <option value="Albania" ${targetIdea.Country == 'Albania' && 'selected'}>Albania</option>
                    <option value="Australia" ${targetIdea.Country == 'Australia' && 'selected'}>Australia</option>
                    <option value="Austria" ${targetIdea.Country == 'Austria' && 'selected'}>Austria</option>
                    <option value="Belgium" ${targetIdea.Country == 'Belgium' && 'selected'}>Belgium</option>
                    <option value="Brazil" ${targetIdea.Country == 'Brazil' && 'selected'}>Brazil</option>
                    <option value="Canada" ${targetIdea.Country == 'Canada' && 'selected'}>Canada</option>
                    <option value="France" ${targetIdea.Country == 'France' && 'selected'}>France</option>
                    <option value="Germany" ${targetIdea.Country == 'Germany' && 'selected'}>Germany</option>
                    <option value="Greece" ${targetIdea.Country == 'Greece' && 'selected'}>Greece</option>
                    <option value="India" ${targetIdea.Country == 'India' && 'selected'}>India</option>
                    <option value="Indonesia" ${targetIdea.Country == 'Indonesia' && 'selected'}>Indonesia</option>
                    <option value="Italy" ${targetIdea.Country == 'Italy' && 'selected'}>Italy</option>
                    <option value="Japan" ${targetIdea.Country == 'Japan' && 'selected'}>Japan</option>
                    <option value="Mexico" ${targetIdea.Country == 'Mexico' && 'selected'}>Mexico</option>
                    <option value="Russia" ${targetIdea.Country == 'Russia' && 'selected'}>Russia</option>
                    <option value="South Africa" ${targetIdea.Country == 'South Africa' && 'selected'}>South Africa</option>
                    <option value="Spain" ${targetIdea.Country == 'Spain' && 'selected'}>Spain</option>
                    <option value="Switzerland" ${targetIdea.Country == 'Switzerland' && 'selected'}>Switzerland</option>
                    <option value="United Kingdom" ${targetIdea.Country == 'United Kingdom' && 'selected'}>United Kingdom</option>
                    <option value="Ghana" ${targetIdea.Country == 'Ghana' && 'selected'}>Ghana</option>
                  </select>
                </div>
                <button type="submit">Submit</button>
              </form>
            </div>




            <div class="product-details-tag" style="display: flex;">
                <div class="product-details-logo"><p>${targetIdea.InstrumentDn}</p></div>
                <p class="product-details-name">${targetIdea.InstrumentName}</p>
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
                </div>
                <!-- <basic-security-products></basic-security-products> -->
                <div class="multi-select">
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
          </div>
          <div class="product-details-r2 " style="display: flex;">
              <div class="product-details-stock-info" style="border: 1px solid black;">
                  <p class="product-details-stock">Stock Exchange: <span id="stock">NYSE</span></p>
                  <p class="product-details-issuer">Issuer: <span id="issuer">International Business Machines Corporation</span></p>
                  <div class="product-details-codes">
                      <p>ISIN: <span id="isin">N/A</span></p>
                      <p>Ticker: <span id="ticker">IBM</span></p>
                  </div>
              </div>
              <div class="product-details-risk" style="display: flex;">
                  <p id="risk-rating">${targetIdea.RiskLevel}</p>
                  <p id="risk-brief">${targetIdea.RiskLevelBrief}</p>
                  <p id="risk-description">${targetIdea.RiskLevelDescription}</p>
              </div>
          </div>
          <div class="product-details-r3" style="display: flex;">
              <div class="product-details-preferences-2">
                      <!-- Industry -->
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
                  <button id="reject-idea">Reject Idea</button>
                  <button id="filter-client">Suggested to Clients (2)</button>
                  <button id="rec-to-client"">Recommend to Clients</button>
              </div>
          </div>
        `;
        modal.style.display = 'block';

        const a = document.querySelector("#rec-to-client");
        a.onclick = function(){
          alert(`${targetIdea.instrumentName} has been recommended to interested clients`);
          window.location.href = "/rm/index.html";
        };

        const selectRisk = document.getElementById('risk-level');
        selectRisk.onchange = function(){
          console.log("Risk:" + selectRisk.value)
        }
        
      };
    })
  };
};
customElements.define('ideas-pro', IdeasTable);





})
.catch(error => console.error(error));


// ${ideas.map(idea => (
//   `<tr>
//       <td>${idea.dateCreated}</td>
//       <td>${idea.instrumentName}</td>
//       <td>${idea.assetType}</td>
//       <td>${idea.price} ${idea.currency} per ${idea.stock} stocks</td>
//       <td>${idea.closingDate}</td>
//       <td>${idea.riskLevel}</td>
//       <td>${idea.status}</td>
//       <td><button class="view-idea" data-id="${idea.id}" onclick="viewIdea()">View Idea</button></td>
//   </tr>`
// ))
// .join('')
// }