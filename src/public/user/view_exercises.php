<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

$theme = 'dark';

$book_access = fetch(
    'SELECT *,count(*) AS "amount" FROM book_connections WHERE userid = ' . $_SESSION['user']['id'] . ' AND isBlocked = 0 AND bookid = ?',
    ['type' => 'i', 'value' => $_GET["book"]]
);

if ($book_access["amount"] == 0) {
    header('Location: https://bibliotheek.live');
    exit();
}

$book = fetch(
    'SELECT * FROM books WHERE id = ?',
    ['type' => 'i', 'value' => $_GET["bookid"]]
);
$tests = fetch_as_array(
    'SELECT *, tests.title AS "testTitle", books.id AS "bookid" FROM `tests` INNER JOIN books ON (books.id = tests.bookid) WHERE bookid = ? ORDER BY tests.id ASC',
    ['type' => 'i', 'value' => $_GET["bookid"]]
);

?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>
        <?php echo $book["title"] ?> oefeningen
    </title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">
        <?php
        echo $book["title"];
        ?> oefeningen
    </h1>

    <ul class="menu menu-horizontal bg-base-200 w-400">
        <div class="divider"></div>
        <li><a href="https://bibliotheek.live/alperenGit/src/public/user/view_book.php?book=<?php echo $book["id"]?>">Boek</a></li>
        <li><a class="active">Oefeningen</a></li>
        <li><a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/check_students.php?bookid=<?php echo $_GET["book"]?>">Studenten</a></li>
    </ul>

    <div class="divider"></div> 

    <div class="card w-96 bg-primary text-primary-content">
        <div class="card-body">
            <p>
                Klik op een van de volgende tests om te beginnen
            </p>
        </div>
    </div>


    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <th> </th>
                    <th>Titel</th>
                    <th> </th>
                    <th> </th>
                    <?php
                    if ($_SESSION['user']['isTeacher']) {
                        echo '
                                <th> </th>
                            ';
                    }
                    ?>
                </tr>
                <!-- row -->
                <?php
                $counter = 0;

                foreach ($tests as $test) {
                    $counter += 1;
                    echo '
                        <tr>
                            <td>' . $counter . '</td>
                            <td>' . $test["testTitle"] . '</td>
                    ';

                    if (!$_SESSION['user']['isTeacher']) {
                        echo '
                            <td><a href="https://www.example.com"><button class="btn btn-info">Start</button></a></td>
                            <td><b>0/10</b></td>
                        ';
                    } else {
                        echo '
                            <td><a href="https://www.example.com"><button class="btn btn-warning">✏️</button></a></td>
                            <td><a href="https://www.example.com"><button class="btn btn-error">❌</button></a></td>
                        ';
                    }
                    echo '
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    if (count($tests) == 0) {
        echo '
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Er staan geen oefeningen hier.</span>
                </div>
            ';
    }
    ?>
</div>