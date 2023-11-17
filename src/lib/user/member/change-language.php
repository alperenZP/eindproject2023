<?php
if (!isset($_POST['text_en']) && !isset($_POST['text_nl']) && !isset($_POST['text_fr'])) {
  header('Location: /');
  return;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once LIB . '/util/util.php';

session_start();

$language = array_keys($_POST)[0];
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (!$user) {
  $_SESSION["guest"]["language"] = $language;
  header('Location: /');
  return;
}

insert(
  'UPDATE user_profile SET language = ? WHERE userid = ?',
  ['type' => 's', 'value' => $language],
  ['type' => 'i', 'value' => $user['id']],
);

$_SESSION['user']['language'] = $language;
header('Location: /');
