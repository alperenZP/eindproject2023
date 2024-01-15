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
$chapter = fetch('SELECT * FROM book_chapters WHERE id = ?', ['type' => 'i', 'value' => $_GET["id"]]);
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Wijzig hoofdstuk</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Wijzig hoofdstuk</h1>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
    <form action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/edit_chapter.php" method="post"
        enctype="multipart/form-data" class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <input type="text" name="title" value="<?= $chapter["title"]?>" placeholder="Hoofdstuk titel" class="input input-bordered" required />
            </div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Upload een PDF-bestand</span>
                </div>
                <input type="file" name="pdf" accept=".pdf" class="file-input file-input-bordered w-full max-w-xs"/>
            </label>
        </div>

        <button name="add" class="btn btn-primary">Voeg hoofdstuk toe</button>
    </form>
</div>