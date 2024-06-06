<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';


$books = fetch_as_array('SELECT *, books.id AS "bookid" FROM `books` INNER JOIN book_subjects ON (books.subjectid = book_subjects.id) INNER JOIN book_connections ON (books.id = book_connections.bookid) WHERE book_connections.userid =' . $_SESSION["user"]["id"] . ' ' . $book_query);
$subjects = fetch('SELECT * FROM book_subjects');
$theme = 'dark';

if (!$_SESSION["user"]["isTeacher"]){
    $notifications = fetch_as_array('SELECT *, COUNT(*) AS "pings" FROM `Shoutbox` 
        INNER JOIN lobbies ON (lobbies.id = Shoutbox.Lobbyid)
        INNER JOIN books ON (books.id = lobbies.bookid)
        INNER JOIN book_connections ON (book_connections.bookid = books.id)
        WHERE book_connections.userid = '.$_SESSION["user"]["id"].' 
        AND Shoutbox.Senderid != '.$_SESSION["user"]["id"].'
        AND lobbies.senderid = '.$_SESSION["user"]["id"].'
        GROUP BY Shoutbox.Lobbyid'
    );
    $unanswered_msgs = fetch_as_array('SELECT *, COUNT(*) AS "pings" FROM `Shoutbox` 
        INNER JOIN lobbies ON (lobbies.id = Shoutbox.Lobbyid)
        INNER JOIN books ON (books.id = lobbies.bookid)
        INNER JOIN book_connections ON (book_connections.bookid = books.id)
        WHERE book_connections.userid = '.$_SESSION["user"]["id"].' 
        AND lobbies.senderid = '.$_SESSION["user"]["id"].'
        GROUP BY Shoutbox.Lobbyid'
    );

    foreach ($notifications as $notification) {
        foreach ($unanswered_msgs as $key => $msg) {
            if ($notification['question'] == $msg['question']) {
                unset($unanswered_msgs[$key]);
            }
        }
    }
    // Reindex the array to prevent gaps in the keys
    $unanswered_msgs = array_values($unanswered_msgs);
    
} else {
    $notifications = fetch_as_array('SELECT *, COUNT(*) AS "pings" FROM `Shoutbox` 
        INNER JOIN lobbies ON (lobbies.id = Shoutbox.Lobbyid)
        INNER JOIN books ON (books.id = lobbies.bookid)
        INNER JOIN book_connections ON (book_connections.bookid = books.id)
        WHERE book_connections.userid = '.$_SESSION["user"]["id"].' AND Shoutbox.Senderid != '.$_SESSION["user"]["id"].'
        GROUP BY Shoutbox.Lobbyid'
    );
}


?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Notificaties</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Berichten</h1>

    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>Van</th>
                    <th>Boek</th>
                    <th>Vraag</th>
                    <th>Aantal Berichten</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    foreach($notifications as $notif){
                        $pings = $notif["pings"];

                        echo '
                            <tr>
                                <td>'.$notif["Name"].'</td>
                                <td>'.$notif["title"].'</td>
                                <td><u><a href="https://bibliotheek.live/alperenGit/src/public/user/chat/chat.php?code='.$notif["img_code"].'">'.$notif["question"].'</a></u></td>
                                <td><div class="badge badge-primary">'.$pings.'</div></td>
                            </tr>
                        ';
                    }

                    if (!$_SESSION["user"]["isTeacher"]){
                        foreach($unanswered_msgs as $msg){
                            echo '
                                <tr>
                                    <td>'.$msg["Name"].'</td>
                                    <td>'.$msg["title"].'</td>
                                    <td><u><a href="https://bibliotheek.live/alperenGit/src/public/user/chat/chat.php?code='.$msg["img_code"].'">'.$msg["question"].'</a></u></td>
                                    <td><div class="badge badge-primary">Geen antwoord</div></td>
                                </tr>
                            ';
                        }
                    }

                ?>
            </tbody>
        </table>
    </div>
</div>