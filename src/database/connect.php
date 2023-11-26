<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';

$servername = DB_SERVER;
$dbname = DB_NAME;
$username = DB_USERNAME;
$password = DB_PASSWORD;

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
  die('Connection failed: ' . $connection->connect_error);
}
?>
