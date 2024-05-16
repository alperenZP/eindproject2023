<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

if (!$_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';
$theme = 'dark';

$test = fetch(
    'SELECT * FROM tests WHERE id = ?',
    ['type' => 'i', 'value' => $_GET["testid"]]
);

$book_access = fetch(
    'SELECT *,count(*) AS "amount" FROM book_connections WHERE userid = ' . $_SESSION['user']['id'] . ' AND bookid = ?',
    ['type' => 'i', 'value' => $test["bookid"]]
);

if ($book_access["amount"] == 0) {
    header('Location: https://bibliotheek.live');
    exit();
}

$users = fetch_as_array('SELECT *, book_connections.id AS "bookconnectionid", users.id AS "userid" FROM `users` INNER JOIN book_connections ON (book_connections.userid = users.id) INNER JOIN books ON (books.id = book_connections.bookid) WHERE bookid = ? AND isBlocked = 0',
    ['type' => 'i', 'value' => $test["bookid"]],
);

$test_questions = fetch(
    'SELECT *, count(*) AS "questions_amount" FROM questions WHERE testid = ?',
    ['type' => 'i', 'value' => $test["testid"]],
);

$questions_amount = $test_questions["questions_amount"];

?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Bekijk studenten</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">
        <?php
        echo 'Scoren van studenten op '.$test["title"].'';
        ?>
    </h1>

    <div class="divider"></div> 
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <td><b>Gebruikersnaam</b></td>
                    <td><b>Resultaten op test per vraag</b></td>
                </tr>
                <!-- row -->
                <?php
                foreach ($users as $user) {
                    $test_scores = fetch(
                        'SELECT * FROM scores WHERE testid = ? AND userid = ?',
                        ['type' => 'i', 'value' => $test["testid"]],
                        ['type' => 'i', 'value' => $user["userid"]]
                    );

                    $score_array = [];

                    for ($i=0; $i < $questions_amount; $i++) {
                        if (isset($score_array[$i]["id"])){
                            if ($score_array[$i]["isCorrect"] == 1){
                                array_push($score_array, "✔️");
                            } else {
                                array_push($score_array, "❌");
                            }
                        } else {
                            array_push($score_array, "❓");
                        }
                    }

                    $html = '<table style="border-collapse: collapse; border: 1px solid white;">';

                    $html .= '<tr>';
                    foreach ($score_array as $element) {
                        $html .= '<td style="border: 1px solid white; padding: 5px;">' . $element . '</td>';
                    }
                    $html .= '</tr>';

                    $html .= '</table>';

                    echo '
                        <tr>
                            <td>'.$user["username"].'</td>
                            <td>'.$html.'</td>
                        </tr> 
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <?php
        if (count($users) == 0){
            echo '
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Er staan geen gebruikers in deze lijst.</span>
                </div>
            ';
        }
    ?>
</div>