<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Wealth Affairs - Fund Administrator</title>
</head>
<?php 
session_start();
if ( !isset($_SESSION['FaID'] )){
    header('Location: http://localhost/wealth_affairs/auth/login.html');
    exit();
}

?>
<body>
<div class="wrapper">
    <div class="sidebar">
        <div class="rm">
            <img class="photo" src="../images/relational-manager-photo.jfif" alt="rm-image" />
            <p class="name" id="name"></p>
            <p class="title">Role: <span id="title-role"></span></p>
            <p>Email: <span id="email"></span></p>
            <p>Phone: <span id="phoneno"></span></p>
        </div>
        <div class="">
            <p><a href="">Dashboard</a></p>
            <p><a href="">Profile</a></p>
        </div>
        <div class="logout">
            <button>
                <a href="http://localhost/wealth_affairs/auth/logout.php">Logout</a>
            </button>
        </div>
        <div class="main">
        <div>
            <h1>Investment Ideas Dashboard</h1>  
            <button><a href="createIdea.php">Create Ideas</a></button>
        </div>
        <div>
            <h2 id="investment-ideas">All Investment Ideas</h2>
            <table>
                <style>
                    table {
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                    }
                    
                    td, th {
                        border: 1px solid #dddddd;
                        text-align: left;
                        padding: 8px;
                    }
                    
                    tr:nth-child(even) {
                        background-color: #dddddd;
                    }
                </style>
                <thead>
                    <tr>
                        <th>Idea ID</th>
                        <th>Instrument Name</th>
                        <th>Product Type</th>
                        <th>Industry</th>
                        <th>Risk Level</th>
                        <th>Currency</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include "backend/dbconnection.php";
                        
                    $sql = "SELECT * FROM ideas";
                    $result = $databaseconnection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $databaseconnection->error);
                    }

                    while ( $row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$row[IdeaID]</td>
                            <td>$row[InstrumentName]</td>
                            <td>$row[ProductType]</td>
                            <td>$row[Industry]</td>
                            <td>$row[RiskLevel]</td>
                            <td>$row[PriceCurrency]</td>
                            <td>$row[Country]</td>
                            <td>$row[Status]</td>
                            <td><button><a href='/wealth_affairs/delete.php?id=$row[IdeaID]'></a>View</button></td>
                        </tr>
                        ";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../auth/validateLogin.js"></script>
</body>
</html>