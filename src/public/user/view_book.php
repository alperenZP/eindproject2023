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

$book = fetchSingle(
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
        <?php echo $book["title"] ?>
    </h1>

    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <th> </th>
                    <th>Hoofdstuk</th>
                    <th>PDF</th>
                    <th>Vragen</th>
                </tr>
                <!-- row -->
                <?php
                foreach ($chapters as $chapter) {
                    $chapterIndex = $chapter["chapterIndex"] + 1;
                    echo '
                        <tr>
                            <td>' . $chapterIndex . '</td>
                            <td>' . $chapter["chapterTitle"] . '</td>
                            <td><a title="PDF" href="https://bibliotheek.live/alperenGit/public/pdf/bid'.$chapter["bookid"].'_hid'.$chapter["chapterid"].'.pdf"><img width="32" alt="PDF icon" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/PDF_icon.svg/32px-PDF_icon.svg.png"></a></td>
                            <td><a href="https://www.example.com"><u>Forum</u></a></td>
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