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

if (isset($_POST['add'])) {
    $creatorid = $_SESSION["user"]["id"];
    $bookid = $_POST['bookid'];
    $chapterid = $_POST['chapterid'];
    $question = $_POST['question'];
    $file = $_FILES['png'];

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $imgCode = uniqid();
    $imgName = $imgCode . '.' . $extension;
    $imgTmpName = $file['tmp_name'];

    $targetDir = PUBLIC_R . "/img/";
    $targetFile = $targetDir . $imgName;
    move_uploaded_file($imgTmpName, $targetFile);


    $query = 'INSERT INTO lobbies (bookid, chapterid, senderid, question, img_code) VALUES (?, ?, ?, ?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 'i', 'value' => $chapterid],
        ['type' => 'i', 'value' => $senderid],
        ['type' => 's', 'value' => $question],
        ['type' => 's', 'value' => $imgCode],
    );
}

echo "nah";
