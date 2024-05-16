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
    $guess = $_POST['radio_guess'];
    $question_id = $_POST["question_id"];

    $question = fetch(
        'SELECT * FROM questions WHERE id = ?',
        ["type" => "i", "value" => $question_id]
    );
    $userid = $_SESSION["user"]["id"];

    if (isset($question["id"])) {
        
        $isAnswerCorrect = ($question["correct_option"] == $guess);
        $query = 'INSERT INTO scores (questionid, userid, isCorrect) VALUES (?, ?, ?)';
            insert(
                $query,
                ['type' => 'i', 'value' => $question_id],
                ['type' => 'i', 'value' => $userid],
                ['type' => 'i', 'value' => $isAnswerCorrect],
        );

        header('Location: https://bibliotheek.live/alperenGit/src/public/user/enter_code.php?bookid=' . $book["id"] . '');
    } else {
        header('Location: https://bibliotheek.live/alperenGit/src/public/user/enter_code.php?failure=2');
    }



    exit();
}

header('Location: https://bibliotheek.live');
exit();