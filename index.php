<?php
    echo "This is a simple Webpage"."<br><br>";

    $servername = "localhost";
    
    // Database Variables
    $dbname     = "biblwnot_database";
    $username   = "roman4";
    $password   = "es,RV.J3&7Bg'U=";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Checking Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch data
    $sql = "SELECT * FROM users";

    $result = $conn->query($sql);
    
    if ($result = $conn-> query($sql)) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            echo $row['id']." ";
            echo $row['username']." ";
            echo $row['password']." ";
        }
    }
    
    else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
    
    // Closing the connection
    $conn->close();
?>
