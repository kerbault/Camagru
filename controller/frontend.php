<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 14:12
 */

require_once('model/UploadManager.php');
require_once('model/UsersManager.php');
require_once('model/DisplayManager.php');

//----------------------------------------------Mailing section-------------------------------------------------------//

function contactHelp($from, $content, $subject)
{
    $to = 'kerbault.contact@gmail.com';
    $prefix = '[Camagru] ';

    $sent = mail($to, $prefix . $subject, $content . $from);
    if ($sent) {
        header('Location: index.php?action=getContact');
    } else {
        throw new Exception('Something went wrong, Check if there is no empty field or try again later');
    }
}

//----------------------------------------------Picture section-------------------------------------------------------//

function uploadPicture()
{
    if (isset($_POST['submit'])) {
        $uploadManager = new upload();
        $targetDir = "uploads/";
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileBasename = substr($fileName, 0, strripos($fileName, '.'));
        $fileExt = substr($fileName, strripos($fileName, '.'));
        $fileSize = $_FILES["fileToUpload"]["size"];

        $allowed_file_types = array('.jpg', '.gif', '.png', '.jpeg');
        $allowedSize = 200000000;

        if (in_array($fileExt, $allowed_file_types) && ($fileSize < $allowedSize)) {
            $newFileName = $_POST['name'] . $fileExt;
            if (file_exists($targetDir . $newFileName)) {
                throw new Exception("You have already uploaded this file.");
            } else {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetDir . $newFileName);
                $uploadManager->uploadPictureDb($newFileName);
                message("File uploaded successfully.");
            }
        } elseif (empty($fileBasename)) {
            echo "Please select a file to upload.";
        } elseif ($fileSize > $allowedSize) {
            echo "The file you are trying to upload is too large.";
        } else {
            echo "Only these file typs are allowed for upload: " . implode(', ', $allowed_file_types);
            unlink($_FILES["fileToUpload"]["tmp_name"]);
        }
    }
}

function getRecent()
{
    $displayManager = new display();
    $recent = $displayManager->recent();
    require("view/navRecent.php");
}

//----------------------------------------------Users Section---------------------------------------------------------//

function checkValidity($login, $email, $passwd, $confirmpasswd, $registerManager)
{
    $wrong = 0;
    $users = $registerManager->checkValidity();

    foreach ($users as $tmp) {
        if ($tmp['login'] == $login) {
            $wrong += 1;
        }

        if ($tmp['email'] == $email) {
            $wrong += 2;
        }
    }
    if ($passwd != $confirmpasswd) {
        $wrong += 4;
    }
    return $wrong;
}


function register()
{
    $registerManager = new user();
    $login = $_POST['login'];
    $passwd = password_hash($_POST['passwd']);
    $confirmpasswd = password_hash($_POST['confirmpasswd']);
    $email = $_POST['email'];
    $valid = checkValidity($login, $email, $passwd, $confirmpasswd);

    switch ($valid) {
        case 0:
            $registerManager->register($login, $email, $passwd);
            break;
        case 1:
            throw new Exception('Login already used');
        case 2:
            throw new Exception('email already used');
        case 4:
            throw new Exception('confirmed password is different from the original');
        case 3:
            throw new Exception('Login and email already used');
        case 5:
            throw new Exception('Login already used and confirmed password is different from the original ');
        case 7:
            throw new Exception('Login and email already used and confirmed password is different from the original ');
    }
    require('view/navRegister');
}

//----------------------------------------------Misc Tools Section----------------------------------------------------//

function message($message)
{
    $_POST['message'] = $message;
    require('view/message.php');
}

