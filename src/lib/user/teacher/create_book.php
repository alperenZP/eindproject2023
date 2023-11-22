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
    $subjectid = $_POST['bookSubject'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $accessCode = uniqid();

    $query = 'INSERT INTO books (creatorid, title, subjectid, description, accessCode) VALUES (?, ?, ?, ?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $creatorid],
        ['type' => 's', 'value' => '' . $title . ''],
        ['type' => 'i', 'value' => $subjectid],
        ['type' => 's', 'value' => '' . $description . ''],
        ['type' => 's', 'value' => '' . $accessCode . ''],
    );
    header('Location: https://bibliotheek.live/src/public/teacher/add_chapters.php');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
