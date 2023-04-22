<?php

    // Start session
    session_start();

    // Check if ClientID is set
    if (isset($_SESSION['ClientID'])) {

    // Unset email and destroy session
        unset($_SESSION['email']);
        session_destroy();
    }
?>

<!doctype html>
<html lang="en-UK">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to main.js file -->
    <script src="http://localhost/wealth_affairs/clients/front_end/main.js"></script>
    <!-- Link to login CSS File-->
    <link rel="stylesheet" href="http://localhost/wealth_affairs/clients/front_end/login_signup.css">
    <!-- Show message if JavaScript is disabled -->
    <noscript>
      <p>Please enable JavaScript to use this website.</p>
    </noscript>
    <script>
    // Javascript functoion to validate form inputs
               function validateForm() {
                var email = document.forms["loginForm"]["email"].value;
                var password = document.forms["loginForm"]["password"].value;

                // Check if email and password are filled in
                if (email == "" || password == "") {
                    alert("Please fill in both email and password.");
                    return false;
                }

                // Check if email is in a valid format
                var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if (!email.match(emailRegex)) {
                    alert("Please enter a valid email address.");
                    return false;
                }

                // Prevent XSS attacks by sanitizing input
                email = sanitizeInput(email);
                password = sanitizeInput(password);

                // Prevent SQL injection attacks by using parameterized queries
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "http://localhost/wealth_affairs/clients/back_end/action_login.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle server response
                    }
                };
                xhr.send("email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));

                return false;
            }
</script>
    <title>Login</title>

<head>
<!-- The head section contains the title of the webpage and other metadata. -->
</head>
<body>

<!-- The body section contains the content of the webpage. -->
    <div class="wrapper">
    <p><a href="http://localhost/wealth_affairs/auth/login.html">Staff login</a></p>
    <!-- The wrapper class is used to contain the two sections of the page, the left and the right section. -->
        <section class="Left">  
        <!-- The left section contains the login form for the user to login. -->
            <div class="title"><h1>Wealth Management</h1></div>
        <form name="loginForm" method="post" action="http://localhost/wealth_affairs/clients/back_end/action_login.php" onsubmit="return validateForm()">
        <!-- The form contains the login form with the email and password fields, the Remember Me checkbox and two buttons, Login and Register. -->
            <h2 id="form-directive">Login </h2>
            <p id="form-guide">Login to WealthManagement.</p>
            <label for="email"><b>Email:</b></label>
            <input type="text" placeholder="Enter Email" name="email" ><br><br>
            <label for="password"><b>Password:</b></label>
            <input type="password" id="password" placeholder="Enter Password" name="password" ><br><br>
            <label><input type="checkbox" checked="checked" name="remember"> Remember</label><br><br>
            <div class="button-wrapper">
            <button type="login" class="loginbtn" value="Login">Login</a></b></button>
            <!-- The login button is used to submit the login form. -->
            <p><a href="http://localhost/wealth_affairs/clients/front_end/forgot_password.php">Forgot Password?</a></p>
            <!-- The Forgot Password link takes the user to the forgot password page. -->
            </div>
            <div class="button-wrapper">
            <button><a href="http://localhost/wealth_affairs/clients/front_end/Signup.html">Don't have an account yet? Register.</a></button>
            <!-- The Register button takes the user to the register page. -->
            </div>
            <style>
            .button-wrapper {
                display: inline-block;
                margin-right: 20px; 
            }
            </style>
        </form>
        
    </section>
    <section class="Right">
    <!-- The right section contains an image of a female on a mobile device. -->
        <div class="onboarding-image-cover">
            <img class="onboarding-image" src="./Images/invest 2.jpg" alt="female on a her mobile devices">
        </div>
    </section>
</div>
</body>
</html>