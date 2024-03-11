<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_GET['id'])) {
    $chapter = fetch(
        'SELECT * FROM `book_chapters` WHERE id = ?',
        ['type' => 'i', 'value' => $_GET['id']]
    );
    $chapterid = $_GET['id'];

    $query = 'DELETE FROM book_chapters WHERE id = ?';
    insert(
        $query,
        ['type' => 'i', 'value' => $chapterid],
    );    

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/view_book.php?book=' . $chapter["bookid"] . '');
    exit();
}

header('Location: https://bibliotheek.live');
exit();