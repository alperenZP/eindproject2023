<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';


$users = fetch_as_array('SELECT * FROM `users` INNER JOIN book_connections ON (book_connections.userid = users.id) INNER JOIN books ON (books.id = book_connections.bookid) WHERE bookid = ? AND books.creatorid = ?',
    ['type' => 'i', 'value' => $_GET["bookid"]],
    ['type' => 'i', 'value' => $_SESSION["user"]["id"]],
);
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
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Gebruikers die zijn verbonden met dit boek</h1>

    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <td>Voornaam</td>
                    <td>Naam</td>
                    <td>Gebruikersnaam</td>
                </tr>
                <!-- row -->
                <?php
                foreach ($users as $user) {
                    echo '
                        <tr>
                            <td>'.$users["firstname"].'</td>
                            <td>'.$users["lastname"].'</td>
                            <td>'.$users["username"].'</td>
                        </tr>        
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <?php
        if (count($books) == 0){
            echo '
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Er staan geen boeken in deze lijst.</span>
                </div>
            ';
        }
    ?>
</div>