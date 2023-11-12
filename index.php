<!doctype html>
<html data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./dist/output.css" rel="stylesheet">
</head>

<body>
    <button class="btn btn-active">Default</button>
    <button class="btn btn-active btn-neutral">Neutral</button>
    <button class="btn btn-active btn-primary">Primary</button>
    <button class="btn btn-active btn-secondary">Secondary</button>
    <button class="btn btn-active btn-accent">Accent</button>
    <button class="btn btn-active btn-ghost">Ghost</button>
    <button class="btn btn-active btn-link">Link</button>

    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
</body>

</html>

<?php
require "connect.php";
echo "This is a simple Webpege" . "<br><br>";

// SQL query to fetch data
$sql = "SELECT * FROM users";

$result = $conn->query($sql);

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        echo $row['id'] . " ";
        echo $row['username'] . " ";
        echo $row['password'] . " ";
    }
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}

// Closing the connection
$conn->close();
?>