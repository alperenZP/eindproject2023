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
  
  $data = fetch('SELECT * FROM users WHERE email = ?', [
    'type' => 's',
    'value' => $email,
  ]);

  if ($data) {
    header('Location: /account/register?error=email');
    exit();
  }
  
  $data = fetch('SELECT * FROM users WHERE username = ?', [
    'type' => 's',
    'value' => $username,
  ]);
  
  if ($data) {
    header('Location: /account/register?error=username');
    exit();
  }
  
  if ($password !== $passwordConfirm) {
    header('Location: /account/register?error=password');
    exit();
  }
  
  $password = password_hash($password, PASSWORD_ARGON2ID);
  $initialized = insertUser($username, $password, $email, $firstname, $lastname);

  if (!$initialized) {
    header('Location: /account/register?error=server');
    return;
  }
  
  header('Location: /account/login?success=register');
  exit();
}

function insertUser($username, $password, $email, $firstname, $lastname) {
  global $connection;
  $userData = insert(
    'INSERT INTO users (username, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)',
    ['type' => 's', 'value' => $username],
    ['type' => 's', 'value' => $password],
    ['type' => 's', 'value' => $email],
    ['type' => 's', 'value' => $firstname],
    ['type' => 's', 'value' => $lastname],
  );

  $userId = mysqli_insert_id($connection);
  return $userData;
}
