<?php
$servername = "localhost";
$database = "biblwnot_database";
$username = "biblwnot_roman4";
$password = "es,RV.J3&7Bg'U=";
// Create connection using musqli_connect function
$conn = mysqli_connect($servername, $username, $password, $database);
// Connection Check
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}else{
   echo "Connected Successfully!";
   $conn->close();
}

?>