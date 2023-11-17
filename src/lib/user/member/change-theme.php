<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIB . '/util/util.php';

if (isset($_SESSION["user"])) {
  handleTheme($_SESSION);
  return;
}

header('Location: /');
exit();

function handleTheme($data) {
  $user = $data['user'];
  
  $theme = $user['theme'] === 'dark' ? 'light' : 'dark';
  insert(
    'UPDATE user_profile SET theme = ? WHERE userid = ?',
    ['type' => 's', 'value' => $theme],
    ['type' => 'i', 'value' => $user['id']],
  );
  
  $_SESSION['user']['theme'] = $theme;
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
