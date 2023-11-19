<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (isset($_POST['login'])) {
  session_start();
  login($_POST);
  return;
}

header('Location: https://bibliotheek.live');
exit();

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
  $_SESSION['user']['theme'] = $auth['theme'];
  $_SESSION['user']['language'] = $auth['language'];
  
  header('Location: https://bibliotheek.live');
  exit();
}

function authenticate($email, $password) {
  var_dump($email, $password);
  $data = fetch(
    'SELECT * FROM user_profile
    JOIN users ON users.id = user_profile.userid 
    WHERE users.email = ?',
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
