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

if (isset($_POST['edit'])) {
    $testid = $_POST["testid"];
    $test_title = $_POST['test_title'];

    $query = 'UPDATE tests SET title = ? WHERE id = ?';
    insert(
        $query,
        ['type' => 's', 'value' => '' . $test_title . ''],
        ['type' => 'i', 'value' => $testid],
    );

    $questionsFIRST = fetch('SELECT * FROM questions WHERE testid = ' . $testid);

    foreach ($questionsFIRST as $question){
        $qid = $question["id"];
        $questiontext = $qid . 'questiontext';
        $correct = $qid. 'correct';
        $wrong1 = $qid . 'wrong1';
        $wrong2 = $qid . 'wrong2';
        $wrong3 = $qid . 'wrong3';

        $query = 'UPDATE questions SET text = ?, correct_option = ?, incorrect1 = ?, incorrect2 = ?, incorrect3, = ? WHERE id = ?';
        insert(
            $query,
            ['type' => 's', 'value' => '' . $_[$questiontext] . ''],
            
            ['type' => 's', 'value' => '' . $_POST[$questiontext] . ''],
            ['type' => 's', 'value' => '' . $_POST[$correct] . ''],
            ['type' => 's', 'value' => '' . $_POST[$wrong1] . ''],
            ['type' => 's', 'value' => '' . $_POST[$wrong2] . ''],
            ['type' => 's', 'value' => '' . $_POST[$wrong3] . ''],
            ['type' => 'i', 'value' => $qid],
        );
    }

    

    

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/edit_test.php?testid=' . $testid . '');
    exit();
}

header('Location: https://bibliotheek.live');
exit();
