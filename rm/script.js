// When in use, document.addEventListener('DOMContentLoaded', function() {} is to prevent javascript code from loading until html code has been completely loaded
// JavaScript TABS: The implementation of JavaScript tab on the RM page enables the RM portal 
// to be behave as a Single Page Application (SPA).
// With this, all the pages and activities associated with RM roles works 
// within this page (http://localhost/wealth_affairs/rm/index.php).

            
const openTabContent = (e, tabName) => {
    let index, tabContent, tablinks; // Define 3 variables
    // Get the 3 div elements where the content for each tab will be displayed
    tabContent = document.getElementsByClassName('tab__content'); 
    // iterate over each tab content and set display to none
    for (index = 0; index < tabContent.length; index++){
        tabContent[index].style.display = "none";
    }
    // Get the 3 main tablink and store it inside the tablinks variable
    // iterate over each tablink and replace the default styling
    tablinks = document.getElementsByClassName('tablink');
    for (index = 0; index < tabContent.length; index++){
        tablinks[index].className = tablinks[index].className.replace(" active", "")
    }
    document.getElementById(tabName).style.display = "block";
    console.log(tabName)
    e.currentTarget.className += " active";    // Adds style to each tab click
}

// Get the modal
const modal = document.getElementById("myModal");

// Get the view product button that opens the modal
const btn = document.getElementById("product-view");

// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

document.addEventListener('DOMContentLoaded', function() {
// Make an HTTP request to php backend API using JavaScript fetch to get the data of all approved idea from the approvedidea table.
// The raw data received is converted to a usable format by parsing it to a JavaScript object using json()
fetch('http://localhost/wealth_affairs/rm/backend/getApprovedIdeas.php') // an api call to get all approved ideas
  .then(response => response.json())
  .then(approvedIdeas => {
    console.log(approvedIdeas) // log the data to the console in frontend
    // Create a reusable Class that iterate over approved ideas and create custom HTML for each approved ideas
    class CreatedInvestmentCards extends HTMLElement {
      connectedCallback(){
        // If there is no approved ideas (products) accepted by the RM, a feedback of 'string' data type is returned. 
        // If there are approved ideas, an object containing array of approved ideas are returned
        if (typeof approvedIdeas == 'string'){
            this.innerHTML = `
            <div class="content">
                NO INVESTMENT IDEA APPROVED YET
            </div>
            `
        } else {
            // map() is a javascript function used to iterate over each client inside the client array of clients
          this.innerHTML = `
            ${approvedIdeas.map((product) => (
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
                    <button class="product-view" data-id="${product.ApprovedID}" id="product-view" style="cursor: pointer;">View product</button>
                  </div>
                `
              ))
              .join('')   // join('') is used to join the array of HTML elements as a single string with no separator, effectively concatenating the elements together. 
            }
          `;
          
          // Create a modal using the DOM to show the details of each approved idea when they are clicked
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

          // View each approved idea created
          const viewApprovedIdeaButton = this.querySelectorAll('.product-view');
          viewApprovedIdeaButton.forEach((eachInvIdea) => {
            // forEach() iterates over each approved idea details
            eachInvIdea.onclick = function(){
              // Each approved idea displayed on the browser has an id which is stored in the dataset on the browser DOM. 
              // On clicking a specific approved idea, the id is retrieved through dataset and stored in the variable approvedIdeaId.
              const approvedIdeaId = eachInvIdea.dataset.id;
              console.log(approvedIdeaId);
              // Check the list of all approved ideas fetched from the database and find if the the selected approved idea matches
              // any of the ApprovedID received from the database.
              const targetApprovedIdea = approvedIdeas.find(invIdea => invIdea.ApprovedID === approvedIdeaId);
              console.log(targetApprovedIdea); // Log the result if it matches
              // Display the details of each approved idea (product) in a modal
              content1.innerHTML = `
                <div class="product-details-r1" style="display: flex;">
                  <div class="product-details-tag" style="display: flex;">
                      <div class="product-details-logo"><p>${targetApprovedIdea.InstrumentDn}</p></div>
                      <p class="product-details-name">${targetApprovedIdea.InstrumentName}</p>
                  </div>
                  <div class="product-details-preferences">
                      <div class="multi-select">
                        <p>${targetApprovedIdea.ProductType}</p>
                      </div>
                  </div>
                  <div class="product-details-offer">
                    <p>Offer: ${targetApprovedIdea.PriceCurrency} ${targetApprovedIdea.ClosingPrice} per ${targetApprovedIdea.Denomination} units</p>
                  </div>
                </div>

                <div class="product-details-r2 " style="">
                  <div class="product-details-stock-info" style="border: 1px solid black;">
                      <p class="product-details-stock">Stock Exchange: <span id="stock">${targetApprovedIdea.StockExchange}</span></p>
                      <p class="product-details-issuer">Issuer: <span id="issuer">${targetApprovedIdea.Issuer}</span></p>
                      <div class="product-details-codes">
                          <p>Ticker: <span id="ticker">${targetApprovedIdea.Ticker}</span></p>
                      </div>
                  </div>
                  <div class="product-details-risk" style="display: flex;">
                      <p id="risk-rating">Risk level: ${targetApprovedIdea.RiskLevel}</p>
                      <p id="risk-brief">${targetApprovedIdea.RiskLevelBrief}</p>
                      <p id="risk-description">${targetApprovedIdea.RiskLevelDescription}</p>
                  </div>
                </div>

                <div class="product-details-r3" style="display: flex;">
                  <div class="product-details-preferences-2">
                    <p class="industry-cat" style="display: fle;">Industry: ${targetApprovedIdea.Industry}</p>
                    <p class="industry-cat" style="display: fle;">Country: ${targetApprovedIdea.Country}</p>
                    <p class="industry-cat" style="display: fle;">Region: ${targetApprovedIdea.Region}</p>
                  </div>
                  <div class="product-details-recom" style="display: flex;">
                    <button id="filter-client">Matched Clients (2)</button>
                    <button id="rec-to-client" onclick="recommendToClients()">Recommend to Clients</button>
                  </div>
                </div>
              `;
              modal.style.display = 'block';

              // Function to match clients to product (approved idea) and recommend the product to the client(s)
              const myFunction = () => {
                const approvedIdeaData = {
                  approvedIdeaDataID: targetApprovedIdea.ApprovedID,
                  riskLevel: targetApprovedIdea.RiskLevel,
                  productType: targetApprovedIdea.ProductType,
                  industry: targetApprovedIdea.Industry,
                  country: targetApprovedIdea.Country,
                  region: targetApprovedIdea.Region
                };

                console.log("approvedIdea Data:", approvedIdeaData)
                // Make an HTTP request to the backend API using JavaScript fetch to get the result of all the clients 
                // whose preferences matches that of the approved idea.
                // The raw data received is converted to a usable format by parsing it to a JavaScript object using json()
                fetch('http://localhost/wealth_affairs/rm/backend/matchClients.php', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify(approvedIdeaData)
                })
                .then(response => response.json())
                .then(data => {
                  console.log(data);
                  // console.log(targetApprovedIdea.InstrumentName);
                  let numberOfClientsMatched = document.getElementById('filter-client');
                  let recommendToClientsMatched = document.getElementById('rec-to-client');

                  // Check if the data recieved is an length and it has a length property
                  // If this condition is satisfied, recommend product the client
                  // If not, it meams the product didn't match any client. Hence, it can't be recommend.
                  if (Array.isArray(data) && data.hasOwnProperty('length')) {
                    console.log(data.length);
                    numberOfClientsMatched.innerHTML = `${data.length} client${data.length == 1 ? '' : 's'} matched`;

                    // Recommend product to clients matched
                    var receivedObjects = []; // Array to store received objects
                    var expectedObjects = data.length; // Total number of objects expected to be received
                    var counter = 0; // Counter to keep track of received objects
                    recommendToClientsMatched.onclick = function(){
                      // console.log("Working")
                      data.map((recomProduct) => {
                        console.log(recomProduct)

                        // Make a POST HTTP request to the backend API using JavaScript fetch to recommend a specific idea to the clients whose preference match it.
                        // The raw data received is converted to a usable format by parsing it to a JavaScript object using json()
                        fetch('http://localhost/wealth_affairs/rm/backend/recommendedIdeas.php', {
                          method: 'POST',
                          headers: {
                            'Content-Type': 'application/json'
                          },
                          body: JSON.stringify(recomProduct)
                        })
                        .then(response => response.json())
                        .then(result => {
                          console.log(result)
                          receivedObjects.push(recomProduct); // Add received object to the array
                          counter++; // Increment the counter
                          if (counter === expectedObjects) {
                            alert("Investment successfully recommended to clients");
                            window.location.href = 'http://localhost/wealth_affairs/rm/index.php';
                          }
                        })
                        .catch(error => {
                          console.error('Error:', error); // Handle any errors
                        });
                      });


                    }

                  } else {
                    // If data is not an array or doesn't have a length property, set length to 0
                    data.length = 0;
                    console.log(data.length);
                    numberOfClientsMatched.innerHTML = `${data.length} client matched`;
                    recommendToClientsMatched.onclick = function(){
                      alert(`${targetApprovedIdea.InstrumentName} does not match any client`)
                    }
                  }
                })
                .catch(error => {
                  console.log('Error:', error)
                });
              }
              myFunction();
            }
          });

        };
      };
    };
    customElements.define('created-investment-cards', CreatedInvestmentCards);
  })
  .catch(error => console.error(error));
});


// Idea from FA
fetch('http://localhost/wealth_affairs/rm/backend/getIdeas.php')
.then(response => response.json())
.then(ideas => {
  // Define IdeasTable to display the ideas generated by FA
  class IdeasTable extends HTMLElement {
    connectedCallback(){
      // If there is no ideas created by FA, a feedback of 'string' data type is returned. 
      // If there are ideas, an object containing array of created ideas are returned
      if (typeof ideas == 'string'){
        this.innerHTML = `
        <div class="content">
            NO IDEA CREATED YET
        </div>
        `
      } else {
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
                                <td><button ${idea.Status == '' || idea.Status == 'Pending' ? '' : 'disabled'} class="view-idea" data-id="${idea.IdeaID}" onclick="viewIdea()">${idea.Status == 'Approved' || idea.Status == 'Rejected' ? 'Decided' : 'View Idea'}</button></td>
                            </tr>`
                        ))
                        .join('')
                    }
                    </table>
                </div>
            `;
                
            // Create a modal to show the profile details of each idea when they are clicked
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

            // This allows RM to retrieve ideas created by FA from the ideas table and approves or rejects it
            modalContent.innerHTML = `
              <div class="product-details-r1" style="display: fle;">
                <div class="product-creation">
                  <h1>Investment Ideas Upload</h1>
                  <form action="http://localhost/wealth_affairs/rm/backend/approvedIdeas.php" method="POST">
                    <input type="hidden" name="IdeaID" value="${targetIdea.IdeaID}" >
                    <input type="hidden" name="FaID" value="${targetIdea.FaID}" >
                    <div class="form-group">
                      <label for="instrument-name">Instrument Name:</label>
                      <input type="text" id="InstrumentName" name="InstrumentName" value='${targetIdea.InstrumentName}' >
                    </div>
                    <div class="form-group">
                      <label for="instrument-dn">Instrument DN:</label>
                      <input type="text" id="InstrumentDn" name="InstrumentDn" value='${targetIdea.InstrumentDn}' >
                    </div>
                    <div class="form-group">
                      <label for="IdeaDescription">Idea Description:</label>
                      <input type="text" id="IdeaDescription" name="IdeaDescription" value='${targetIdea.IdeaDescription}' >
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

                        <option value="Energy" ${targetIdea.Industry == 'Energy' ? 'selected' : ''}>Energy</option>
                        <option value="Chemicals" ${targetIdea.Industry == 'Chemicals' ? 'selected' : ''}>Chemicals</option>
                        <option value="Industrial Goods" ${targetIdea.Industry == 'Industrial Goods' ? 'selected' : ''}>Industrial Goods</option>
                        <option value="Automobiles & Auto Parts" ${targetIdea.Industry == 'Automobiles & Auto Parts' ? 'selected' : ''}>Automobiles & Auto Parts</option>
                        <option value="Food & Beverages" ${targetIdea.Industry == 'Food & Beverages' ? 'selected' : ''}>Food & Beverages</option>
                        <option value="Banking & Investment Services" ${targetIdea.Industry == 'Banking & Investment Services' ? 'selected' : ''}>Banking & Investment Services</option>
                        <option value="Healthcare Services" ${targetIdea.Industry == 'Healthcare Services' ? 'selected' : ''}>Healthcare Services</option>
                        <option value="Technology Equipment" ${targetIdea.Industry == 'Technology Equipment' ? 'selected' : ''}>Technology Equipment</option>
                        <option value="Telecommunication" ${targetIdea.Industry == 'Telecommunication' ? 'selected' : ''}>Telecommunication</option>
                        <option value="Utilities" ${targetIdea.Industry == 'Utilities' ? 'selected' : ''}>Utilities</option>
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
                    <div class="form-group">
                      <label for="IssueDate">Issue Date:</label>
                      <input type="date" id="IssueDate" name="IssueDate" value='${targetIdea.IssueDate}' >
                    </div>
                    <div class="form-group">
                      <label for="MaturityDate">Maturity Date:</label>
                      <input type="date" id="MaturityDate" name="MaturityDate" value='${targetIdea.MaturityDate}' >
                    </div>
                    <button type="submit" name="approve">Approved</button>
                    <button type="submit" name="reject">Rejected</button>
                  </form>
                </div>
            `;
            modal.style.display = 'block';          
          };
        })


      };
    };
  };
  customElements.define('ideas-pro', IdeasTable);
})
.catch(error => console.error(error));