<?php
if (isset($_SESSION['user'])) {
  header('Location: /');
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

  <form action="https://bibliotheek.live/alperenGit/src/lib/account/register.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
    <div class="flex flex-col gap-4">
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Voornaam</span>
          </label>
          <input type="text" name="firstname" placeholder="John" class="input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Familienaam</span>
          </label>
          <input type="text" name="lastname" placeholder="Doe" class="input input-bordered w-full" required />
        </div>
      </div>
      
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input type="email" name="email" placeholder="john.doe@gmail.com" class="input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Gebruikersnaam</span>
          </label>
          <input type="text" name="username" placeholder="john.doe" class="input input-bordered w-full" required />
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
            <span class="label-text">Password</span>
          </label>
          <input type="password" name="password" placeholder="Make it a good one!" class="input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Confirm password</span>
          </label>
          <input type="password" name="passwordConfirm" placeholder="Confirm..." class="input input-bordered w-full" required />
        </div>
      </div>
    </div>

    <button name="register" class="btn btn-primary">Register</button>
  </form>

  <div class="w-full text-center mt-8">
    <a class="link" href="/account/login">I already have an account</a>
  </div>
</div>
