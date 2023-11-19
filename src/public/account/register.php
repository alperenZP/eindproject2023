<?php
if (isset($_SESSION['user'])) {
  header('Location: /');
  exit();
} 
echo LIB . '/util/util.php';
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
  <div class="w-full flex justify-center text-sm breadcrumbs mb-2">
    <ul>
      <li><a href="/">Home</a></li>
      <li>Account</li>
      <li><a href="/account/register">Register</a></li>
    </ul>
  </div>

  <h1 class="md:text-center text-4xl font-bold mb-8">Create a new account</h1>

  <form action="https://bibliotheek.live/alperenGit/src/lib/account/register.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
    <div class="flex flex-col gap-4">
      <div class="flex flex-col gap-4 md:flex-row">
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Firstname</span>
          </label>
          <input type="text" name="firstname" placeholder="John" class="input input-bordered w-full" required />
        </div>
        
        <div class="form-control md:flex-1">
          <label class="label">
            <span class="label-text">Lastname</span>
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
            <span class="label-text">Username</span>
          </label>
          <input type="text" name="username" placeholder="john.doe" class="input input-bordered w-full" required />
        </div>
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
