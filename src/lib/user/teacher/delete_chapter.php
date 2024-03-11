<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_POST['edit'])) {
    $bookid = $_POST['bookid'];
    $chapterid = $_POST['chapterid'];

    $query = 'DELETE FROM book_chapters WHERE id = ?';
    insert(
        $query,
        ['type' => 'i', 'value' => $chapterid],
    );    

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/view_book.php?book=' . $bookid . '');
    exit();
}

header('Location: https://bibliotheek.live');
exit();