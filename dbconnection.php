<?php
    $databaseConnection = new mysqli("localhost", "root", "", "wealth_affairs");
    if ($databaseConnection -> connect_error){
        die("Connection failed. " . $databaseConnection -> connect_error);
    };
    echo "Connection successful";
?>