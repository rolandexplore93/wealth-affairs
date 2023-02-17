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

// Checkbox inside select
var expandProductCategory = false;
// const showCategoryOptions = () => {
//   var checkboxes = document.getElementById("checkboxes");
//   if (!expandProductCategory){
//     checkboxes.style.display = "block"; 
//     expandProductCategory = true;
//   } else {
//     checkboxes.style.display = "none";
//     expandProductCategory = "false";
//   }
// }

function expandProductCategory() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expandProductCategory){
    checkboxes.style.display = "block"; 
    expandProductCategory = true;
  } else {
    checkboxes.style.display = "none";
  }
}