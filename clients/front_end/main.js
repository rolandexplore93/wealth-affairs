
// function for checkbox
function showCheckboxes(id) {
  var checkboxes = document.getElementById(id);
  if (checkboxes.style.display === "block") {
      checkboxes.style.display = "none";
  } else {
      checkboxes.style.display = "block";
  }
}

//validate form
function validateForm() {
    // Get the form inputs
    var email = document.forms["myForm"]["email"].value;
    var oldpassword = document.forms["myForm"]["oldpassword"].value;
    var newpassword = document.forms["myForm"]["newpassword"].value;
    var confirmpassword = document.forms["myForm"]["confirmpassword"].value;
    
    // Validate the email
    if (email == "") {
      alert("Email must be filled out");
      return false;
    }
    
    // Validate the old password
    if (oldpassword == "") {
      alert("Old password must be filled out");
      return false;
    }
    
    // Validate the new password
    if (newpassword == "") {
      alert("New password must be filled out");
      return false;
    }
    
    // Validate the confirm password
    if (confirmpassword == "") {
      alert("Confirm password must be filled out");
      return false;
    }
    
    // Validate the new password and confirm password match
    if (newpassword !== confirmpassword) {
      alert("New password and Confirm password do not match");
      return false;
    }
    
    // If all the inputs are valid, return true to submit the form
    return true;
  }
  


    

   



