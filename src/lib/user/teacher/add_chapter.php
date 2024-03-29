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

if (isset($_POST['add'])) {
    $creatorid = $_SESSION["user"]["id"];
    $bookid = $_POST['bookid'];
    $title = $_POST['title'];
    $file = $_FILES['pdf'];

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $pdfCode = uniqid();
    $pdfName = $pdfCode . '.' . $extension;
    $pdfTmpName = $file['tmp_name'];

    $targetDir = PUBLIC_R . "/pdf/";
    $targetFile = $targetDir . $pdfName;
    move_uploaded_file($pdfTmpName, $targetFile);

    $lastChapter = fetch(
        'SELECT * FROM book_chapters WHERE bookid = ? ORDER BY chapterIndex DESC LIMIT 1',
        ["type" => "i", "value" => $bookid]
    );

    if (isset($lastChapter["chapterIndex"])) {
        $lastChapterIndex = $lastChapter["chapterIndex"] + 1;
    } else {
        $lastChapterIndex = 0;
    }


    $query = 'INSERT INTO book_chapters (bookid, title, chapterIndex, pdf_code) VALUES (?, ?, ?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 's', 'value' => '' . $title . ''],
        ['type' => 'i', 'value' => $lastChapterIndex],
        ['type' => 's', 'value' => $pdfCode],
    );
    header('Location: https://bibliotheek.live/alperenGit/src/public/user/teacher/add_chapter.php?bookid=' . $bookid . '');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
