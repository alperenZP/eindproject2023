<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

$testid = $_SESSION["testid"];

// Fetch test details
$test = fetch(
    'SELECT * FROM tests WHERE id = ?',
    ['type' => 'i', 'value' => $testid]
);

// Check if test exists
if (!$test) {
    echo "Test not found!";
    exit;
}

// Fetch users who took the test
$users = fetch_as_array(
    'SELECT users.username, scores.isCorrect FROM users 
    INNER JOIN scores ON users.id = scores.userid 
    WHERE scores.testid = ?',
    ['type' => 'i', 'value' => $testid]
);

// Check if users are fetched
if (!$users) {
    echo "No users found!";
    exit;
}

// Fetch total number of questions
$test_questions = fetch(
    'SELECT COUNT(*) AS questions_amount FROM questions WHERE testid = ?',
    ['type' => 'i', 'value' => $test["id"]]
);

// Check if test questions are fetched
if (!$test_questions) {
    echo "No questions found for the test!";
    exit;
}

$questions_amount = $test_questions["questions_amount"];

// Output table rows
foreach ($users as $user) {
    $test_scores = fetch_as_array(
        'SELECT isCorrect FROM scores 
        WHERE testid = ? AND userid = ?',
        ['type' => 'ii', 'value' => $testid, 'value2' => $user["userid"]]
    );

    // Check if test scores are fetched
    if (!$test_scores) {
        echo "No scores found for user: ".$user["username"];
        continue; // Move to the next user
    }

    $correct_answers = 0;
    foreach ($test_scores as $score) {
        if ($score["isCorrect"] == 1) {
            $correct_answers++;
        }
    }

    $percentage = ($correct_answers / $questions_amount) * 100;
    $status = ($percentage == 100) ? "100%" : number_format($percentage, 2) . "%";

    echo '
        <tr>
            <td>'.$user["username"].'</td>
            <td>'.$status.'</td>
            <td>';
    for ($i = 0; $i < $questions_amount; $i++) {
        if (isset($test_scores[$i])) {
            echo $test_scores[$i]["isCorrect"] == 1 ? "✔️" : "❌";
        } else {
            echo "❓";
        }
    }
    echo '</td>
        </tr>';
}

// If no users found
if (empty($users)) {
    echo '
        <div role="alert" class="alert alert-info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Er staan geen gebruikers in deze lijst.</span>
        </div>
    ';
}
?>
