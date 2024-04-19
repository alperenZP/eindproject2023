<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (!isset($_SESSION['user'])) {
    // Redirect if user is not logged in
    header('Location: /');
    exit();
}

if ($_SESSION["user"]["isTeacher"]) {
    // Redirect teachers to a different page
    header('Location: https://bibliotheek.live');
    exit();
}

// Check if the necessary values are passed via GET
if (isset($_GET['question']) && isset($_GET['img_code'])) {
    $question = $_GET['question'];
    $imgCode = $_GET['img_code'];
    
    $lobbyTemp = fetch(
        'SELECT * FROM lobbies WHERE img_code = ? LIMIT 1',
        ["type" => "s", "value" => $imgCode]
    );

    // Insert into the Shoutbox table
    $query = 'INSERT INTO Shoutbox (Timestamp, Name, EMail, Text, Lobbyid, Senderid) VALUES (?, ?, ?, ?, ?)';
    insert(
        $query,
        ['type' => 's', 'value' => ''.time().''], // Assuming 'Timestamp' column is of string type
        ['type' => 's', 'value' => $_SESSION['user']['username']],
        ['type' => 's', 'value' => ''],
        ['type' => 's', 'value' => $question],
        ['type' => 'i', 'value' => $lobbyTemp["id"]], // Assuming 'Lobbyid' column is of string type
        ['type' => 'i', 'value' => $_SESSION['user']['id']], // Assuming 'Senderid' column is of integer type
    );
    
    // Redirect after successful insertion
    header('Location: https://bibliotheek.live/alperenGit/src/public/user/chat/chat.php?code=' . $imgCode);
    exit();
} else {
    // Redirect if required values are not provided
    header('Location: https://bibliotheek.live');
    exit();
}
?>
