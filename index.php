<?php
require "connect.php";
echo "Hello woooooolrld!";

$qu="INSERT INTO users(username, password) VALUES ('values1', 'values2')";

//query execution
if ($conn->query($qu)===TRUE) {
    echo "Inserted Successfully";
    $conn->close();
} else {
    echo "Insert Failed ".$conn->error;
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <button class="btn">Button</button>
    <button class="btn btn-neutral">Neutral</button>
    <button class="btn btn-primary">Primary</button>
    <button class="btn btn-secondary">Secondary</button>
    <button class="btn btn-accent">Accent</button>
    <button class="btn btn-ghost">Ghost</button>
    <button class="btn btn-link">Link</button>
</body>
</html>


