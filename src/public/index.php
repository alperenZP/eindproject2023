<?php
  session_start();
?>
<div class="hero min-h-screen" style="background-image: url(https://upload.wikimedia.org/wikipedia/commons/f/f0/Library_Books_Bookshelves_%28Unsplash%29.jpg);">
  <div class="hero-overlay bg-opacity-60"></div>
  <div class="hero-content text-center text-neutral-content">
    <div class="max-w-md">
      <h1 class="mb-5 text-5xl font-bold">Welkom</h1>
      <p class="mb-5">Dit is de Bibliotheek Live, de levende bibliotheek.</p>
      <a href="<?php if (isset($_SESSION["user"])){echo 'https://bibliotheek.live/alperenGit/src/public/user/enter_code.php';}else{echo 'https://bibliotheek.live/alperenGit/src/public/account/login.php';}?>"><button class="btn btn-primary">Begin je reis</button></a>
    </div>
  </div>
</div>