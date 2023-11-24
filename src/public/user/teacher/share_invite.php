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

if (!isset($_GET["bookid"])) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';
$book = fetchSingle('SELECT * FROM books WHERE id = ? AND creatorid = ?', ["type" => "i", "value" => $_GET["bookid"]], ["type" => "i", "value" => $_SESSION["user"]["id"]]);
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
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Voeg hoofdstukken toe</h1>
    <ul class="steps">
        <li class="step step-primary">Creëer</li>
        <li class="step step-primary">Schrijf</li>
        <li class="step step-primary">Deel</li>
    </ul>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
    <form action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/add_chapter.php" method="post"
        class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <input type="text" name="title" placeholder="Deel invite" class="input input-bordered" required />
            </div>
            <div class="hero min-h-screen bg-base-200">
                <div class="hero-content text-center">
                    <div class="max-w-md">
                        <h1 class="text-5xl font-bold">Hello there</h1>
                        <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                            exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                        <button class="btn btn-primary">Get Started</button>
                    </div>
                </div>
            </div>
        </div>

        <button name="add" class="btn btn-primary">Voeg hoofdstuk toe</button>
    </form>
</div>