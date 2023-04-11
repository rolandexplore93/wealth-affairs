<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Idea form</title>
</head>
<body>
<div class="wrapper">
        <div class="sidebar">
            <div class="rm">
                <img class="photo" src="../images/relational-manager-photo.jfif" alt="rm-image" />
                <p class="name">Francis, O. A</p>
                <p class="title">Funds Administrator</p>
            </div>
            <div class="">
                <p><a href="">Dashboard</a></p>
                <p><a href="">Profile</a></p>
            </div>
            <div class="logout">
                <button>Logout</button>
                <p><a href="../index.html">Go to homepage</a></p>
            </div>
            <div class="main">
            <div>
                <h1>FA Ideas Uploading Dashboard</h1>  
                <button><a href="createIdea.php">Create Ideas</a></button>
            </div>
            <div>
                <!-- <button><a href="">All ideas</a></button> -->
                <h2 id="investment-ideas">Investment Ideas</h2>
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
                    <th>ID</th>
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

                        // $servername = "localhost";
                        // $username = "root";
                        // $password = "";
                        // $database = "wealth_affairs";

                        // $connection = new mysqli($servername, $username, $password, $database);

                        // if ($connection->connect_error) {
                        //     die("Error connecting to: " . $connection->connect_error);
                        // }
                         
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
                                <td>Rejected</td>
                                <td><button>Delete</button><a href='/wealth_affairs_fa/delete.php?id=$row[IdeaID]'></a></td>
                        </tr>
                            ";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>