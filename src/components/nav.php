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
                <img class="rounded-full" src="https://avatars.githubusercontent.com/u/64209400?v=4" />
              </div>
              Account
              </summary>
              <ul>
                <li><a class="justify-between">Profile</a></li>
                <li><a href="/dashboard/products/review?seller=' . $user['username'] . '">Reviews</a></li>
                <li><a href="/account/settings/edit">Settings</a></li>
                
                <li><a href="/account/logout"> EEERRR </a></li>
              </ul>
            </details>
          </li>
          '
          : '<li><a href="./src/public/account/login.php" class="text-neutral-content">Login</a></li>'
        ?>
        <!-- Language Select -->
        <li>
          <details>
            <summary class="text-neutral-content"><?php echo $languageDisplay ?></summary>
            <ul>
              <form action="/src/lib/user/member/change-language.php" method="post">
                <li><input type="submit" name="text_en" value='English'></li>
                <li><input type="submit" name="text_nl" value='Nederlands'></li>
                <li><input type="submit" name="text_fr" value='Français'></li>
              </form>
            </ul>
          </details>
        </li>
      </ul>
    </div>

    <a href="/" class="btn btn-outline btn-secondary">Bibliotheek <i>Live</i></a>
  </div>


  <!-- Right - User actions -->
  <div class="hidden flex-1 justify-end gap-4 md:flex">
    <?php echo isset($_SESSION['user'])
      ? '
      <details class="dropdown dropdown-end">
        <summary class="m-1 btn btn-secondary btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="https://avatars.githubusercontent.com/u/64209400?v=4" />
          </div>
        </summary>
        <ul class="mt-2 p-2 shadow menu dropdown-content z-[1] bg-base-200 rounded-box w-52">
          <li><a class="justify-between">Profile</a></li>
          <li><a href="/account/favorites">Favorites</a></li>      
          <li><a href="/account/settings/edit">Settings</a></li>
          <div class="divider px-4 my-2"></div> 
          <li><a href="/account/logout"> ERERERER </a></li>
          <div class="divider px-4 mb-2">TEMP</div>
          <li>
            <details class="dropdown dropdown-left">
              <summary class="m-1">Member Dashboard</summary>
              <ul class="mr-4 p-2 shadow menu dropdown-content z-[1] bg-base-200 rounded-box w-52">
                <li><a href="/member/dashboard">Dashboard</a></li>
              </ul>
            </details>
          </li>
        </ul>
      </details>
      '
    : '<a href="./src/public/account/login.php" class="btn">Login</a>'; ?>
  </div>
</div>




