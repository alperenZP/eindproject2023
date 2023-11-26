<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

if (isset($_POST['add'])) {
    $code = $_POST['code'];
    $book = fetch(
        'SELECT * FROM books WHERE accessCode = ? LIMIT 1',
        ["type" => "i", "value" => $code]
    );
    $userid = $_SESSION["user"]["id"];

    if (isset($book["id"])) {
        $query = 'INSERT INTO book_connections (bookid, userid) VALUES (?, ?)';
        insert(
            $query,
            ['type' => 'i', 'value' => $bookid],
            ['type' => 's', 'value' => $userid],
        );
        header('Location: https://bibliotheek.live/alperenGit/src/public/user/enter_code.php?bookid=' . $bookid . '');
    } else {
        header('Location: https://bibliotheek.live/alperenGit/src/public/user/enter_code.php?failure=1');
    }



    exit();
}

header('Location: https://bibliotheek.live');
exit();
