<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

$testid = $_SESSION["testid"];

$test = fetch(
    'SELECT * FROM tests WHERE id = ?',
    ['type' => 'i', 'value' => $testid]
);

if (!$test) {
    echo "Test not found!";
    exit;
}

$users = fetch_as_array(
    'SELECT users.username, scores.isCorrect FROM users 
    INNER JOIN scores ON users.id = scores.userid 
    WHERE scores.testid = ?',
    ['type' => 'i', 'value' => $testid]
);

foreach ($users as $user) {
    $status = $user["isCorrect"] ? "✔️" : "❌";
    echo '<tr>
        <td>'.$user['username'].'</td>
        <td>'.$status.'</td>
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
