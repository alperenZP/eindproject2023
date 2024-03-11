<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_GET['id'])) {
    $book_connection = fetch(
        'SELECT * FROM `book_connections` WHERE id = ?',
        ['type' => 'i', 'value' => $_GET['id']]
    );

    $query = 'UPDATE book_connections SET isBlocked = 1 WHERE id = ?';
    insert(
        $query,
        ['type' => 'i', 'value' => $_GET['id']],
    );

    

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/view_book.php?book=' . $book_connection["bookid"] . '');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
