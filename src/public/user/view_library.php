<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_GET["subject"])){
    $book_query = "AND book_subjects.id = " . $_GET["subject"];
} else {
    $book_query = "";
}
$books = fetch_as_array('SELECT * FROM `books` INNER JOIN book_subjects ON (books.subjectid = book_subjects.id) INNER JOIN book_connections ON (books.id = book_connections.bookid) WHERE book_connections.userid =' . $_SESSION["user"]["id"] . ' ' . $book_query);

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


    <div class="overflow-x-auto">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn m-1">Click</div>
            <ul class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                <li><a>Item 1</a></li>
                <li><a>Item 2</a></li>
            </ul>
        </div>
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <td>Onderwerp</td>
                    <td>Titel</td>
                    <td>Beschrijving</td>
                </tr>
                <!-- row -->
                <?php
                foreach ($books as $book) {
                    echo '
                        <tr>
                            <td><img src="' . $book["image_link"] . '" height="50px" width="50px"></td>
                            <td><a href="https://www.example.com"><u>' . $book["title"] . '</u></a></td>
                            <td>' . $book["description"] . '</td>
                        </tr>        
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>