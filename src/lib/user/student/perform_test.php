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
    $amount_questions = $_POST["amount_of_questions"];

    $question = fetch(
        'SELECT * FROM questions WHERE id = ?',
        ["type" => "i", "value" => $question_id]
    );
    $userid = $_SESSION["user"]["id"];

    $check_if_question_already_answered = fetch(
        'SELECT *,count(*) AS "amount" FROM scores WHERE questionid = ? AND userid = ?',
        ["type" => "i", "value" => $question_id],
        ["type" => "i", "value" => $userid]
    );

    if ($check_if_question_already_answered["count"] > 0){
        $query = 'UPDATE scores SET isCorrect = ? WHERE questionid = ? AND userid = ?';
        insert(
            $query,
            ['type' => 'i', 'value' => $isAnswerCorrect],
            ['type' => 'i', 'value' => $question_id],
            ['type' => 'i', 'value' => $userid],
        );
    } else {
        $query = 'INSERT INTO scores (questionid, userid, isCorrect) VALUES (?, ?, ?)';
        insert(
                $query,
                ['type' => 'i', 'value' => $question_id],
                ['type' => 'i', 'value' => $userid],
                ['type' => 'i', 'value' => $isAnswerCorrect],
        );
    }


    

    
    header('Location: https://bibliotheek.live/alperenGit/src/public/user/student/perform_test.php?x=1&testid='.$testid);

    exit();
} 



header('Location: https://bibliotheek.live');
exit();