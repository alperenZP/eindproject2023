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

    $query = 'INSERT INTO tests (title, bookid) VALUES (?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 's', 'value' => '' . $title . ''],
    );


    header('Location: https://bibliotheek.live/alperenGit/src/public/user/teacher/enter_code.php');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
