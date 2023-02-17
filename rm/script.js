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

// Checkbox basic instrument preferences
const toggleDropdown = document.querySelector('.toggle-dropdown');
const dropdown = document.querySelector('.dropdown');

toggleDropdown.addEventListener('click', function() {
  dropdown.classList.toggle('show');
});

  // Get value on checkbox toggle
// const checkboxes = document.querySelectorAll('.options input[type="checkbox"]');
// for (let i = 0; i < checkboxes.length; i++){
//   checkboxes[i].addEventListener('change', function() {
//     let selectedValues = [];
//     for (let j = 0; j < checkboxes.length; j++){
//       if (checkboxes[j].checked){
//         selectedValues.push(checkboxes[j].value);
//       }
//     }
//     console.log(selectedValues); // Values to use
//   })
// }

// checkbox derivatives products
const toggleDerivativesProducts = document.querySelector(".toggle-dp");
console.log(toggleDerivativesProducts)
const dropdownDerivativesProducts = document.querySelector(".dropdown-dp");
console.log(dropdownDerivativesProducts)

toggleDerivativesProducts.addEventListener('change', function(){
  alert('ddd')
  dropdownDerivativesProducts.classList.toggle("show");
})