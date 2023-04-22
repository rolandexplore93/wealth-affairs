<?php 
    // This starts the session before running the PHP script
    // Once the session starts and the RM ID is not found in the $_SESSION, this implies that the user is not authenticated to access rm page. Hence, the page will redirect the user to the login page and exit this script
    session_start();
    if ( !isset($_SESSION['RmID']) ){
        header('Location: http://localhost/wealth_affairs/auth/login.html');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Portal</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="rm">
                <img class="photo" src="../images/relational-manager-photo.jfif" alt="rm-image" />
                <p class="name" id="name"></p>
                <p class="title">Role: <span id="title-role"></span></p>
                <p>Email: <span id="email"></span></p>
                <p>Phone: <span id="phoneno"></span></p>
            </div>
            <div class="logout"> 
                <!-- This allows RM to logout of the application -->
                <button>
                    <a href="http://localhost/wealth_affairs/auth/logout.php">Logout</a>
                </button>
            </div>
        </div>
        <!-- Page content -->
        <div class="main">
            <div class="summary">
                <h1>Investment Portal Dashboard</h1>  
            </div>
            <!-- The implementation of JavaScript tab on the RM page enables the RM portal to be behave as a Single Page Application (SPA).
            With this, all the pages and activities associated with RM roles works within this page (http://localhost/wealth_affairs/rm/index.php). -->
            <div class="tabs">
                <div class="tablink " id="tab__products" onclick="openTabContent(event, 'products');">
                    <a href="javascript:void(0)" >All products</a>
                </div>
                <div class="tablink " id="tab__products" onclick="openTabContent(event, 'ideas');">
                    <a href="javascript:void(0)" >All Ideas</a>
                </div>
                <div class="tablink " id="tab__products" onclick="openTabContent(event, 'clients');">
                    <a href="javascript:void(0)" >All Clients</a>
                </div>
            </div>
            <!-- Content page for all products (i.e approved ideas accepted by the RM) -->
            <div id="products" class="tab__content" style="isplay: one;">
                <div class="searchbar">
                    <input type="text">
                    <button class="filter">Filter</button>
                    <button class="sort">Sort</button>
                </div>
                <div class="products">
                    <!-- This is a reusable component created with Javascript class that extend an HTML element from the DOM.
                    This will display all approved ideas-->
                    <created-investment-cards class="cards"></created-investment-cards>
                </div>
                <div class="navigation">
                    <button>Previous</button> 1 <button>Next</button>
                </div>
            </div>
            <!-- content display for all ideas -->
            <div id="ideas" class="tab__content" style="display: none;">
                <!-- It uses a reusable component created with Javascript class that extend an HTML element from the DOM.
                This will display all ideas created by the FA -->
                <ideas-pro></ideas-pro>
            </div>
            <!-- content display for all registered clients -->
            <div id="clients" class="tab__content" style="display: none;">
                <!-- It uses a reusable component created with Javascript class that extend an HTML element from the DOM.
                This will display all clients who registered on the Wealth Affairs website -->
                <client-profile></client-profile>
            </div>
        </div>
    </div>

    <!-- Javascript files -->
    <script src="./script.js" type="text/javascript"></script>
    <script type="text/javascript" src="./clients/clients.js"></script>
    <script src="../auth/validateLogin.js"></script>
</body>
</html>