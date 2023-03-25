

// document.addEventListener('DOMContentLoaded', function() {
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
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// document.getElementById('product-view').addEventListener("click", () => {
//   document.getElementById("myModal").style.display = "block";
// })

// When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
// function myFunction() {
//   alert('Button Clicked!');
//   console.log("Working")
// }

// document.addEventListener('DOMContentLoaded', function() {
  document.addEventListener('DOMContentLoaded', function() {
fetch('http://localhost/wealth-affairs/backend/getProducts.php')
  .then(response => response.json())
  .then(products => {
    console.log(products)
    // Reusable created investment products
    class CreatedInvestmentCards extends HTMLElement {
      connectedCallback(){
        this.innerHTML = `
          ${products.map((product) => (
              `
                <div class="card">
                  <div class="product-title">
                    <p class="product-symbol">${product.InstrumentDn}</p>
                    <p class="product-name">${product.InstrumentName}</p>
                  </div>
                  <div class="product-type">
                    <p class="product-cat">${product.ProductType}</p>
                    <p class="product-risklevel">Risk Level: ${product.RiskLevel}</p>
                  </div>
                  <div class="product-stock">
                    <p class="product-stock-title">Stock Exchange:</p>
                    <p class="product-stock-category">${product.StockExchange}</p>
                  </div>
                  <div class="product-deal">
                    <p class="product-offer">Offer: ${product.PriceCurrency} ${product.ClosingPrice} per ${product.Denomination} units </p>
                  </div>
                  <button class="product-view" data-id="${product.ProductID}" id="product-view" style="cursor: pointer;">View product</button>
                </div>
              `
            )).join('')
          };
        `;

        const modal = document.createElement('div');
        modal.className = "modal";
        modal.id = "mm";
        modal.innerHTML = `
          <div class="modal-content product-details">
            <span class="close">&times;</span>
            <div class="product-cards" style="isplay: flex"></div>
          </div>
        `;
        document.body.appendChild(modal);
        const content1 = modal.querySelector('.product-cards');
        const closeModal = modal.querySelector('.close');
        closeModal.onclick = function(){
          modal.style.display = 'none';
        };

        const viewProductButton = this.querySelectorAll('.product-view');
        viewProductButton.forEach((eachProduct) => {
          eachProduct.onclick = function(){
            const productId = eachProduct.dataset.id;
            console.log(productId);
            const targetProduct = products.find(product => product.ProductID === productId);
            console.log(targetProduct);

            content1.innerHTML = `
              <div class="product-details-r1" style="display: flex;">
                <div class="product-details-tag" style="display: flex;">
                    <div class="product-details-logo"><p>${targetProduct.InstrumentDn}</p></div>
                    <p class="product-details-name">${targetProduct.InstrumentName}</p>
                </div>
                <div class="product-details-preferences">
                    <div class="multi-select">
                      <p>${targetProduct.ProductType}</p>
                    </div>
                </div>
                <div class="product-details-offer">
                  <p>Offer: ${targetProduct.PriceCurrency} ${targetProduct.ClosingPrice} per ${targetProduct.Denomination} units</p>
                </div>
              </div>

              <div class="product-details-r2 " style="display: flex;">
                <div class="product-details-stock-info" style="border: 1px solid black;">
                    <p class="product-details-stock">Stock Exchange: <span id="stock">${targetProduct.StockExchange}</span></p>
                    <p class="product-details-issuer">Issuer: <span id="issuer">${targetProduct.Issuer}</span></p>
                    <div class="product-details-codes">
                        <p>ISIN: <span id="isin">${targetProduct.Isin}</span></p>
                        <p>Ticker: <span id="ticker">${targetProduct.Ticker}</span></p>
                    </div>
                </div>
                <div class="product-details-risk" style="display: flex;">
                    <p id="risk-rating">Risk level: ${targetProduct.RiskLevel}</p>
                    <p id="risk-brief">${targetProduct.RiskLevelBrief}</p>
                    <p id="risk-description">${targetProduct.RiskLevelDescription}</p>
                </div>
              </div>

              <div class="product-details-r3" style="display: flex;">
                <div class="product-details-preferences-2">
                  <p class="industry-cat" style="display: fle;">Industry: ${targetProduct.Industry}</p>
                  <p class="industry-cat" style="display: fle;">Country: ${targetProduct.Country}</p>
                  <p class="industry-cat" style="display: fle;">Region: ${targetProduct.Region}</p>
                </div>
                <div class="product-details-recom" style="display: flex;">
                  <button id="filter-client">Matched Clients (2)</button>
                  <button id="rec-to-client" onclick="myFunction()">Recommend to Clients</button>
                </div>
              </div>
            `;
            modal.style.display = 'block';
            
            function myFunction() {
              // alert('Button Clicked!');
              // console.log(`Working: ${targetProduct.Industry}`);

              const productData = {
                productID: targetProduct.ProductID,
                riskLevel: targetProduct.RiskLevel,
                productType: targetProduct.ProductType,
                industry: targetProduct.Industry,
                country: targetProduct.Country,
                region: targetProduct.Region
              };

              console.log("Product Data:", productData)
            
              //  Call the API backend/matchClients.php
              fetch('http://localhost/wealth-affairs/backend/matchClients.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(productData)
              })
              .then(response => response.text())
              // .then(data => console.log(data))
              // .catch(error => console.error(error));
              // .then(response => response.json())
              .then(data => {
                console.log(data);
              })
              .catch(error => {
                console.log('Error:', error)
              })
            }
            
            myFunction();

          }
        })
      };
    };
    customElements.define('created-investment-cards', CreatedInvestmentCards);
  })
  .catch(error => console.error(error));
  // })
})

// function myFunction() {
//   alert('Button Clicked!');
//   console.log(`Working: ${targetProduct.Country}`);
// }

  //  fetch('http://localhost/wealth-affairs/backend/matchClients.php')
  //  .then(response => response.json())
  //  .then(clients => {
  //    const filterClientButton = document.getElementById('filter-client');
  //    filterClientButton.innerHTML = `Matched Clients (${clients.length})`;
  //  })
  //  .catch(error => console.error(error));
// }

fetch('http://localhost/wealth-affairs/backend/getIdeas.php')
  .then(response => response.json())
  .then(ideas => {
    // Define IdeasTable to display the ideas generated by FA
    // console.log(ideas)
  class IdeasTable extends HTMLElement {
    connectedCallback(){
      this.innerHTML =
          `
              <div id="" class="b__content" style="display: non;">
                  <table>
                      <tr>
                          <th>Idea ID</th>
                          <th>Instrument Name</th>
                          <th>Product Type</th>
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
                              <td>${idea.ProductType != '' ? idea.ProductType : 'Not Applicable'}</td>
                              <td>${idea.PriceCurrency} ${idea.ClosingPrice} per ${idea.Denomination} units</td>
                              <td>${idea.PriceClosingDate}</td>
                              <td>${idea.RiskLevel}</td>
                              <td>${idea.Status}</td>
                              <td><button ${idea.Status == '' || idea.Status == 'Pending' ? '' : 'disabled'} class="view-idea" data-id="${idea.IdeaID}" onclick="viewIdea()">${idea.Status == 'Approved' ? 'Decided' : 'View Idea'}</button></td>
                          </tr>`
                      ))
                      .join('')
                  }
                  </table>
              </div>
          `;

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
                  <input type="hidden" name="IdeaID" value="${targetIdea.IdeaID}" >
                  <input type="hidden" name="RmID" value="1" >
                  <div class="form-group">
                    <label for="instrument-name">Instrument Name:</label>
                    <input type="text" id="InstrumentName" name="InstrumentName" value='${targetIdea.InstrumentName}' >
                  </div>
                  <div class="form-group">
                    <label for="instrument-dn">Instrument-Dn:</label>
                    <input type="text" id="InstrumentDn" name="InstrumentDn" value='${targetIdea.InstrumentDn}' >
                  </div>
                  <div class="form-group">
                    <label for="product type">Product Type:</label>
                    <select id="product type" name="ProductType">
                      <option value="" disabled ${targetIdea.ProductType == '' ? 'selected' : ''}>-- Select an Instrument --</option>
                      <option value="Stocks" ${targetIdea.ProductType == 'Stocks' ? 'selected' : ''}>Stocks</option>
                      <option value="Bonds" ${targetIdea.ProductType == 'Bonds' ? 'selected' : ''}>Bonds</option>
                      <option value="ETFs" ${targetIdea.ProductType == 'ETFs' ? 'selected' : ''}>ETFs</option>
                      <option value="Mutual Funds" ${targetIdea.ProductType == 'Mutual Funds' ? 'selected' : ''}>Mutual Funds</option>
                      <option value="Security Derivatives" ${targetIdea.ProductType == 'Security Derivatives' ? 'selected' : ''}>Security Derivatives</option>
                      <option value="FX and Money Market" ${targetIdea.ProductType == 'FX and Money Market' ? 'selected' : ''}>FX and Money Market</option>
                      <option value="Credit Derivatives" ${targetIdea.ProductType == 'Credit Derivatives' ? 'selected' : ''}>Credit Derivatives</option>
                      <option value="Insurance Derivatives" ${targetIdea.ProductType == 'Insurance Derivatives' ? 'selected' : ''}>Insurance Derivatives</option>
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
                    <label for="PriceClosingDate">Price Closing Date:</label>
                    <input type="date" id="PriceClosingDate" name="PriceClosingDate" value='${targetIdea.PriceClosingDate}' >
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
                      <option value="United States" ${targetIdea.Country == 'United States' ? 'selected' : ''}>United States</option>
                      <option value="Nigeria" ${targetIdea.Country == 'Nigeria' ? 'selected' : ''}>Nigeria</option>
                      <option value="Algeria" ${targetIdea.Country == 'Algeria' ? 'selected' : ''}>Algeria</option>
                      <option value="Argentina" ${targetIdea.Country == 'Argentina' ? 'selected' : ''}>Argentina</option>
                      <option value="China" ${targetIdea.Country == 'China' ? 'selected' : ''}>China</option>
                      <option value="Albania" ${targetIdea.Country == 'Albania' ? 'selected' : ''}>Albania</option>
                      <option value="Australia" ${targetIdea.Country == 'Australia' ? 'selected' : ''}>Australia</option>
                      <option value="Austria" ${targetIdea.Country == 'Austria' ? 'selected' : ''}>Austria</option>
                      <option value="Belgium" ${targetIdea.Country == 'Belgium' ? 'selected' : ''}>Belgium</option>
                      <option value="Brazil" ${targetIdea.Country == 'Brazil' ? 'selected' : ''}>Brazil</option>
                      <option value="Canada" ${targetIdea.Country == 'Canada' ? 'selected' : ''}>Canada</option>
                      <option value="France" ${targetIdea.Country == 'France' ? 'selected' : ''}>France</option>
                      <option value="Germany" ${targetIdea.Country == 'Germany' ? 'selected' : ''}>Germany</option>
                      <option value="Greece" ${targetIdea.Country == 'Greece' ? 'selected' : ''}>Greece</option>
                      <option value="India" ${targetIdea.Country == 'India' ? 'selected' : ''}>India</option>
                      <option value="Indonesia" ${targetIdea.Country == 'Indonesia' ? 'selected' : ''}>Indonesia</option>
                      <option value="Italy" ${targetIdea.Country == 'Italy' ? 'selected' : ''}>Italy</option>
                      <option value="Japan" ${targetIdea.Country == 'Japan' ? 'selected' : ''}>Japan</option>
                      <option value="Mexico" ${targetIdea.Country == 'Mexico' ? 'selected' : ''}>Mexico</option>
                      <option value="Russia" ${targetIdea.Country == 'Russia' ? 'selected' : ''}>Russia</option>
                      <option value="South Africa" ${targetIdea.Country == 'South Africa' ? 'selected' : ''}>South Africa</option>
                      <option value="Spain" ${targetIdea.Country == 'Spain' ? 'selected' : ''}>Spain</option>
                      <option value="Switzerland" ${targetIdea.Country == 'Switzerland' ? 'selected' : ''}>Switzerland</option>
                      <option value="United Kingdom" ${targetIdea.Country == 'United Kingdom' ? 'selected' : ''}>United Kingdom</option>
                      <option value="Ghana" ${targetIdea.Country == 'Ghana' ? 'selected' : ''}>Ghana</option>
                    </select>
                  </div>
                  <button type="submit">Submit</button>
                </form>
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




// });