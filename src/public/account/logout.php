<?php
if (!isset($_SESSION['user'])) {
  header('Location: /account/login');
  return;
}

session_destroy();
header('Location: /');
