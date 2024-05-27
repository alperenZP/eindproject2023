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

if (!isset($_SESSION["questions_add_amount"])){
    $_SESSION["questions_amount"] = 0;
}

$test = fetch(
    'SELECT * FROM tests WHERE id = ?',
    ['type' => 'i', 'value' => $_GET["testid"]]
);

$questions = fetch_as_array(
    'SELECT * FROM questions WHERE testid = ?',
    ['type' => 'i', 'value' => $_GET["testid"]]
);

if (isset($_POST["addquestions"])){
    $_SESSION["questions_add_amount"] = $_SESSION["questions_add_amount"] + $_POST["aantal_vragen"];
}
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Wijzig toets</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Wijzig toets</h1>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>

    <form method="post" class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="label">
                        <span class="label-text">Hoeveel meer vragen?</span>
            </div>
                        <input type="number" min="0" name="aantal_vragen" placeholder="Hoeveel meer vragen?" class="input input-bordered" />
                        <button name="addquestions" class="btn btn-sm">Voeg vragen toe</button>
        </div>
    </form>

    <form id="form" action="https://bibliotheek.live/alperenGit/src/lib/user/teacher/create_test.php" method="post"
        class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <div class="label">
                    <span class="label-text">Naam van toets?</span>
                </div>
                <input type="text" name="title" placeholder="Titel van toets" value="<?php echo $test["title"]?>" class="input input-bordered" required />
            </div>

            <?php
                for ($y = 0; $y < count($questions); $y++) {
                    $ynum = $y+1;
                    echo '
                    <div class="card w-96 bg-base-100 shadow-xl">
                        <div class="card-body">
                            <div class="form-control">
                                <label class="cursor-pointer label">
                                    <span class="label-text">Verwijder deze vraag?</span>
                                    <input type="checkbox" checked="checked" class="checkbox checkbox-error" />
                                </label>
                            </div>
                            <h2 class="card-title">Vraag '.$ynum.'</h2>
                            <h2 class="card-title"><input name="'.$y.'questiontext" type="text" value="'.$questions[$y]["text"].'" placeholder="Vraag '.$ynum.' titel" required class="input input-bordered input-md w-full max-w-xs" /></h2>
                            
                            <ol type="A">
                                <b>Juist antwoord</b> <li><input name="'.$y.'correct" type="text" value="'.$questions[$y]["correct_option"].'" placeholder="Juist antwoord" required class="input input-bordered input-success input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 1</b> <li><input name="'.$y.'wrong1" type="text" value="'.$questions[$y]["incorrect1"].'" placeholder="Fout antwoord" required class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 2</b> <li><input name="'.$y.'wrong2" type="text" value="'.$questions[$y]["incorrect2"].'" placeholder="Fout antwoord" required class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 3</b> <li><input name="'.$y.'wrong3" type="text" value="'.$questions[$y]["incorrect3"].'" placeholder="Fout antwoord" required class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                            </ol>

                        </div>
                    </div>
                    ';
                }

                for ($x = 0; $x < $_SESSION["questions_add_amount"]; $x++) {
                    $xnum = $x+count($questions)+1;
                    $xid = $x+count($questions);
                    echo '
                    <div class="card w-96 bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title">Vraag '.$xnum.'</h2>
                            <h2 class="card-title"><input name="'.$xid.'questiontext" type="text" placeholder="Vraag '.$xnum.' titel" required class="input input-bordered input-md w-full max-w-xs" /></h2>
                            
                            <ol type="A">
                                <b>Juist antwoord</b> <li><input name="'.$xid.'correct" type="text" placeholder="Juist antwoord" required class="input input-bordered input-success input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 1</b> <li><input name="'.$xid.'wrong1" type="text" placeholder="Fout antwoord" required class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 2</b> <li><input name="'.$xid.'wrong2" type="text" placeholder="Fout antwoord" required class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                                <b>Fout antwoord 3</b> <li><input name="'.$xid.'wrong3" type="text" placeholder="Fout antwoord" required class="input input-bordered input-error input-sm w-full max-w-xs" /></li>
                            </ol>

                        </div>
                    </div>
                    ';
                }
                  
            ?>
            <?php echo '<input type="hidden" name="bookid" value="' . $book["id"] . '" required />'; ?>

        </div>

        <button name="edit" class="btn btn-primary">Wijzig</button>
    </form>
</div>
