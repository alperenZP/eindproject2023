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
    ['type' => 'i', 'value' => $_GET["bookid"]]
);

if ($book_access["amount"] == 0) {
    header('Location: https://bibliotheek.live');
    exit();
}

$book = fetch(
    'SELECT * FROM books WHERE id = ?',
    ['type' => 'i', 'value' => $_GET["bookid"]]
);

$users = fetch_as_array('SELECT *, book_connections.id AS "bookconnectionid", users.id AS "userid" 
    FROM `users` 
    INNER JOIN book_connections ON (book_connections.userid = users.id) 
    INNER JOIN books ON (books.id = book_connections.bookid) 
    WHERE bookid = ?
    ',
    ['type' => 'i', 'value' => $_GET["bookid"]],
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
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">
        <?php
        echo $book["title"];
        ?>
    </h1>

    <ul class="menu menu-horizontal bg-base-200 w-400">
        <div class="divider"></div>
        <li><a href="https://bibliotheek.live/alperenGit/src/public/user/view_book.php?book=<?php echo $book["id"]?>">Boek</a></li>
        <li><a href="https://bibliotheek.live/alperenGit/src/public/user/view_exercises.php?bookid=<?php echo $book["id"]?>">Toetsen</a></li>
        <li><a class="active">Studenten</a></li>
    </ul>

    <div class="divider"></div> 
    <h2 class="sm:text-center md:text-center text-2xl mb-8"><i>Gebruikers die zijn verbonden met dit boek</i></h2>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <tbody>
                <tr>
                    <td><b>Rol</b></td>
                    <td><b>Voornaam</b></td>
                    <td><b>Naam</b></td>
                    <td><b>Gebruikersnaam</b></td>
                    <td> </td>
                </tr>
                <!-- row -->
                <?php
                foreach ($users as $user) {
                    $rol = $user["isTeacher"]?
                        '<div class="tooltip" data-tip="Leraar">
                        <button class="btn">👨‍🏫</button>
                        </div>':
                        '<div class="tooltip" data-tip="Student">
                        <button class="btn">👨‍🎓</button>
                        </div>';
                    if($user["isBlocked"]){
                        echo '
                            <tr>
                                <td>'.$rol.'</td>
                                <td><s>'.$user["firstname"].'</s></td>
                                <td><s>'.$user["lastname"].'</s></td>
                                <td><s>'.$user["username"].'</s></td>
                                <td><button class="btn btn-outline btn-secondary">DEBLOKKEREN</button></td>
                        ';
                    } elseif (!$user["hasBeenReviewed"]){
                        echo '
                            <tr>
                                <td>'.$rol.'</td>
                                <td>'.$user["firstname"].'</td>
                                <td>'.$user["lastname"].'</td>
                                <td>'.$user["username"].'</td>
                        ';

                        if ($_SESSION["user"]["isTeacher"]){
                            echo '
                                <td>
                                    Toegang:
                                    <button class="btn btn-outline btn-success">Geven</button>
                                    <button class="btn btn-outline btn-error">Weigeren</button>
                                </td>
                            ';
                        } else {
                            echo '
                                <td>
                                    Aanvrager
                                </td>
                            ';
                        }
                    
                    } else {
                        echo '
                            <tr>
                                <td>'.$rol.'</td>
                                <td>'.$user["firstname"].'</td>
                                <td>'.$user["lastname"].'</td>
                                <td>'.$user["username"].'</td>
                        ';
                        if ($_SESSION["user"]["isTeacher"] && ($user["userid"] != $_SESSION["user"]["id"])){
                            echo '<td><a href="https://bibliotheek.live/alperenGit/src/lib/user/teacher/block_user.php?id=' . $user["bookconnectionid"] . '"><button class="btn btn-error">🛑</button></a></td>';
                        } else {
                            echo '<td> </td>';
                        }
                    }   
                    echo '
                        
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