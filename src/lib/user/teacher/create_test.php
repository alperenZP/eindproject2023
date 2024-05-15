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

if (isset($_POST['create']) && isset($_SESSION["questions_amount"])) {
    $bookid = $_POST['bookid'];
    $title = $_POST['title'];

    $query = 'INSERT INTO tests (bookid, title) VALUES (?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 's', 'value' => '' . $title . ''],
    );

    $thatTest = fetch('SELECT * FROM tests ORDER BY id ASC LIMIT 1');

    for ($x = 0; $x < $_SESSION["questions_amount"]; $x++) {

        $questiontitle = $x . 'question_title';
        $correct = $x . 'correct';
        $wrong1 = $x . 'wrong1';
        $wrong2 = $x . 'wrong2';
        $wrong3 = $x . 'wrong3';

        $query = 'INSERT INTO questions (testid, text, correct_option, incorrect1, incorrect2, incorrect3) VALUES (?, ?, ?, ?, ?, ?)';
        insert(
            $query,
            ['type' => 'i', 'value' => $thatTest["id"]],
            ['type' => 's', 'value' => '' . $_POST[$questiontitle] . ''],
            ['type' => 's', 'value' => '' . $_POST[$correct] . ''],
            ['type' => 's', 'value' => '' . $_POST[$wrong1] . ''],
            ['type' => 's', 'value' => '' . $_POST[$wrong2] . ''],
            ['type' => 's', 'value' => '' . $_POST[$wrong3] . ''],
        );
    }

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/view_exercises.php?bookid=' . $bookid);
    exit();
}

header('Location: https://bibliotheek.live');
exit();
