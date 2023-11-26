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
    <div role="tablist" class="tabs tabs-lifted">
  <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Tab 1" />
  <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">Tab content 1</div>

  <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Tab 2" checked />
  <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">Tab content 2</div>

  <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Tab 3" />
  <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">Tab content 3</div>
</div>
    <div role="tablist" class="tabs tabs-lifted">
        
    <?php
    foreach ($book_subjects as $book_subject) {
        echo '
            <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="'.$book_subject["id"].'" />
            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">'.$book_subject["title"].'</div>
        ';
    }
    ?>
    </div>

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