<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_SESSION['user'])) {
  header('Location: /');
  exit();
}

if (isset($_POST['login'])) {
  login($_POST);
  return;
}

header('Location: https://bibliotheek.live');
exit();

function login($formData) {
  if (!isset($formData['email']) || !isset($formData['password'])) {
    header('Location: https://bibliotheek.live/alperenGit/src/public/account/login.php?error=missing');
    exit();
  }
  
  $email = $formData['email'];
  $password = $formData['password'];
  
  if (empty($email) || empty($password)) {
    header('Location: https://bibliotheek.live/alperenGit/src/public/account/login.php?error=empty');
    exit();
  }
  
  $auth = authenticate($email, $password);
  
  if (!$auth) {
    header('Location: https://bibliotheek.live/alperenGit/src/public/account/login.php?error=invalid');
    exit();
  }
  
  $_SESSION['user'] = USER_STRUCTURE;
  $_SESSION['user']['id'] = $auth['id'];
  $_SESSION['user']['email'] = $auth['email'];
  $_SESSION['user']['username'] = $auth['username'];
  $_SESSION['user']['isTeacher'] = $auth["isTeacher"];
  
  header('Location: https://bibliotheek.live');
  exit();
}

function authenticate($email, $password) {
  var_dump($email, $password);
  $data = fetch(
    'SELECT * FROM users WHERE users.email = ?',
    [
      'type' => 's',
      'value' => $email,
    ],
  );

  if (!$data) {
    return false;
  }

  if (!password_verify($password, $data['password'])) {
    return false;
  }

  return $data;
}
