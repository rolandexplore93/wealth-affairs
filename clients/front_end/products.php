<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['Client_ID'])) {
        // User is not logged in
        header("Location: http://localhost/wealth-affairs/clients/front_end/login.phpp");
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
        header("Location: http://localhost/wealth-affairs/clients/front_end/login.php");
        exit();
    } else if ($elapsed_time > ($inactive - 300)) {
        // User has been inactive for almost 20 minutes, provide a warning
        $remaining_time = $inactive - $elapsed_time;
        echo "<p>Your session will expire in $remaining_time seconds. Would you like to extend your session?</p>";
        // Add a button to extend the session if the user clicks it
        echo "<button onclick='extendSession()'>Extend Session</button>";
        // Add a script to handle the button click
        echo "<script>function extendSession() {
            window.location.href = 'http://localhost/wealth-affairs/clients/front_end/products.php';
        }</script>";
    }
    
    // Update the session time
    $_SESSION['session_time'] = time();
    
    
?>

<!DOCTYPE html>
<html lang="en-UK">
<html>
<head>
    <link rel="stylesheet" href="http://localhost/wealth-affairs/clients/front_end/dashboard.css">
    <script src="http://localhost/wealth-affairs/clients/front_end/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <noscript>
    <p>Please enable JavaScript to use this website.</p>
    </noscript>
       <title>All Products
    </title>
</head>
<body>
     <!-- Sidebar -->
    <div class="wrapper">
        <header style="border: 1px solid purple; display:flex;">
        <a href="http://localhost/wealth-affairs/clients/front_end/dashboard.php">
            <div class="company-logo" style="border: 1px solid purple;"> <img src="WealthManagement-logo/logo.png"/></div>
        </a>
            <div class="welcome" style="border: 1px solid gray; flex:4;"><h2>Welcome, <?php echo $_SESSION['fname']; ?>!</h2></div>
            <h1>Dashboard</h1>
                <p>You are now logged in to the dashboard.</p>
                <a href="http://localhost/wealth-affairs/clients/back_end/logout.php">Logout</a>
                
        </header>
        
         <!-- Product section -->
        <section class="product-section" style="border: 3px solid purple; flex: 1; display: flex;;">
       
            <!-- Product display -->
            <section class="products" style="border: 1px solid gray; flex: 4; display: flex; flex-direction: column;">
            <?php
                        
                        // Include the header.php file
                        include ('../back_end/all_products.php');
        
            ?>
                
            </section> 
             <!-- Sidebar -->
            <section class="client-profile" style="border: 1px solid purple; flex: 1; display: flex; flex-direction: column; gap: 10px;">
                    <!-- for client sidebar -->
                    <div class="client side-profile" style="border: 1px solid gray; flex: 1;">
                            <img src="../front_end/images/computer-science-gbb745b0cd_640.png" alt="rm-image" />
                        <p class="name" ><?php echo $_SESSION['fname']; ?>
                        <p class="email" ><?php echo $_SESSION['email']; ?>
                        <p class="title">Client</p>
                        <button><a href="http://localhost/wealth-affairs/clients/front_end/profile.php">Edit profile</a></button><br>
                        <button><a href="http://localhost/wealth-affairs/clients/front_end/wishlist.php">Dashboard</a></button><br>
                        <button><a href="http://localhost/wealth-affairs/clients/front_end/dashboard.php">View Wishlist</a></button>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                    <button class="product-view" style="cursor: pointer; margin-bottom: 00px;">
                        <a href="http://localhost/wealth-affairs/clients/front_end/all_recommeded_products.php">View all tailored products</a>
                    </button>
                    </div>
                    </div>
                    <!-- for client Relationship Manager Sidebar -->
                    <div class="rm side-profile" style="border: 1px solid gray; flex: 1;">
                            <img src="../front_end/images/computer-science-gbb745b0cd_640.png" alt="rm-image" />
                        <p class="name">Roland, O. O</p>
                        <p class="title">My Relational Manager</p>
                    </div>
                    
            </section>
        </section>
         <!-- Footer -->
        <footer style="border: 1px solid purple">Copyright © 2023 WealthManagement. All Rights Reserved</footer>
      
    </div>
</body>
</html> 