<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: https://bibliotheek.live/');
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
  <title>2dekans veilingen -
    <?php echo $route['title']; ?>
  </title>
</head>

<div class="min-h-[100svh] w-full flex flex-col justify-center items-center px-8 py-8">
  <h1 class="md:text-center text-4xl font-bold mb-8">Registreren</h1>

  <?php
    if(isset($_GET["error"])){
      if ($_GET["error"] == "password"){
        $error_msg = "Het geschreven wachtwoord komt niet overeen met het validatiewachtwoord.";
      } elseif ($_GET["error"] == "email"){
        $error_msg = "Er bestaat al een account met dit emailadres.";
      } elseif ($_GET["error"] == "username"){
        $error_msg = "Er bestaat al een account met dit gebruikersnaam.";
      } elseif ($_GET["server"]){
        $error_msg = "Registratie mislukt vanwege een storing van de server.";
      }

      echo '
        <div role="alert" class="alert alert-error">
          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          <span>'.$error_msg.'</span>
        </div>
      ';
    }
  ?>
  <form action="https://bibliotheek.live/alperenGit/src/lib/account/register.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
    <div class="flex flex-col gap-4">
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Voornaam</span>
          </label>
          <input type="text" name="firstname" placeholder="Voornaam" class="input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Familienaam</span>
          </label>
          <input type="text" name="lastname" placeholder="Familienaam" class="input input-bordered w-full" required />
        </div>
      </div>
      
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input type="email" name="email" placeholder="email@example.com" class="input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Gebruikersnaam</span>
          </label>
          <input type="text" name="username" placeholder="Gebruikersnaam" class="input input-bordered w-full" required />
        </div>
      </div>

      <div class="form-control">
        <label class="label cursor-pointer">
          <span class="label-text">Leraar</span>
          <input type="radio" name="isLeraar" value="1" class="radio checked:bg-red-500" checked />
        </label>
      </div>
      <div class="form-control">
        <label class="label cursor-pointer">
          <span class="label-text">Student</span>
          <input type="radio" name="isLeraar" value="0" class="radio checked:bg-blue-500" checked />
        </label>
      </div>
      
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Wachtwoord</span>
          </label>
          <input type="password" name="password" placeholder="Wachtwoord" class="input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Bevestig wachtwoord</span>
          </label>
          <input type="password" name="passwordConfirm" placeholder="Wachtwoord" class="input input-bordered w-full" required />
        </div>
      </div>
    </div>

    <button name="register" class="btn btn-primary">Registreren</button>
  </form>

  <div class="w-full text-center mt-8">
    <a class="link" href="https://bibliotheek.live/alperenGit/src/public/account/login.php">Login</a>
  </div>
</div>
