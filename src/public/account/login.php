<?php
if (isset($_SESSION['user'])) {
  header('Location: /');
  exit();
} ?>

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
<div class="min-h-[100svh] w-full flex flex-col justify-center items-center p-8">
  <div class="w-full flex justify-center text-sm breadcrumbs mb-2">
    <ul>
      <li><a href="/">Home</a></li> 
      <li>Account</li>
      <li><a href="/account/login">Login</a></li>
    </ul>
  </div>

  <h1 class="sm:text-center md:text-center text-4xl font-bold mb-8">Log in to your account</h1>
  
  <form action="/src/lib/account/login.php" method="post" class="flex flex-col gap-8 w-full sm:w-80">
    <div class="flex flex-col gap-4">
      <div class="form-control">
        <label class="label">
          <span class="label-text">Email</span>
        </label>
        <input type="email" name="email" placeholder="john.doe@gmail.com" class="input input-bordered" required />
      </div>
      <div class="form-control">
        <label class="label">
          <span class="label-text">Password</span>
        </label>
        <input type="password" name="password" placeholder="****" class="input input-bordered" required />
      </div>
    </div>

    <button name="login" class="btn btn-primary">Sign in</button>
  </form>

  <div class="w-full text-center mt-8">
    <a class="link" href="./register.php">I don't have an account yet</a>
  </div>
</div>