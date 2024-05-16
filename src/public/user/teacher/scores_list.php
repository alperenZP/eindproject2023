<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

$test = fetch(
    'SELECT * FROM tests WHERE id = ?',
    ['type' => 'i', 'value' => $_SESSION["testid"]]
);

$users = fetch_as_array('SELECT *, book_connections.id AS "bookconnectionid", users.id AS "userid" FROM `users` INNER JOIN book_connections ON (book_connections.userid = users.id) INNER JOIN books ON (books.id = book_connections.bookid) WHERE bookid = ? AND isTeacher = 0 AND isBlocked = 0',
    ['type' => 'i', 'value' => $test["bookid"]],
);

$test_questions = fetch(
    'SELECT *, count(*) AS "questions_amount" FROM questions WHERE testid = ?',
    ['type' => 'i', 'value' => $test["id"]],
);

$questions_amount = $test_questions["questions_amount"];

foreach ($users as $user) {
    $test_scores = fetch(
        'SELECT * FROM scores WHERE testid = ? AND userid = ?',
        ['type' => 'i', 'value' => $test["id"]],
        ['type' => 'i', 'value' => $user["userid"]]
    );

    $score_array = [];

    for ($i=0; $i < $questions_amount; $i++) {
        if (isset($test_scores[$i]["id"])){
            if ($test_scores[$i]["isCorrect"] == 1){
                array_push($score_array, "✔️");
            } else {
                array_push($score_array, "❌");
            }
        } else {
            array_push($score_array, "❓");
        }
    }

    $string = implode(" ", $score_array);

    echo '
        <tr>
            <td>'.$user["username"].'</td>
            <td>'.getStatus($score_array).'</td>
            <td>'.$string.'</td>
        </tr> 
    ';
}

if (count($users) == 0){
    echo '
        <div role="alert" class="alert alert-info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Er staan geen gebruikers in deze lijst.</span>
        </div>
    ';
}
?>