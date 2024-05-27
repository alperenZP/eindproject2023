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

if (isset($_GET['questionid'])) {
    $question = fetch(
        'SELECT * FROM `questions` WHERE id = ?',
        ['type' => 'i', 'value' => $_GET['id']]
    );

    $testid = $question["testid"];

    $query = 'DELETE FROM questions WHERE id = ?';
    insert(
        $query,
        ['type' => 'i', 'value' => $_GET['questionid']],
    );

    echo $testid;

    //header('Location: https://bibliotheek.live/alperenGit/src/public/user/teacher/edit_test.php?testid=20');
    //exit();
}

//header('Location: https://bibliotheek.live');
//exit();