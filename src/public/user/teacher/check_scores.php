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

$_SESSION["testid"] = $_GET["testid"];

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

$users = fetch_as_array('SELECT *, book_connections.id AS "bookconnectionid", users.id AS "userid" FROM `users` INNER JOIN book_connections ON (book_connections.userid = users.id) INNER JOIN books ON (books.id = book_connections.bookid) WHERE bookid = ? AND isTeacher = 0 AND isBlocked = 0',
    ['type' => 'i', 'value' => $test["bookid"]],
);

$test_questions = fetch(
    'SELECT *, count(*) AS "questions_amount" FROM questions WHERE testid = ?',
    ['type' => 'i', 'value' => $test["id"]],
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
        <?php echo 'Scoren van studenten op '.$test["title"].''; ?>
    </h1>
    <div class="divider"></div> 
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <td><b>Gebruikersnaam</b></td>
                    <td><b>KETSEL</b></td>
                    <td><b>Resultaten op test per vraag</b></td>
                </tr>
                <div id="refreshable-content"> 
                    <!-- rows from scores_list will be inserted here -->
                </div>
            </tbody>
        </table>
    </div>
</div>

<script>
    function refreshContent() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://bibliotheek.live/alperenGit/src/public/user/teacher/scores_list.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the content with the response
                document.getElementById("refreshable-content").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    setInterval(refreshContent, 4000);
</script>
