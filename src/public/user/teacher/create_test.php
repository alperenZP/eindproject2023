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


$book = fetch(
    'SELECT * FROM books WHERE id = ?',
    ['type' => 'i', 'value' => $_GET["bookid"]]
);
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Creëer nieuw toets</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Creëer nieuw toets</h1>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
    <form action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/create_test.php" method="post"
        class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <input type="text" name="title" placeholder="Titel" class="input input-bordered" required />
            </div>

            <?php 
                for ($x = 0; $x <= 10; $x++) {
                    $xnum = $x+1;
                    echo '
                    <div class="card w-96 bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">Vraag '.$xnum.'</h2>
                            <h2 class="card-title"><input type="text" placeholder="Vraag '.$xnum.' titel" class="input input-bordered input-md w-full max-w-xs" /></h2>
                            
                            <ol type="A">
                                <b>A</b> <li><input type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs" /></li>
                                <b>B</b> <li><input type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs" /></li>
                                <b>C</b> <li><input type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs" /></li>
                                <b>D</b> <li><input type="text" placeholder="Type here" class="input input-bordered input-sm w-full max-w-xs" /></li>
                            </ol>

                        </div>
                    </div>
                    ';
                }
                  
            ?>
            <?php echo '<input type="hidden" name="bookid" value="' . $book["id"] . '" required />'; ?>

        </div>

        <button name="create" class="btn btn-primary">Creëer</button>
    </form>
</div>