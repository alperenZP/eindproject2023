<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./dist/output.css" rel="stylesheet">
</head>
<body>
  <h1 class="text-3xl font-bold underline">
    Hello world!
  </h1>
</body>
</html>

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