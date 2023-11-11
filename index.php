<?php
    require "connect.php";
    echo "This is a simple Webpage"."<br><br>";

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
