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
            window.location.href = 'http://localhost/wealth_affairs/clients/front_end/dashboard.php';
        }</script>";
    }
    
    // Update the session time
    $_SESSION['session_time'] = time();
    
?>

<!-- This is the start of the HTML document. -->
<!DOCTYPE html>
<html lang="en-UK">
<html>
<head>
    <!-- This is the link to the CSS file. -->
    <link rel="stylesheet" href="http://localhost/wealth_affairs/clients/front_end/dashboard.css">
    <!-- This is the link to the main JavaScript file. -->
    <script src="http://localhost/wealth_affairs/clients/front_end/main.js"></script>
    <!-- This is the link to the jQuery library. -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- This is a message for users who do not have JavaScript enabled. -->
    <noscript>
    <p>Please enable JavaScript to use this website.</p>
    </noscript>
    <!-- This is the title of the webpage. -->
       <title>Dashboard
    </title>
</head>
<body>
     <!-- This is the sidebar. -->
    <div class="wrapper">
        <header style="border: 1px solid purple; display:flex;">
        <!-- This is a link to the dashboard page. -->
        <a href="http://localhost/wealth_affairs/clients/front_end/dashboard.php">
            <div class="company-logo" style="border: 1px solid purple;"> <img src="WealthManagement-logo/logo.png"/></div>
        </a>
            <!-- This is a greeting message to the user. -->
            <div class="welcome" style="border: 1px solid purple; flex:4;"><h2>Welcome, <?php echo $_SESSION['fname']; ?>!</h2></div>
            <!-- This is the header of the dashboard. -->
            <h1>Dashboard</h1>
                <p>You are now logged in to the dashboard.</p>
                <!-- This is a link for the user to logout. -->
                <a href="http://localhost/wealth_affairs/clients/back_end/logout.php">Logout</a>
    </header>
         <!-- This section displays the ideas available to the user -->
            <section class="product-section" style="border: 3px solid purple; flex: 1; display: flex;;">
            <!-- This section displays the tailored ideas with their respective details based on their selected preferences -->
                <section class="products" style="border: 1px solid purple; flex: 4; display: flex; flex-direction: column;">
                    
                    <h1>Tailored for You: Get Recommendations That Truly Speak to Your Investment Needs</h1>
                    
                    <!-- This is the wrraper for tailored ideas available -->
                    <div class="basic-instrument" style="border: 1px solid grey; flex: 1; flex-direction: column; ">
                        
                        <!-- This section displays the title of the tailored ideas -->
                        <div class="product-title">
                            <?php  
                                // php script to display five cards of tailored ideas from all approved ideas based on client's preferences
                                require_once('../back_end/tailored_ideas.php');
                            ?>
                        </div>
                        
                        <!-- This section displays the personalized ideas by the Relationship Manager -->
                        <h1>Personalised ideas by your Relationship Manager...</h1>
                        <div class="equity" style="border: 1px solid gray; flex: 1; flex-direction: column;">
                            <!-- This section displays the title of the recommended ideas -->
                            <div class="product-title">
                                <?php  
                                    // PHP script to display five cards of ideas sent from RM 
                                    require_once('../back_end/getRecommendedideas.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
           <!-- This section shows the sidebar for the client and Relationship Manager -->
                <section class="client-profile" style="border: 1px solid ; flex: 1; display: flex; flex-direction: column; gap: 10px;">
                    <!-- This div shows the sidebar for the client -->
                    <div class="client side-profile" style="border: 1px solid gray; flex: 1;">
                        <!-- Client profile image -->
                        <img src="../front_end/images/computer-science-gbb745b0cd_640.png" alt="rm-image" />
                        <!-- Client's name -->
                        <p class="name" ><?php echo $_SESSION['fname']; ?></p>
                        <!-- Client's email -->
                        <p class="email" ><?php echo $_SESSION['email']; ?></p>
                        <!-- Client's title -->
                        <p class="title">Client</p>
                        <!-- Edit profile button for client -->
                        <button><a href="http://localhost/wealth_affairs/clients/front_end/profile.php">Profile</a></button><br>
                        <!-- View wishlist button for client -->
                        <button><a href="http://localhost/wealth_affairs/clients/front_end/wishlist.php">View Wishlist</a></button>
                        <!-- Buttons for viewing all tailored ideas and all ideas for client -->
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <button class="product-view" style="cursor: pointer; margin-bottom: 0px;">
                                <a href="http://localhost/wealth_affairs/clients/front_end/all_recommeded_ideas.php">View all tailored ideas</a>
                            </button>
                            <button class="product-view" style="cursor: pointer;">
                                <a href="http://localhost/wealth_affairs/clients/front_end/ideas.php">View all ideas</a>
                            </button>
                        </div>
                    </div>
                    <!-- This div shows the sidebar for the Relationship Manager -->
                    <div class="rm side-profile" style="border: 1px solid gray; flex: 1;">
                        <!-- RM profile image -->
                        <img src="../front_end/images/computer-science-gbb745b0cd_640.png" alt="rm-image" />
                        <!-- RM's name -->
                        <p class="name"><?php echo $_SESSION['rm_fname'].' '. $_SESSION['rm_lname']; ?></p>
                        <!-- RM's email -->
                        <p class="name"><?php echo $_SESSION['rm_email']; ?></p>
                        <!-- RM's title -->
                        <p class="title">Meet Your Relational Manager</p>
                        <!-- Button for viewing all recommended ideas for RM -->
                        <button class="product-view" style="cursor: pointer;">
                            <a href="http://localhost/wealth_affairs/clients/front_end/all_rm_recommeded_ideas.php">View all recommended ideas</a>
                        </button>
                    </div>
                    
            </section>
        </section>
         <!-- Footer -->
        <footer style="border: 1px solid gray">Copyright © 2023 WealthManagement. All Rights Reserved</footer>
      
    </div>
</body>
</html> 