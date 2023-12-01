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


$books = fetch_as_array('SELECT * FROM books WHERE creatorid = ?', ['type' => 'i', 'value' => $_SESSION["user"]["id"]]);
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Voeg hoofdstuk toe</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <?php
    if (isset($_GET["bookid"])) {
        echo '
            <div role="alert" class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Het hoofdstuk is met succes aan het boek toegevoegd. Klik <a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/share_invite.php?bookid='.$_GET["bookid"].'"><b>hier</b></a> om uw boek te delen.</span>
            </div>
            <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
        ';
    }
    ?>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Voeg hoofdstukken toe</h1>
    <ul class="steps">
        <li class="step step-primary">Creëer</li>
        <li class="step step-primary">Schrijf</li>
        <li class="step">Deel</li>
    </ul>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
    <form action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/add_chapter.php" method="post" class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <input type="text" name="title" placeholder="Hoofdstuk titel" class="input input-bordered" required />
            </div>
            <select class="select select-bordered w-full max-w-xs" name="bookid" required>
                <option disabled selected value="">Boek</option>
                <?php
                foreach ($books as $book) {
                    echo '<option value="' . $book["id"] . '">' . $book["title"] . '</option>';
                };
                ?>
            </select>
        </div>

        <button name="add" class="btn btn-primary">Voeg hoofdstuk toe</button>
    </form>
</div>