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
     // Add a button to extend the session if the user clicks it
     echo "<button onclick='extendSession()'>Extend Session</button>";
     // Add a script to handle the button click
     echo "<script>function extendSession() {
         window.location.href = 'http://localhost/wealth_affairs/clients/front_end/wishlist.php';
     }</script>";
 }
 
 // Update the session time
 $_SESSION['session_time'] = time();
?>

<!DOCTYPE html>
<html lang="en-UK">
<html>
<head>
    <link rel="stylesheet" href="http://localhost/wealth_affairs/clients/front_end/dashboard.css">
    <script src="http://localhost/wealth_affairs/clients/front_end/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <noscript>
     <p>Please enable JavaScript to use this website.</p>
    </noscript>
    <script>
    // Make an AJAX request to get the wishlist approvedideas
$.getJSON('http://localhost/wealth_affairs/clients/back_end/view_wishlist.php', function(approvedideas) {
    // Create a table and add a header row
    var table = $('<table class="table table-bordered table-striped" style="border: 1px solid black;"></table>');
    var thead = $('<thead class="thead-dark"></thead>');
    var headerRow = $('<tr></tr>');
    headerRow.append('<th>ProductID</th>');
    headerRow.append('<th>Instrument Name</th>');
    headerRow.append('<th>Instrument Description</th>');
    headerRow.append('<th>Industry</th>');
    headerRow.append('<th>Risk Level</th>');
    headerRow.append('<th>Country</th>');
    headerRow.append('<th>Denomination</th>');
    headerRow.append('<th>Product Type</th>');
    headerRow.append('<th>Price Currency</th>');
    headerRow.append('<th>Issuer</th>');
    headerRow.append('<th>Ticker</th>');
    headerRow.append('<th>Region</th>');
    headerRow.append('<th>Action</th>');
    thead.append(headerRow);
    table.append(thead);

    // Loop through the products and add them to the table
    var tbody = $('<tbody></tbody>');
    for (var i = 0; i < approvedideas.length; i++) {
        var approvedidea = approvedideas[i];
        var row = $('<tr></tr>');
        row.append('<td>' + approvedidea.ApprovedID + '</td>');
        row.append('<td>' + approvedidea.InstrumentName + '</td>');
        row.append('<td>' + approvedidea.InstrumentDesc + '</td>');
        row.append('<td>' + approvedidea.Industry + '</td>');
        row.append('<td>' + approvedidea.RiskLevel + '</td>');
        row.append('<td>' + approvedidea.Country + '</td>');
        row.append('<td>' + approvedidea.Denomination + '</td>');
        row.append('<td>' + approvedidea.ProductType + '</td>');
        row.append('<td>' + approvedidea.PriceCurrency + '</td>');
        row.append('<td>' + approvedidea.Issuer + '</td>');
        row.append('<td>' + approvedidea.Ticker + '</td>');
        row.append('<td>' + approvedidea.Region + '</td>');
        
        // Add a "delete" button for each product
        var deleteButton = $('<button>Delete</button>');
        deleteButton.click(function(approvedidea) {
            // Send a request to the PHP script to delete the corresponding product from the wishlist
            $.post('http://localhost/wealth_affairs/clients/back_end/delete_wishlist.php', {ApprovedID: approvedidea.ApprovedID}, function() {
                // Reload the wishlist page after deleting the product
                location.reload();
            });
        }.bind(this, approvedidea));
        var deleteCell = $('<td></td>');
        deleteCell.append(deleteButton);
        row.append(deleteCell);
        tbody.append(row);

            }
            table.append(tbody);

            // Add the table to the wishlist div
            $('#wishlist').append(table);
        });
</script>
<title>Wishlist
</title>
</head>
<body>
     <!-- Sidebar -->
    <div class="wrapper">
        <header style="border: 1px solid purple; display:flex;">
        <a href="http://localhost/wealth_affairs/clients/front_end/dashboard.php">
            <div class="company-logo" style="border: 1px solid gray;"> <img src="WealthManagement-logo/logo.png"/></div>
        </a>
            <div class="welcome" style="border: 1px solid purple; flex:4;"><h2>Welcome, <?php echo $_SESSION['fname']; ?>!</h2></div>
            <h1>Dashboard</h1>
                <p>You are now logged in to the dashboard.</p>
                <a href="http://localhost/wealth_affairs/clients/back_end/logout.php">Logout</a>   
        </header>
        
         <!-- Product section -->
        <section class="product-section" style="border: 3px solid gray; flex: 1; display: flex;;">
            <!-- Product display -->
            <section class="products" style="border: 1px solid purple ; flex: 4; display: flex; flex-direction: column;">
                
                <h1>View your saved product wishlist</h1>
                
           ` <div class="basic-instrument" style="border: 1px solid purple; flex: 1;">
                 <!-- The wishlist products will be dynamically added here -->  
                <div id="wishlist" class="wishlist" style="overflow:auto; height: 100vh;">
            </section> 
             <!-- Sidebar -->
            <section class="client-profile" style="border: 1px solid gray; flex: 1; display: flex; flex-direction: column; gap: 10px;">
                    <!-- for client sidebar -->
                    <div class="client side-profile" style="border: 1px solid purple; flex: 1;">
                            <img src="../front_end/images/computer-science-gbb745b0cd_640.png" alt="rm-image" />
                        <p class="name" ><?php echo $_SESSION['fname']; ?>
                        <p class="email" ><?php echo $_SESSION['email']; ?>
                        <p class="title">Client</p>
                        
                        <button><a href="http://localhost/wealth_affairs/clients/front_end/profile.php">Edit profile</a></button><br>
                        <button><a href="http://localhost/wealth-affairs/clients/front_end/dashboard.php">Dashboard</a></button>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                    <button class="product-view" style="cursor: pointer; margin-bottom: 00px;">
                        <a href="http://localhost/wealth_affairs/clients/front_end/all_recommeded_products.php">View all tailored ideas</a>
                    </button>
                    <button class="product-view" style="cursor: pointer;">
                        <a href="http://localhost/wealth_affairs/clients/front_end/products.php">View all ideas</a>
                    </button>
                    </div>
                    </div>
                    <!-- for client Relationship Manager Sidebar -->
                    <div class="rm side-profile" style="border: 1px solid gray; flex: 1;">
                            <img src="../front_end/images/computer-science-gbb745b0cd_640.png" alt="rm-image" />
                            <p class="name"><?php echo $_SESSION['rm_fname'].' '. $_SESSION['rm_lname']; ?></p>
                        <p class="name"><?php echo $_SESSION['rm_email']; ?></p>
                        <p class="title">Meet Your Relational Manager</p>
                        <button class="product-view" style="cursor: pointer;">
                        <a href="http://localhost/wealth_affairs/clients/front_end/all_rm_recommeded_ideas.php">View all recommended ideas</a>
                    </button>
                    </div>
                    
            </section>
        </section>
         <!-- Footer -->
        <footer style="border: 1px solid purple">Copyright © 2023 WealthManagement. All Rights Reserved</footer>
      
    </div>
</body>
</html> 