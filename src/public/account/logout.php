<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: https://bibliotheek.live/');
  return;
}

session_destroy();
header('Location: https://bibliotheek.live/');
