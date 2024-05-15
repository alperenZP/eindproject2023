<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}
if ($_SESSION["user"]["isTeacher"] || !$_SESSION["access_book_test"]) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';
$theme = 'dark';

$test = fetchSingle('SELECT * FROM tests WHERE id = ?', ['type' => 'i', 'value' => $_GET["testid"]]);
$questions = fetch_as_array('SELECT * FROM questions WHERE testid = ?', ['type' => 'i', 'value' => $_GET["testid"]]);

?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Toets</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Toets: <?php echo $test["title"];?></h1>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
    <?php
        if (isset($_POST["submit"])){

        } else {
            echo '
                <form action="" method="post"
                    enctype="multipart/form-data" class="flex flex-col gap-8 w-full sm:w-80">
                    <div class="flex flex-col gap-4">
                        <div class="mockup-window border bg-base-300">
                            <div class="flex justify-center px-4 py-16 bg-base-200">Hello!</div>
                        </div>
                    </div>
            
                    <button name="submit" class="btn btn-primary">Begin toets</button>
                </form>
            ';
        }
    ?>
    
</div>