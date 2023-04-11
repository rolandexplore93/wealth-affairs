<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "wealth_affairs";

    $databaseconnection = new mysqli($servername, $username, $password, $database);

    if ($databaseconnection->connect_error) {
        die("Error connecting to: " . $databaseconnection->connect_error);
    }

    echo "Connected to database";
?>