<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once LIB . '/util/util.php';

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;


$theme = 'dark';

$searchTerm = $_GET['search'] ?? '';
?>

<!-- Top navbar -->
<div class="navbar bg-neutral text-neutral-content px-2 gap-2 md:gap-0 md:px-4">
  <!-- Left - logo -->
  <div class="navbar-start flex-1">
    <!-- Dropdown menu on small devices -->
    <div class="dropdown">
      <label tabindex="0" class="btn btn-secondary md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
      </svg>
      </label>
      <ul tabindex="0" class="menu menu-sm ml-0 dropdown-content mt-3 z-[1] p-2 pb-4 shadow bg-base-100 rounded-box w-64">
        <li><a href="/" class="text-lg">Home</a></li>
        <div class="divider my-2 px-6"></div>
        
        <!-- Account actions -->
        <?php
        echo isset($_SESSION['user'])
          ? '
          <li>
            <details>
              <summary class="text-lg">
              <div class="w-8">
              </div>
              Account
              </summary>
              <ul>
                <li><a href="https://bibliotheek.live/alperenGit/src/public/account/logout.php">Log uit</a></li>
              </ul>
            </details>
          </li>
          '
          : '
          <li><a href="./src/public/account/login.php" class="text-neutral-content">Login</a></li>
          <li><a href="./src/public/account/register.php" class="text-neutral-content">Register</a></li>
          '
        ?>
      </ul>
    </div>

    <a href="/" class="btn btn-outline btn-secondary">Bibliotheek <i>Live</i></a>
  </div>


  <!-- Right - User actions -->
  <div class="hidden flex-1 justify-end gap-4 md:flex">
    <?php
    if ($_SESSION["user"]["isTeacher"]){
      $teacher_links = '<li><a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/create_book.php">Creëer nieuw boek</a></li>      
      <li><a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/add_chapter.php">Creëer hoofdstukken</a></li>
      <li><a href="https://bibliotheek.live/alperenGit/src/public/user/teacher/check_classes.php">Bekijk studenten</a></li>';
    } else {
      $teacher_links = "";
    }

    echo isset($_SESSION['user'])
      ? 'Hallo, ' . $_SESSION["user"]["username"] . '! ID: '.$_SESSION["user"]["id"].'
      <details class="dropdown dropdown-end">
        <summary class="m-1 btn btn-secondary btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f8/Profile_photo_placeholder_square.svg" />
          </div>
        </summary>
        <ul class="mt-2 p-2 shadow menu dropdown-content z-[1] bg-base-200 rounded-box w-52">
          '.$teacher_links.'
          <div class="divider px-4 my-2"></div> 
          <li><a href="https://bibliotheek.live/alperenGit/src/public/account/logout.php">Log uit</a></li>
          <div class="divider px-4 mb-2"> </div>
          <li><a href="https://bibliotheek.live/alperenGit/src/public/user/view_library.php">Bekijk boeken</a></li>
          <li><a href="https://bibliotheek.live/alperenGit/src/public/user/enter_code.php">Geef code in</a></li>
        </ul>
      </details>
      '
    : '
    <a href="./src/public/account/login.php" class="btn btn-primary">Log in</a>
    <a href="./src/public/account/register.php" class="btn">Register</a>
    '; ?>
  </div>
</div>




