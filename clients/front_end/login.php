<?php
    session_start();
    
    if (isset($_SESSION['Client_ID'])) {
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
    <script src="http://localhost/wealth-affairs/clients/front_end/main.js"></script>
    <!-- Link to login CSS File-->
    <link rel="stylesheet" href="http://localhost/wealth-affairs/clients/front_end/login_signup.css">
    <noscript>
      <p>Please enable JavaScript to use this website.</p>
    </noscript>
    <script>
    // Redirect to error page if JavaScript is disabled
    if (!navigator.cookieEnabled) {
      window.location.href = 'error.html';
    }
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
                xhr.open("POST", "http://localhost/wealth-affairs/clients/Back_end/login_PDO.php", true);
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
</head>
<body>
    <div class="wrapper">
        <section class="Left">
            <div class="title"><h1>Wealth Management</h1></div>

            <form name="loginForm" method="post" action="http://localhost/wealth-affairs/clients/back_end/login_PDO.php" onsubmit="return validateForm()">
                <h2 id="form-directive">Login </h2>
                <p id="form-guide">Login to WealthManagement.</p>
                <label for="email"><b>Email:</b></label>
                <input type="text" placeholder="Enter Email" name="email" ><br><br>
                <label for="password"><b>Password:</b></label>
                <input type="password" id="password" placeholder="Enter Password" name="password" ><br><br>
                <label><input type="checkbox" checked="checked" name="remember"> Remember</label><br><br>
                <div class="button-wrapper">
                <button type="login" class="loginbtn" value="Login">Login</a></b></button>
                <p><a href="http://localhost/wealth-affairs/clients/front_end/forgot_password.php">Forgot Passowrd?</a></p>
                </div>
                <div class="button-wrapper">
                <button><a href="http://localhost/wealth-affairs/clients/front_end/Signup.html">Don't have an account yet? Register.</a></button>
                </div>
                <style>
                .button-wrapper {
                    display: inline-block;
                    margin-right: 20px; /* change the value to adjust the spacing */
                }
                </style>
            </form>
            
        </section>
        <section class="Right">
            <div class="onboarding-image-cover">
                <img class="onboarding-image" src="./Images/invest 2.jpg" alt="female on a her mobile devices">
            </div>
        </section>
    </div>
</body>
</html>