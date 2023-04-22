<?php
    // The database connection to mysql using mysqli() queries 
    $databaseConnection = new mysqli("localhost", "root", "", "wealth_affairs");
    if ($databaseConnection -> connect_error){
        die("Connection failed. " . $databaseConnection -> connect_error);
    };
    // echo "Connection successful";
?>

