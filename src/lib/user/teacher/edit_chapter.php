<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_POST['edit'])) {
    $bookid = $_POST['bookid'];
    $chapterid = $_POST['chapterid'];
    $title = $_POST['title'];
    $new_position = $_POST["new_position"];

    if (isset($_FILES['pdf'])) {
        $file = $_FILES['pdf'];
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $pdfCode = $_POST["pdf_code"];
        $pdfName = $pdfCode . '.' . $extension;
        $pdfTmpName = $file['tmp_name'];

        $targetDir = PUBLIC_R . "/pdf/";
        $targetFile = $targetDir . $pdfName;
        move_uploaded_file($pdfTmpName, $targetFile);
    }

    $query = 'UPDATE book_chapters SET chapterIndex = chapterIndex - 1 WHERE bookid = ? AND chapterIndex = ?';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 'i', 'value' => $new_position + 1],
    );

    $query = 'UPDATE book_chapters SET title = ?, chapterIndex = ? WHERE id = ?';
    insert(
        $query,
        ['type' => 's', 'value' => '' . $title . ''],
        ['type' => 'i', 'value' => $new_position],
        ['type' => 'i', 'value' => $chapterid],
    );

    

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/view_book.php?book=' . $bookid . '');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
