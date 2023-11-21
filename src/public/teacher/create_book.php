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

$book_subjects = fetch("SELECT * FROM book_subjects");
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Creëer nieuw boek</title>
</head>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <?php include COMPONENTS . '/nav.php' ?>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Creëer nieuw boek</h1>
    <ul class="steps">
        <li class="step step-primary">Creëer nieuw boek</li>
        <li class="step">Voeg hoofdstukken toe</li>
        <li class="step">Deel invite-code</li>
    </ul>
    <form action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/create_book.php" method="post" class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <input type="text" name="title" placeholder="Titel" class="input input-bordered" required />
            </div>
            <select class="select select-primary w-full max-w-xs" name="bookSubject" required>
                <option disabled selected value="">Onderwerp</option>
                <?php
                    foreach ($book_subjects as $book_subject) {
                        echo '<option value="'.$book_subject["id"].'">'.$book_subject["title"].'</option>';
                    };
                ?>
            </select>
            <textarea class="textarea textarea-bordered" placeholder="Beschrijving van boek" name="description"></textarea>
        </div>

        <button name="create" class="btn btn-primary">Creëer boek</button>
    </form>
</div>