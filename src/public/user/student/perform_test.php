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

$test = fetch('SELECT * FROM tests WHERE id = ?', ['type' => 'i', 'value' => $_GET["testid"]]);
$questions = fetch_as_array('SELECT * FROM questions WHERE testid = ? ORDER BY id ASC', ['type' => 'i', 'value' => $_GET["testid"]]);
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
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Toets: <?php echo $test["title"]; ?></h1>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8"> </h1>
    <?php
    if (isset($_POST["submit"])) {
        if ($_SESSION["position_in_test"] <= count($questions)) {
            $x = $_SESSION["position_in_test"] + 1;
            $correct_option = $questions[$_SESSION["position_in_test"]]["correct_option"];
            $array_choices = array(
                $questions[$_SESSION["position_in_test"]]["correct_option"],
                $questions[$_SESSION["position_in_test"]]["incorrect1"],
                $questions[$_SESSION["position_in_test"]]["incorrect2"],
                $questions[$_SESSION["position_in_test"]]["incorrect3"],
            );
            shuffle($array_choices);

            echo '
                <form action="https://bibliotheek.live/alperenGit/src/lib/user/student/perform_test.php" method="post" enctype="multipart/form-data" class="flex flex-col gap-8 w-full sm:w-80">
                    <div class="flex flex-col gap-4">
                        <div class="mockup-window border bg-base-300">
                            <div class="flex flex-col px-4 py-8 bg-base-200"> <!-- Removed items-center -->
                                <span class="mb-2">Vraag ' . $x . ':</span> <!-- Added margin bottom -->
                                <span class="font-bold mt-2 mb-6">' . $questions[$_SESSION["position_in_test"]]["text"] . '</span>
                                <input type="hidden" name="question_id" value="' . $questions[$_SESSION["position_in_test"]]["id"] . '"/>
                                <div class="form-control border border-purple-500 rounded-md p-2">
                                    <label class="label cursor-pointer">
                                        <span class="label-text">' . $array_choices[0] . '</span> 
                                        <input type="radio" name="radio_guess" value="' . $array_choices[0] . '" class="radio checked:bg-purple-500" checked />
                                    </label>
                                </div>
                                <div class="form-control border border-pink-500 rounded-md p-2">
                                    <label class="label cursor-pointer">
                                        <span class="label-text">' . $array_choices[1] . '</span> 
                                        <input type="radio" name="radio_guess" value="' . $array_choices[1] . '" class="radio checked:bg-pink-500" />
                                    </label>
                                </div>
                                <div class="form-control border border-orange-500 rounded-md p-2">
                                    <label class="label cursor-pointer">
                                        <span class="label-text">' . $array_choices[2] . '</span> 
                                        <input type="radio" name="radio_guess" value="' . $array_choices[2] . '" class="radio checked:bg-orange-500" />
                                    </label>
                                </div>
                                <div class="form-control border border-yellow-500 rounded-md p-2">
                                    <label class="label cursor-pointer">
                                        <span class="label-text">' . $array_choices[3] . '</span> 
                                        <input type="radio" name="radio_guess" value="' . $array_choices[3] . '" class="radio checked:bg-yellow-500" />
                                    </label>
                                </div>
                                <button id="checkBtn" class="btn btn-secondary mt-4">Check</button>
                                <div id="result" class="mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <button id="submitBtn" name="submit" class="btn btn-primary" style="display: none;">Volgende</button>
                </form>
            ';




            $_SESSION["position_in_test"]++;
        }
    } else {
        echo '
                <form action="" method="post"
                    enctype="multipart/form-data" class="flex flex-col gap-8 w-full sm:w-80">
                    <div class="flex flex-col gap-4">
                        <div class="mockup-window border bg-base-300">
                            <div class="flex justify-center px-4 py-16 bg-base-200">Info etc. about test</div>
                        </div>
                    </div>
            
                    <button name="submit" class="btn btn-primary">Begin toets</button>
                </form>
            ';
    }
    ?>

</div>

<script>
    document.getElementById('checkBtn').addEventListener('click', function() {
        var selectedOption = document.querySelector('input[name="radio_guess"]:checked').value;
        var correctOption = "<?php echo $correct_option; ?>";
        var resultDiv = document.getElementById('result');
        var submitBtn = document.getElementById('submitBtn');

        if (selectedOption == correctOption) {
            resultDiv.textContent = 'True';
        } else {
            resultDiv.textContent = 'False';
        }

        submitBtn.style.display = 'block';
    });
</script>