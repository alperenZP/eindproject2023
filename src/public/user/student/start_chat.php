<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}
if ($_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';
$theme = 'dark';

$chapter = fetch('SELECT * FROM book_chapters WHERE id = ?', ['type' => 'i', 'value' => $_GET["chapter"]]);
$book = fetch ('SELECT * FROM books WHERE id = ' . $chapter["bookid"]);

$book_access = fetch(
    'SELECT *,count(*) AS "amount" FROM book_connections WHERE userid = '.$_SESSION['user']['id'].' AND bookid = ?',
    ['type' => 'i', 'value' => $book["id"]]
);

if ($book_access["amount"] == 0){
    header('Location: https://bibliotheek.live');
    exit();
}
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Stuur vraag</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Creëer een vraag over <?php echo $chapter["title"];?></h1>
    <h1 class="sm:text-center md:text-center text-2xl font-bold mb-2">Boek: <i><?php echo $book["title"]?></i></h1>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
    <form action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/add_chapter.php" method="post"
        enctype="multipart/form-data" class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <input type="text" name="title" placeholder="Wat is jouw vraag?" class="input input-bordered" required />
            </div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Upload een afbeelding als bijlage</span>
                </div>
                <input type="file" name="afbeelding" accept="image/png, image/gif, image/jpeg" class="file-input file-input-bordered w-full max-w-xs" required/>
            </label>
        </div>

        <button name="add" class="btn btn-primary">Stuur vraag</button>
    </form>
</div>