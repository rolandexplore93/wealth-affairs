
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
  

$(document).ready(function() {
    // Fetch data from the server
    $.ajax({
        url: 'http://localhost/wealth-affairs/clients/rand.php',
        method: 'GET',
        dataType: 'html',
        success: function(data) {
            // Update the container element with the fetched data
            $('#results').html(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
        }
    });
});

 // Make an AJAX request to get the wishlist products
 
    $.getJSON('http://localhost/wealth-affairs/clients/view_wishlist.php', function(products) {
        // Loop through the products and add them to the wishlist div
        for (var i = 0; i < products.length; i++) {
            var product = products[i];
            var card = $('<div class="card"></div>');
            var cardBody = $('<div class="card-body"></div>');
            card.append(cardBody);
            cardBody.append('<h5 class="card-title">' + product.InstrumentName + '</h5>');
            cardBody.append('<h6 class="card-subtitle mb-2 text-muted">' + product.InstrumentDn + '</h6>');
            cardBody.append('<p class="card-text">' + product.Industry + '</p>');
            cardBody.append('<p class="card-text">' + product.RiskLevel + '</p>');
            cardBody.append('<p class="card-text">' + product.ProductCountry + '</p>');
            cardBody.append('<a href="#" class="card-link" onclick="toggleDetails(' + product.ProductID + ')">View Details</a>');
            $('#wishlist').append(card);
        }
    });

    

   



