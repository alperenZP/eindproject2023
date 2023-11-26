<?php
session_start();

if (!isset($_SESSION['user'])) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Bibliotheek</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Bibliotheek</h1>


    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <!-- row 1 -->
                <?php
                foreach ($book_subjects as $book_subject) {
                    echo '
                <tr>
                    <th><img src="' . $book_subject["image_link"] . '" width="20px" height="20px"></th>
                    <td>' . $book_subject["title"] . '</td>
                    <td>
                        <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-200">
                            <div class="collapse-title text-xl font-medium">
                                Boekenlijst
                            </div>
                            <div class="collapse-content"> 
                                <p>tabindex="0" attribute is necessary to make the div focusable</p>
                            </div>
                        </div>
                    </td>
                </tr>
                
            ';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>