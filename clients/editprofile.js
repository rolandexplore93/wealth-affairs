
// function for checkbox
function showCheckboxes(id) {
  var checkboxes = document.getElementById(id);
  if (checkboxes.style.display === "block") {
      checkboxes.style.display = "none";
  } else {
      checkboxes.style.display = "block";
  }
}