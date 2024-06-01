<?php
if (isset($_SESSION['user'])) {
  header('Location: https://bibliotheek.live/');
  exit();
} ?>

<!DOCTYPE html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>

  <script src="https://kit.fontawesome.com/58a210823e.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="/alperenGit/public/css/theme.css">
  <title>Login</title>
</head>
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
  <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Log in</h1>
  <?php
    if(isset($_GET["error"])){
      if ($_GET["error"] == "empty"){
        $error_msg = "Er is geen tekst of wachtwoord ingevoerd.";
      } elseif ($_GET["error"] == "missing"){
        $error_msg = "De invoervelden zijn leeg.";
      } elseif ($_GET["error"] == "invalid"){
        $error_msg = "Fout wachtwoord / emailadres.";
      }

      echo '
        <div role="alert" class="alert alert-error">
          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          <span>'.$error_msg.'</span>
        </div>
      ';
    }
  ?>
  <form action="https://bibliotheek.live/alperenGit/src/lib/account/login.php" method="post" class="flex flex-col gap-8 w-full sm:w-80">
    <div class="flex flex-col gap-4">
      <div class="form-control">
        <label class="label">
          <span class="label-text">Email</span>
        </label>
        <input type="email" name="email" placeholder="account@example.com" class="input input-bordered" required />
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Wachtwoord</span>
        </label>
        <input type="password" name="password" placeholder="****" class="input input-bordered" required />
      </div>
    </div>

    <button name="login" class="btn btn-primary">Log in</button>
  </form>

  <div class="w-full text-center mt-8">
    <a class="link" href="./register.php">Register</a>
  </div>
</div>