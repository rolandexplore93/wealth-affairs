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
        tablinks[index].className = tablinks[index].className.replace("border-red", "")
    }
    document.getElementById(tabName).style.display = "block";
    e.currentTarget.firstElementChild.className += "border-red";    // Adds style to each tab click
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

// Reusable crated investment products
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

// Resuable components in HTML
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
    console.log(selectedValues); // Values to use
  })
}


const ideas = [
  {
      dateCreated: '12/12/2022',
      instrumentName: 'Amazon.com, Inc',
      assetType: 'Derivatives',
      price: 1,
      currency: 'USD',
      stock: 127.72,
      closingDate: '01/05/2023',
      riskLevel: 4,
      status: 'pending'
  },
  {
      dateCreated: '1/12/2022',
      instrumentName: 'AWS NOX',
      assetType: 'Equities',
      price: 2,
      currency: 'USD',
      stock: 120,
      closingDate: '01/05/2023',
      riskLevel: 5,
      status: 'created'
  },
  {
      dateCreated: '11/12/2022',
      instrumentName: 'Apple',
      assetType: 'Bonds',
      price: 20,
      currency: 'GBP',
      stock: 10,
      closingDate: '21/05/2023',
      riskLevel: 2,
      status: 'created'
  },
]

class IdeasTable extends HTMLElement {
  connectedCallback(){
      this.innerHTML =
          `
              <div id="ideas" class="b__content" style="display: non;">
                  <table>
                      <tr>
                          <th>Date Created</th>
                          <th>Instrument Name</th>
                          <th>Asset Type</th>
                          <th>Offer</th>
                          <th>Closing Date</th>
                          <th>Risk level</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      ${ideas.map(idea => (
                          `<tr>
                              <td>${idea.dateCreated}</td>
                              <td>${idea.instrumentName}</td>
                              <td>${idea.assetType}</td>
                              <td>${idea.price} ${idea.currency} per ${idea.stock} stocks</td>
                              <td>${idea.closingDate}</td>
                              <td>${idea.riskLevel}</td>
                              <td>${idea.status}</td>
                              <td><button onclick={alert('sss')}>View Idea</button></td>
                          </tr>`
                      ))
                      .join('')
                  }
                      
                  </table>
              </div>
          `
  }
}
customElements.define('ideas-pro', IdeasTable);