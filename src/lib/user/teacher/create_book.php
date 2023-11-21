<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: /');
  exit();
}

if (!$_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
} 

if (isset($_POST['create'])) {
  $creatorid = $_SESSION["user"]["id"];
  $subjectid = $_POST['book_subject'];
  $title = $_POST['title'];
  $description = $_POST['description'];

  $query = 'INSERT INTO books (creatorid, title, subjectid, description) VALUES (?, ?, ?, ?)';
  insert(
    $query,
    ['type' => 'i', 'value' => $creatorid],
    ['type' => 's', 'value' => ''.$title.''],
    ['type' => 'i', 'value' => $subjectid],
    ['type' => 's', 'value' => ''.$description.''],
  );  
  return;
}

header('Location: https://bibliotheek.live');
exit();
