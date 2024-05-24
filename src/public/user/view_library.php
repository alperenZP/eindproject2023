<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_GET["subject"])) {
    $book_query = "AND book_subjects.id = " . $_GET["subject"];
} else {
    $book_query = "";
}
$books = fetch_as_array('SELECT *, books.id AS "bookid" 
    FROM `books` 
    INNER JOIN book_subjects 
    ON (books.subjectid = book_subjects.id) 
    INNER JOIN book_connections ON (books.id = book_connections.bookid) 
    WHERE book_connections.userid =' . $_SESSION["user"]["id"] . ' ' . $book_query
);
$subjects = fetch('SELECT * FROM book_subjects');
$theme = 'dark';
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Bibliotheek</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Bibliotheek</h1>

    <div class="dropdown">
        <div tabindex="0" role="button" class="btn m-1">Sorteer op onderwerp</div>
        <ul class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
            <li><a href="https://bibliotheek.live/alperenGit/src/public/user/view_library.php">Alles</a></li>
            <?php
            foreach ($subjects as $subject) {
                echo '
                            <li><a href="https://bibliotheek.live/alperenGit/src/public/user/view_library.php?subject=' . $subject["id"] . '">' . $subject["name"] . '</a></li>
                        ';
            }
            ?>
        </ul>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <td>Onderwerp</td>
                    <td>Titel</td>
                    <td>Beschrijving</td>
                    <td>Toegang</td>
                </tr>
                <!-- row -->

                <?php
                foreach ($books as $book) {
                    echo '
                        <tr>
                            <td><img src="' . $book["image_link"] . '" height="50px" width="50px"></td>
                            
                                
                    ';
                    $access_query = fetch('SELECT * FROM book_connections WHERE bookid = ' . $book["bookid"] . ' AND userid = ' . $_SESSION["user"]["id"]);
                    if ($access_query["isBlocked"]){
                        echo '
                            <td><s>'. $book["books.id"] . $book["title"] . '</s></a></td>
                            <td>' . $book["description"] . '</td>
                            <td>❌</td>
                        ';
                    } elseif ($access_query["hasBeenReviewed"] == 0){
                        echo '
                            <td><i>'. $book["books.id"] . $book["title"] . '</i></td>
                            <td>' . $book["description"] . '</td>
                            <td>
                                <div class="badge badge-info gap-2">
                                    In afwachting
                                </div>
                            </td>
                        ';
                    } else {
                        echo '
                            <td><i>'. $book["books.id"] . $book["title"] . '</i></td>
                            <td>' . $book["description"] . '</td>
                            <td>✔️</td>
                        ';
                    }

                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    if (count($books) == 0 && count($created_books) == 0) {
        echo '
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Er staan geen boeken in deze lijst.</span>
                </div>
            ';
    }
    ?>
</div>