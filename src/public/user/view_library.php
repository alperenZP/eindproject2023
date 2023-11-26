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
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Jouw boken</h1>
    <?php
    foreach ($book_subjects as $book_subject) {
        echo '
            <div class="collapse collapse-plus bg-neutral text-neutral-content">
                <input type="radio" name="my-accordion-3" checked="unchecked" />
                <div class="collapse-title text-xl font-medium">
                    ' . $book_subject["title"] . '
                </div>
                <div class="collapse-content">
                    <p>hello</p>
                </div>
            </div>
            <div class="divider"></div> 
        ';
    }


    ?>

    <div class="overflow-x-auto">
        <table class="table">
            <tbody>
                <!-- row 1 -->
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img src="/tailwind-css-component-profile-2@56w.png" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">Hart Hagerty</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>