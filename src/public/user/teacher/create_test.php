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

if (isset($_POST["addquestions"])){
    $_SESSION["questions_amount"] = $_POST["aantal_vragen"];
}
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

    <form method="post" class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="label">
                        <span class="label-text">Hoeveel vragen?</span>
            </div>
                        <input type="number" min="1" name="aantal_vragen" placeholder="Hoeveel vragen?" class="input input-bordered" value="<?php echo $_SESSION["questions_amount"]?>" required />
                        <button name="addquestions" class="btn btn-sm">Voeg vragen toe</button>
        </div>

        <button name="create" class="btn btn-primary">Creëer</button>
    </form>

    <form action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/create_test.php" method="post"
        class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <div class="label">
                    <span class="label-text">Naam van toets?</span>
                </div>
                <input type="text" name="title" placeholder="Titel van toets" class="input input-bordered" required />
            </div>

            <?php 
                for ($x = 0; $x < $_SESSION["questions_amount"]; $x++) {
                    $xnum = $x+1;
                    echo '
                    <div class="card w-96 bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">Vraag '.$xnum.'</h2>
                            <h2 class="card-title"><input type="text" placeholder="Vraag '.$xnum.' titel" class="input input-bordered input-md w-full max-w-xs" /></h2>
                            
                            <ol type="A">
                                <b>Juist antwoord</b> <li><input id="'.$x.'correct" type="text" placeholder="Juist antwoord" class="input input-bordered input-success input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 1</b> <li><input id="'.$x.'wrong1" type="text" placeholder="Fout antwoord" class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 2</b> <li><input id="'.$x.'wrong2" type="text" placeholder="Fout antwoord" class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 3</b> <li><input id="'.$x.'wrong3" type="text" placeholder="Fout antwoord" class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
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

<script>
  function executeAndSubmit() {
    // Execute your JavaScript logic here
    alert("Executing JavaScript...");

    // Submit the form
    document.getElementById("myForm").submit();
  }
</script>
