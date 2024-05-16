<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

if (isset($_POST['submit'])) {
    $_SESSION["position_in_test"]++;
    $isAnswerCorrect = $_POST["result_question"];
    $question_id = $_POST["question_id"];
    $testid = $_POST["test_id"];

    $question = fetch(
        'SELECT * FROM questions WHERE id = ?',
        ["type" => "i", "value" => $question_id]
    );
    $userid = $_SESSION["user"]["id"];

    echo $question["correct_option"] .' is equal to '. $guess  .': '. $isAnswerCorrect;
    /*
    $query = 'INSERT INTO scores (questionid, userid, isCorrect) VALUES (?, ?, ?)';
    insert(
            $query,
            ['type' => 'i', 'value' => $question_id],
            ['type' => 'i', 'value' => $userid],
            ['type' => 'i', 'value' => $isAnswerCorrect],
    );

    header('Location: https://bibliotheek.live/alperenGit/src/public/user/student/perform_test.php?x=1&testid='.$testid);

    exit();
    */
} 



/*
header('Location: https://bibliotheek.live');
exit();
*/