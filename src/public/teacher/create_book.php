<?php
if (isset($_SESSION['user'])) {
    header('Location: https://bibliotheek.live');
    exit();
} 

if (!$_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
} 
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
    <title>Creëer nieuw boek</title>
</head>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
    <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Creëer nieuw boek</h1>
    <ul class="steps">
        <li class="step step-primary">Creëer nieuw boek</li>
        <li class="step">Voeg hoofdstukken toe</li>
        <li class="step">Deel invite-code</li>
    </ul>
    <form action="https://bibliotheek.live/alperenGit/src/lib/account/login.php" method="post" class="flex flex-col gap-8 w-full sm:w-80">
        <div class="flex flex-col gap-4">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Titel</span>
                </label>
                <input type="text" name="title" placeholder="Titel" class="input input-bordered" required />
            </div>
            <select class="select select-primary w-full max-w-xs" name="bookSubject">
                <option disabled selected>Onderwerp</option>
                <option>Game of Thrones</option>
                <option>Lost</option>
                <option>Breaking Bad</option>
                <option>Walking Dead</option>
            </select>
        </div>

        <button name="login" class="btn btn-primary">Sign in</button>
    </form>

    <div class="w-full text-center mt-8">
        <a class="link" href="./register.php">Register</a>
    </div>
</div>