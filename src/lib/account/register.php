<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once LIB . '/util/util.php';

if (isset($_POST['register'])) {
  register($_POST);
  exit();
}

header('Location: https://bibliotheek.live');
exit();

function register($formData) {
  $firstname = $formData['firstname'];
  $lastname = $formData['lastname'];
  $email = $formData['email'];
  $username = $formData['username'];
  $password = $formData['password'];
  $passwordConfirm = $formData['passwordConfirm'];
  $isLeraar = $formData["isLeraar"];
  
  $data = fetch('SELECT * FROM users WHERE email = ?', [
    'type' => 's',
    'value' => $email,
  ]);

  if ($data) {
    header('Location: https://bibliotheek.live/alperenGit/src/public/account/register.php?error=email');
    exit();
  }
  
  $data = fetch('SELECT * FROM users WHERE username = ?', [
    'type' => 's',
    'value' => $username,
  ]);
  
  if ($data) {
    header('Location: https://bibliotheek.live/alperenGit/src/public/account/register.php?error=username');
    exit();
  }
  
  if ($password !== $passwordConfirm) {
    header('Location: https://bibliotheek.live/alperenGit/src/public/account/register.php?error=password');
    exit();
  }
  
  $password = password_hash($password, PASSWORD_ARGON2ID);
  $initialized = insertUser($username, $password, $email, $firstname, $lastname, $isLeraar);

  if (!$initialized) {
    header('Location: https://bibliotheek.live/alperenGit/src/public/account/register.php?error=server');
    return;
  }

  session_start();
  login($_POST);
  
  header('Location: https://bibliotheek.live');
  exit();
}

function insertUser($username, $password, $email, $firstname, $lastname, $isLeraar) {
  global $connection;
  $userData = insert(
    'INSERT INTO users (username, password, email, firstname, lastname, isTeacher) VALUES (?, ?, ?, ?, ?, ?)',
    ['type' => 's', 'value' => $username],
    ['type' => 's', 'value' => $password],
    ['type' => 's', 'value' => $email],
    ['type' => 's', 'value' => $firstname],
    ['type' => 's', 'value' => $lastname],
    ['type' => 'i', 'value' => $isLeraar],
  );

  $userId = mysqli_insert_id($connection);
  return $userData;
}

function login($formData) {
  if (!isset($formData['email']) || !isset($formData['password'])) {
    header('Location: /account/login?error=missing');
    return;
  }
  
  $email = $formData['email'];
  $password = $formData['password'];
  
  if (empty($email) || empty($password)) {
    header('Location: /account/login?error=empty');
    return;
  }
  
  $auth = authenticate($email, $password);
  
  if (!$auth) {
    header('Location: /account/login?error=invalid');
    return;
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
