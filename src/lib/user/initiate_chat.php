<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

if ($_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
}

if (isset($_GET['question']) && isset($_GET['img_code'])) {
    $question = $_GET['question'];
    $imgCode = $_GET['img_code'];
    
    $lobbyTemp = fetch(
        'SELECT * FROM lobbies WHERE img_code = ? LIMIT 1',
        ["type" => "s", "value" => $imgCode]
    );

    $query = 'INSERT INTO Shoutbox (Timestamp, Name, EMail, Text, Lobbyid, Senderid) VALUES (?, ?, ?, ?, ?)';
    insert(
        $query,
        ['type' => 's', 'value' => ''.time().''],
        ['type' => 's', 'value' => $_SESSION['user']['username']],
        ['type' => 's', 'value' => $question],
        ['type' => 'i', 'value' => $lobbyTemp["id"]], 
        ['type' => 'i', 'value' => $_SESSION['user']['id']], 
    );
    
    header('Location: https://bibliotheek.live/alperenGit/src/public/user/chat/chat.php?code=' . $imgCode);
    exit();
} else {
    header('Location: https://bibliotheek.live');
    exit();
}
?>
