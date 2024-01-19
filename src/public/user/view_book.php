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
    'SELECT *,count(*) AS "amount" FROM book_connections WHERE userid = '.$_SESSION['user']['id'].' AND bookid = ?',
    ['type' => 'i', 'value' => $_GET["book"]]
);

$book_creator = fetch('SELECT *, count(*) AS "amount" FROM books WHERE books.creatorid = ' . $_SESSION["user"]["id"] . ' AND books.id = ?', ['type' => 'i', 'value' => $_GET["book"]]);

if ($book_access["amount"] == 0 && $book_creator["amount"] == 0){
    header('Location: https://bibliotheek.live');
    exit();
}

$book = fetch(
    'SELECT * FROM books WHERE id = ?',
    ['type' => 'i', 'value' => $_GET["book"]]
);
$chapters = fetch_as_array(
    'SELECT *, book_chapters.title AS "chapterTitle", books.id AS "bookid", book_chapters.id AS "chapterid" FROM `book_chapters` INNER JOIN books ON (books.id = book_chapters.bookid) WHERE bookid = ?',
    ['type' => 'i', 'value' => $_GET["book"]]
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
        <?php echo $book["title"] ?>
    </title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">
        <?php
        echo $book["title"];
        ?>
    </h1>

    <div class="card w-96 bg-primary text-primary-content">
        <div class="card-body">
            <p>
                <?php
                    echo $book["description"];

                    if ($_SESSION['user']['isTeacher']){
                        echo '<br><br>
                        <b><a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/share_invite.php?bookid='.$_GET["book"].'">Link naar code</a></b>';
                    }
                ?>
            </p>
        </div>
    </div>


    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <th> </th>
                    <th>Hoofdstuk</th>
                    <th>PDF</th>
                    <th>Vragen</th>
                    <?php
                        if ($_SESSION['user']['isTeacher']){
                            echo '
                                <th> </th>
                                <th> </th>
                            ';
                        }
                    ?>
                </tr>
                <!-- row -->
                <?php
                foreach ($chapters as $chapter) {
                    $chapterIndex = $chapter["chapterIndex"] + 1;
                    echo '
                        <tr>
                            <td>' . $chapterIndex . '</td>
                            <td>' . $chapter["chapterTitle"] . '</td>
                    ';

                    if ($chapter["pdf_code"] != "") {
                        echo '
                                <td><a title="PDF" href="https://bibliotheek.live/alperenGit/public/pdf/'.$chapter["pdf_code"].'.pdf" target=”_blank”><img width="32" alt="PDF icon" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/PDF_icon.svg/32px-PDF_icon.svg.png"></a></td>
                        ';
                    } else {
                        echo '
                            <td> </td>
                        ';
                    }
                    echo '        
                            <td><a href="https://www.example.com"><u>Forum</u></a></td>
                    ';
                    if ($_SESSION['user']['isTeacher']){
                        echo '
                            <td><a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/edit_chapter.php?id='.$chapter["chapterid"].'"><button class="btn btn-warning">✏️</button></a></td>
                            <td><a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/delete_chapter.php?id='.$chapter["chapterid"].'"><button class="btn btn-error">❌</button></a></td>
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
    if (count($chapters) == 0) {
        echo '
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Er staan geen boek hier.</span>
                </div>
            ';
    }
    ?>
</div>