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
    $creatorid = $_SESSION["user"]["id"];
    $bookid = $_POST['bookid'];
    $title = $_POST['title'];

    $lastChapter = fetchSingle(
        'SELECT * FROM book_chapters WHERE bookid = ? ORDER BY chapterIndex DESC LIMIT 1',
        ["type" => "i", "value" => $bookid]
    );

    if (isset($lastChapter["chapterIndex"])){
        $lastChapterIndex = $lastChapter["chapterIndex"];
    } else {
        $lastChapterIndex = 0;
    }


    $query = 'INSERT INTO book_chapters (bookid, title, chapterIndex) VALUES (?, ?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 's', 'value' => '' . $title . ''],
        ['type' => 'i', 'value' => $lastChapterIndex + 1]
    );
    header('Location: https://bibliotheek.live/src/public/teacher/add_chapters.php');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
