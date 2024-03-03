<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/alperenGit/config.php';
require_once DATABASE . '/connect.php';
require_once LIB . '/util/util.php';

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}

if ($_SESSION["user"]["isTeacher"]) {
    header('Location: https://bibliotheek.live');
    exit();
}

if (isset($_POST['add'])) {
    $senderid = $_SESSION["user"]["id"];
    $bookid = $_POST['bookid'];
    $chapterid = $_POST['chapterid'];
    $question = $_POST['question'];
    $file = $_FILES['image'];

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $imgCode = uniqid();
    // Set the desired file name with the WebP extension
    $imgName = $imgCode . '.webp';
    $imgTmpName = $file['tmp_name'];

    $targetDir = PUBLIC_R . "/img/";
    $targetFile = $targetDir . $imgName;
    move_uploaded_file($imgTmpName, $targetFile);

    // Check if the uploaded file is an image
    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
        // Load the image based on the file type
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($targetFile);
                break;
            case 'png':
                $image = imagecreatefrompng($targetFile);
                break;
            case 'gif':
                $image = imagecreatefromgif($targetFile);
                break;
            default:
                // Handle unsupported file types if necessary
                break;
        }

        // Convert the image to WebP and save it
        imagewebp($image, $targetFile, 80); // 80 is the quality, you can adjust it as needed

        // Free up memory
        imagedestroy($image);
    }


    $query = 'INSERT INTO lobbies (bookid, chapterid, senderid, question, img_code) VALUES (?, ?, ?, ?, ?)';
    insert(
        $query,
        ['type' => 'i', 'value' => $bookid],
        ['type' => 'i', 'value' => $chapterid],
        ['type' => 'i', 'value' => $senderid],
        ['type' => 's', 'value' => $question],
        ['type' => 's', 'value' => $imgCode],
    );
    header('Location: https://bibliotheek.live/alperenGit/src/public/user/chat/chat.php?code=' . $imgCode);
    exit();
}

header('Location: https://bibliotheek.live');
exit();