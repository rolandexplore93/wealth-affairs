<?php
    $databaseConnection = new mysqli("localhost", "root", "", "test");
    if ($databaseConnection -> connect_error){
        die("Connection failed. " . $databaseConnection -> connect_error);
    };
    echo "Connection successful";

   $instrumentName = $_POST["instrument-name"];
   $instrumentDn = $_POST["instrument-Dn"];
   $BasicInstruments = $_POST["instrument-name"];
   $instrumentName = $_POST["instrument-name"];
   $instrumentName = $_POST["instrument-name"];
   $instrumentName = $_POST["instrument-name"];
   $instrumentName = $_POST["instrument-name"];


    echo $instrumentName
?>