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
        ["type" => "s", "value" => $code]
    );
    $userid = $_SESSION["user"]["id"];
    if ($_SESSION["user"]["isTeacher"]){
        $hasAccess = 0;
    } else {
        $hasAccess = 1;
    }

    if (isset($book["id"])) {
        $book_connection = fetch(
            'SELECT *, count(*) AS "aantal" FROM book_connections WHERE bookid = ? AND userid = ?',
            ['type' => 'i', 'value' => $book["id"]],
            ['type' => 'i', 'value' => $userid],
        );

        if ($book_connection["aantal"] > 0) {
            header('Location: https://bibliotheek.live/alperenGit/src/public/user/enter_code.php?failure=1');
        } else {
            $query = 'INSERT INTO book_connections (bookid, userid, hasAccess) VALUES (?, ?, ?)';
            insert(
                $query,
                ['type' => 'i', 'value' => $book["id"]],
                ['type' => 'i', 'value' => $userid],
                ['type' => 'i', 'value' => $hasAccess],
            );
            header('Location: https://bibliotheek.live/alperenGit/src/public/user/enter_code.php?bookid=' . $book["id"] . '');
        }
    } else {
        header('Location: https://bibliotheek.live/alperenGit/src/public/user/enter_code.php?failure=2');
    }



    exit();
}

header('Location: https://bibliotheek.live');
exit();
