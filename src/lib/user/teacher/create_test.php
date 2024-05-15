<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

echo var_dump($_POST);

for ($x = 0; $x < $_SESSION["questions_amount"]; $x++){

    $correct = $x . 'correct';
    $wrong1 = $x . 'wrong1';
    $wrong2 = $x . 'wrong2';
    $wrong3 = $x . 'wrong3';
    $questiontitle = $x . 'question_title';

    echo '
        <h1>Question '.$x.': '.$_POST[$questiontitle].'</h1><br>
        Correct: '.$_POST[$correct].'<br>
        Wrong 1: '.$_POST[$wrong1].'<br>
        Wrong 2: '.$_POST[$wrong2].'<br>
        Wrong 3: '.$_POST[$wrong3].'<br>
    ';
}
/*

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

    $query = 'INSERT INTO tests (bookid, title) VALUES (?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 's', 'value' => '' . $title . ''],
    );


    header('Location: https://bibliotheek.live/alperenGit/src/public/user/view_exercises.php?bookid=' . $bookid);
    exit();
}

header('Location: https://bibliotheek.live');
exit();
*/
