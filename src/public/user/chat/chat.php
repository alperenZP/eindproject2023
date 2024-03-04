<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';
$theme = 'dark';

if (!isset($_GET["code"])) {
    header('Location: https://bibliotheek.live');
    exit();
}

$lobby = fetch(
    'SELECT *, count(*) AS "amount" FROM lobbies WHERE img_code = ?',
    ['type' => 's', 'value' => ''.$_GET["code"].'']
);

if ($lobby["amount"] == 0) {
    header('Location: https://bibliotheek.live');
    exit();
}

$book_access = fetch(
    'SELECT *,count(*) AS "amount" FROM book_connections WHERE userid = ' . $_SESSION['user']['id'] . ' AND bookid = ?',
    ['type' => 'i', 'value' => $lobby["bookid"]]
);

$book_creator = fetch(
    'SELECT *, count(*) AS "amount" FROM books WHERE books.creatorid = ' . $_SESSION["user"]["id"] . ' AND books.id = ?',
    ['type' => 'i', 'value' => $lobby["bookid"]]
);

if ($_SESSION["user"]["isTeacher"] && $book_access["amount"] == 0 && $book_creator["amount"] == 0) {
    header('Location: https://bibliotheek.live');
    exit();
}

if ($lobby["senderid"] != $_SESSION['user']['id'] && !$_SESSION["user"]["isTeacher"]){
    header('Location: https://bibliotheek.live');
    exit();
}

$visits = fetch(
    'SELECT COUNT(*) AS "amount" FROM visits (visitorid, lobbyid) VALUES (?, ?)',
    ['type' => 'i', 'value' => $_SESSION["user"]["id"]],
    ['type' => 'i', 'value' => $lobby["id"]],
);

if ($visits["amount"] > 0){
    $query = 'UPDATE visits SET timestamp = ? WHERE id = ? AND visitorid = ?';
    insert(
        $query,
        ['type' => 's', 'value' => time()],
        ['type' => 'i', 'value' => $lobby["id"]],
        ['type' => 'i', 'value' => $_SESSION["user"]["id"]],
    );
} else {
    $query = 'INSERT INTO visits (visitorid, lobbyid) VALUES (?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $_SESSION["user"]["id"]],
        ['type' => 'i', 'value' => $lobby["id"]],
    );
}




?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Stuur vraag</title>
</head>
<?php include COMPONENTS . '/nav.php' ?>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Chat</h1>
    <div class="card w-96 bg-blue-500 shadow-xl">
        <div class="card-body">
            <h2 class="card-title drop-shadow-xl  bg-black-500">Vraag:</h2>
            <p><?php echo $lobby["question"]; ?></p>
        </div>
        <figure><img width="200px" src="https://bibliotheek.live/alperenGit/public/img/<?php echo $lobby["img_code"]?>.webp" alt="Shoes" /></figure>
    </div>
    <div class="divider divider-secondary">Chat box</div>
    <?php
    $_SESSION["lobbyid"] = $lobby["id"];
    include 'shoutbox.inc.php';
    ?>
</div>