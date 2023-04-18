<?php
    // Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['ClientID'])) {
    // User is not logged in
    header("Location: http://localhost/wealth_affairs/clients/front_end/login.php");
    exit();
}

// Check if the user has been inactive for 20 minutes
$inactive = 1200; // 20 minutes in seconds
$session_time = $_SESSION['session_time'] ?? time();
$elapsed_time = time() - $session_time;

if ($elapsed_time > $inactive) {
    // User has been inactive for too long, log them out
    session_unset();
    session_destroy();
    header("Location: http://localhost/wealth_affairs/clients/front_end/login.php");
    exit();
} else if ($elapsed_time > ($inactive - 300)) {
    // User has been inactive for almost 20 minutes, provide a warning
    $remaining_time = $inactive - $elapsed_time;
    echo "<p>Your session will expire in $remaining_time seconds. Would you like to extend your session?</p>";
    // button to extend the session if the user clicks it
    echo "<button onclick='extendSession()'>Extend Session</button>";
    // script to handle the button click
    echo "<script>function extendSession() {
        window.location.href = 'http://localhost/wealth_affairs/clients/front_end/profile.php';
    }</script>";
}

// Update the session time
$_SESSION['session_time'] = time();

?>
<!DOCTYPE html>
<html lang="en-UK">
<html>
<head>
  <!-- This is the link to the CSS file. -->
    <link rel="stylesheet" href="http://localhost/wealth_affairs/clients/front_end/main.css">
     <!-- This is the link to the main JavaScript file. -->
    <script src="http://localhost/wealth_affairs/clients/front_end/main.js"></script>
     <!-- This is the link to the jQuery library. -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- This is a message for users who do not have JavaScript enabled. -->
     <noscript>
    <p>Please enable JavaScript to use this website.</p>
    </noscript>
    
    <title>Profile Section
    </title>
</head>
<body>
     <!-- Body -->
    <div class="wrapper">
        <header style="border: 1px solid purple; display:flex;">
            <div class="company-logo" style="border: 1px solid purple;"> 
            <a href="http://localhost/wealth_affairs/clients/front_end/dashboard.php">
              <img src="WealthManagement-logo/logo.png"/>
            </a>
          </div>
            <div class="welcome" style="border: 1px solid purple; flex:4;"><h2>Profile Section</h2></div>
            <p>You are now logged in to the dashboard.</p>
            <a href="http://localhost/wealth_affairs/clients/back_end/logout.php">Logout</a>
        </header>
         <!-- Form section -->
        <section class="personal-section" style="border: 3px solid gray; flex: 1; display: flex; flex-direction: column;">
            <!-- Profile display -->
            <section class="profiles" style="border: 1px solid purple; flex: 2; display: flex;">
                <!-- Profile Page -->
                <div class="profile-page" style="border: 1px solid purple; flex: 3;"><span><strong><p>Personal Details</p></strong></span>
                   <!-- Form for personal data -->
                    <form class="form-inline" method='post' action="http://localhost/wealth_affairs/clients/back_end/bio_data.php">
                         <label for="email">Update Email:</label>
                        <input type="email" id="email" placeholder="<?php echo $_SESSION['email']; ?>" name="email">
                        <label for="pnmuber">Phone Number:</label>
                        <input type="pnumber" id="pnumber" placeholder="Enter Phone Number" name="pnumber">
                        <label for="adds">Address:</label>
                        <input type="adds" id="adds" placeholder="Enter Address" name="adds">
                        <label for="pcode">Post Code:</label>
                        <input type="pcode" id="pcode" placeholder="Enter Post Code" name="pcode">
                        <label for="country">Country</label>
                        <!-- created a varirable to store all country data for reuse -->
                        <select id="country" name="country" placeholder="Select Country">
                        <?php
                        $countries = array("Select Country",
                          "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
                          "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain",
                          "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia",
                          "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso",
                          "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Central African Republic",
                          "Chad", "Chile", "China", "Colombia", "Comoros", "Congo Brazzaville",
                          "Congo", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba",
                          "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic",
                          "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea",
                          "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia",
                          "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea",
                          "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India",
                          "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan",
                          "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait",
                          "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya",
                          "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi",
                          "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
                          "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Morocco",
                          "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand",
                          "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Palau", "Panama",
                          "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal",
                          "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
                          "Saint Vincent", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia",
                          "Senegal", "Serbia and Montenegro", "Seychelles", "Sierra Leone", "Singapore",
                          "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Sudan", 
                          "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", 
                          "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", 
                          "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", 
                          "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", 
                          "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
                      foreach ($countries as $country) {
                          echo "<option value=\"$country\">$country</option>";
                      }
                        asort($countries); // Sort the countries alphabetically by name
                      ?>
                        </select>
                        <button type="submit">Submit</button>
                      </form>
                      
                </div>
                      

                <!-- for client sidebar -->
                <div class="client side-profile" style="border: 1px solid purple; flex: 1;">
                        <img src="../front_end/images/computer-science-gbb745b0cd_640.png" alt="rm-image" />
                    <p class="name" ><?php echo $_SESSION['fname']; ?>
                    <p class="name" ><?php echo $_SESSION['email']; ?>
                    <p class="title">Client</p>
                    <button><a href="http://localhost/wealth_affairs/clients/front_end/dashboard.php">Dashboard</a></button><br>
                    <button><a href="http://localhost/wealth_affairs/clients/front_end/forgot_password.php">Change Password</a></button>
                </div>
            </section> 
                      <!-- Investment prefernces section -->
                <!--Select investment preferences  -->
                <div class="preference" style="border: 1px solid gray; flex: 2;"><strong><p>Select your investment preferences</p></strong>
                     <!-- Form for preferences -->
                        <form class="form-inline" method='post' action="http://localhost/wealth_affairs/clients/back_end/selected_preferences.php">
                          <!-- Product type checkbox -->
                            <div class="multiselect">
                              <div class="selectBox" onclick="showCheckboxes('productType')">
                                <select>
                                  <option>Select Product Type</option>
                                </select>
                                <div class="overSelect"></div>
                              </div>
                              <div id="productType">
                                <label for="bonds">
                                  <input type="checkbox" id="bonds" name="productType[]" value="Bonds"/>Bonds</label><br>
                                <label for="ETFs">
                                  <input type="checkbox" id="ETFs" name="productType[]" value="ETFs" />ETFs</label><br>
                                <label for="FX and Money Market">
                                  <input type="checkbox" id="FX and Money Market" name="productType[]" value="FX and Money Market"/>FX and Money Market</label><br>
                                <label for="Credit Derivatives">
                                  <input type="checkbox" id="Credit Derivatives" name="productType[]" value="Credit Derivatives"/>Credit Derivatives</label><br>
                                <label for="Insurance Derivatives">
                                    <input type="checkbox" id="Insurance Derivatives" name="productType[]" value="Insurance Derivatives"/>Insurance Derivatives</label><br>
                                <label for="Security Derivatives">
                                    <input type="checkbox" id="Security Derivatives" name="productType[]" value="Security Derivatives"/>Security Derivatives</label><br>
                                <label for="Stocks">
                                    <input type="checkbox" id="Stocks" name="productType[]" value="Stocks"/>Stocks</label><br>
                                <label for="Mutual Funds">
                                    <input type="checkbox" id="Mutual Funds" name="productType[]" value="Mutual Funds"/>Mutaul Funds</label><br>
                              </div>
                              </div>
                              
                                <!-- Risk levels radio button -->
                                <div class="multiselect">
                                <div id="riskLevel">
                                <strong><p>Select a Risk Level:</p></strong>
                                  <input type="radio" name='riskLevel' value=1>Risk Level 1</label><br>
                                  <input type="radio" name="riskLevel" value=2>Risk Level 2</label><br>
                                  <input type="radio" name="riskLevel" value=3>Risk Level 3</label><br>
                                  <input type="radio" name="riskLevel" value=4>Risk Level 4</label><br>
                                  <input type="radio" name="riskLevel" value=5>Risk Level 5</label><br>
                                  </div>
                                </div>
                                    <!-- Industry checkbox -->
                                    <div class="multiselect">
                                        <div class="selectBox" onclick="showCheckboxes('industry')">
                                          <select>
                                            <option>Select an Industry</option>
                                          </select>
                                          <div class="overSelect"></div>
                                        </div>
                                        <div id="industry">
                                          
                                          <label for="energy">
                                            <input type="checkbox" id="energy" name="industry[]" value="Energy"> Energy</label><br>
                                          <label for="chemicals">
                                            <input type="checkbox" id="chemicals" name="industry[]" value="Chemicals"> Chemicals</label><br>
                                          <label for="industrial-goods">
                                            <input type="checkbox" id="industrial-goods" name="industry[]" value="Industrial Goods"> Industrial Goods</label><br>
                                          <label for="auto">
                                            <input type="checkbox" id="auto" name="industry[]" value="Automobiles & Auto Parts"> Automobiles & Auto Parts</label><br>
                                          <label for="food-beverages">
                                            <input type="checkbox" id="food-beverages" name="industry[]" value="Food & Beverages" > Food & Beverages</label><br>
                                          <label for="banking">
                                            <input type="checkbox" id="banking" name="industry[]" value="Banking & Investment"> Banking & Investment</label><br>
                                          <label for="healthcare">
                                            <input type="checkbox" id="healthcare" name="industry[]" value="Healthcare Services"> Healthcare Services</label><br>
                                          <label for="tech">
                                            <input type="checkbox" id="tech" name="industry[]" value="Technology Equipement"> Technology Equipment</label><br>
                                          <label for="telecom">
                                            <input type="checkbox" id="telecom" name="industry[]" value="Telecommunication"> Telecommunication</label><br>
                                          <label for="utilities">
                                            <input type="checkbox" id="utilities" name="industry[]" value="Utilities" > Utilities</label><br>
                                        </div>
                                        </div>
                                      <!-- Country checkbox -->
                                        <div class="multiselect">
                                        <div class="selectBox">
                                              <strong><p>Choose preferred countries</p></strong>
                                         <div class="overSelect"></div>
                                          </div>
                                          <div id="Pcountry" style="height: 200px; overflow-y: scroll;">
                                          <?php
                                            foreach ($countries as $country) {
                                              echo "<label for='$country'>";
                                              echo "<input type='checkbox' id='$country' name='Pcountry[]' value='$country'> $country</label><br>";
                                            }
                                          ?>
                                          </div>
                                          </div>       
                                          <button type="submit">Submit</button>
                                        </form> 
                  </div>      
        </section>
         <!-- Footer -->
        <footer style="border: 1px solid gray">Copyright © 2023 WealthManagement. All Rights Reserved</footer>
                            
    </div>
</body>
</html> 