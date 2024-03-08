<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';
$theme = 'dark';


$book_access = fetch(
    'SELECT *,count(*) AS "amount" FROM book_connections WHERE userid = ' . $_SESSION['user']['id'] . ' AND bookid = ?',
    ['type' => 'i', 'value' => $_GET["book"]]
);

$book_creator = fetch('SELECT *, count(*) AS "amount" FROM books WHERE books.creatorid = ' . $_SESSION["user"]["id"] . ' AND books.id = ?', ['type' => 'i', 'value' => $_GET["book"]]);


$book = fetch(
    'SELECT * FROM books WHERE id = ?',
    ['type' => 'i', 'value' => $_GET["book"]]
);

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
    <title>Bekijk studenten</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Gebruikers die zijn verbonden met dit boek</h1>
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">
        <?php
        echo $book["title"];
        ?>
    </h1>

    <ul class="menu menu-horizontal bg-base-200 w-400">
        <div class="divider"></div>
        <li><a href="https://bibliotheek.live/alperenGit/src/public/user/view_book.php?book=<?php echo $book["id"]?>">Boek</a></li>
        <li><a>Oefeningen</a></li>
        <li><a class="active">Studenten</a></li>
    </ul>

    <div class="divider"></div> 

    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <td><b>Voornaam</b></td>
                    <td><b>Naam</b></td>
                    <td><b>Gebruikersnaam</b></td>
                </tr>
                <!-- row -->
                <?php
                foreach ($users as $user) {
                    echo '
                        <tr>
                            <td>'.$user["firstname"].'</td>
                            <td>'.$user["lastname"].'</td>
                            <td>'.$user["username"].'</td>
                        </tr>        
                    ';
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <?php
        if (count($users) == 0){
            echo '
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Er staan geen gebruikers in deze lijst.</span>
                </div>
            ';
        }
    ?>
</div>