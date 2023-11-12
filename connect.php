<?php
    $servername = "localhost";
    
    // Database Variables
    $dbname     = "biblwnot_database";
    $username   = "biblwnot_roman4";
    $password   = "es,RV.J3&7Bg'U=";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Checking Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>