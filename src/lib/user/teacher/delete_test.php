<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

if (!$_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
}

if (isset($_GET['testid'])) {
    $test = fetch(
        'SELECT * FROM `tests` WHERE id = ?',
        ['type' => 'i', 'value' => $_GET['testid']]
    );

    $bookid = $test["bookid"];

    $query = 'DELETE FROM tests WHERE id = ?';
    insert(
        $query,
        ['type' => 'i', 'value' => $_GET['testid']],
    );

    $query = 'DELETE FROM questions WHERE testid = ?';
    insert(
        $query,
        ['type' => 'i', 'value' => $_GET['testid']],
    );

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/view_exercises.php?bookid='. $bookid);
    exit();
}

header('Location: https://bibliotheek.live');
exit();