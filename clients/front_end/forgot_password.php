<!doctype html>
<html lang="en-UK">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to login CSS File-->
    <link rel="stylesheet" href="http://localhost/wealth_affairs/clients/front_end/login_signup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <noscript>
  <p>Please enable JavaScript to use this website.</p>
</noscript>
<script>
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
</script>
    <title>Forgot Password</title>
</head>
<body>
    <div class="wrapper">
                <!--Body divided into two sections  -->
                <!-- Left section -->
               <section class="Left">
            <div class="title"><h1>Wealth Management</h1></div>
                <form class="myForm" name="myForm" onsubmit="return validateForm()" method="POST" action="http://localhost/wealth_affairs/clients/back_end/updatepassword.php">
                  <!-- form for password update -->
                <h2 id="form-directive">Change Password</h2>
                <label for="email"><b>Email:</b></label>
                <input type="text" placeholder="Enter Email" name="email" ><br><br>
                <label for="oldpassword"><b>Old Password:</b></label>
                <input type="password" placeholder="Enter Old Password" name="oldpassword"><br><br>

                <label for="newpassword"><b>New Password:</b></label>
                <input type="password" placeholder="Enter New Password" name="newpassword" minlength="8"><br><br>

                <label for="confirmpassword"><b>Confirm New Password:</b></label>
                <input type="password" placeholder="Confirm New Password" name="confirmpassword" minlength="8"><br><br>

                <div class="submit">
                    <button type="submit" class="continuebtn"><b>Change Password</b></button>
                    <button class="button-wrapper"> <a href="http://localhost/wealth_affairs/clients/front_end/login.php">Login to your account</a></button>
                </div>
                <style>
                .button-wrapper {
                    display: inline-block;
                    margin-left: 60px; 
                }
                </style>
            </form>

        </section>
        <!-- right section -->
        <section class="Right">
            <div class="onboarding-image-cover">
                <img class="onboarding-image" src="./Images/invest 2.jpg" alt="female on a her mobile devices">
            </div>
        </section>
    </div>
</body>
</html>