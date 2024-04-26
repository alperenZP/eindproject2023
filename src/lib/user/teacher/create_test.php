<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

if (!$_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
}

if (isset($_POST['create'])) {
    $bookid = $_POST['bookid'];
    $title = $_POST['title'];
    
    $query = 'INSERT INTO books (creatorid, title, subjectid, description, accessCode) VALUES (?, ?, ?, ?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $creatorid],
        ['type' => 's', 'value' => '' . $title . ''],
        ['type' => 'i', 'value' => $subjectid],
        ['type' => 's', 'value' => '' . $description . ''],
        ['type' => 's', 'value' => '' . $accessCode . ''],
    );

    $book = fetch('SELECT * FROM books WHERE accessCode = "' . $accessCode.'"');

    $query = 'INSERT INTO book_connections (bookid, userid) VALUES (?, ?)';
           insert(
                $query,
                ['type' => 'i', 'value' => $book["id"]],
                ['type' => 'i', 'value' => $_SESSION["user"]["id"]],
            );
    
    header('Location: https://bibliotheek.live/alperenGit/src/public/user/teacher/add_chapter.php');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
