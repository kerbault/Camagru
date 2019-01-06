<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 14:12
 */

require_once('private/model/UploadManager.php');
require_once('private/model/UsersManager.php');
require_once('private/model/DisplayManager.php');

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

function verificationMail($to, $validKey)
{
    $subject = 'Welcome on Camagru';
    $content = 'Welcome on Camagru, please clic on the following link : ';
    $link = 'http://localhost:8008/01_progress/Camagru/index.php?action=verify&verifyId=' . $validKey;
    $sent = mail($to, $subject, $content . $link);
    if ($sent) {
        throw new Exception('A mail has been sent to verify your account, please open the link given inside');
    } else {
        throw new Exception('Something went wrong, Check if there is no empty field or try again later');
    }

}

//----------------------------------------------Picture section-------------------------------------------------------//

function uploadPicture()
{
    ob_get_contents();
    ob_end_clean();

    $allowedSize = 2000000;
    $allowed_file_types = array('.jpg', '.gif', '.png', '.jpeg');
    $targetDir = "public/captures/";

    if (isset($_POST['submit']) && isset($_POST['name']) && isset($_FILES['fileToUpload']['error'])) {
        if ($_FILES['fileToUpload']['error'] == 0) {
            $uploadManager = new upload();
            $fileName = $_FILES["fileToUpload"]["name"];
            $fileBasename = substr($fileName, 0, strripos($fileName, '.'));
            $fileExt = substr($fileName, strripos($fileName, '.'));
            $fileSize = $_FILES["fileToUpload"]["size"];
            $newFileName = $_POST['name'] . $fileExt;

            if ($fileSize > $allowedSize) {
                throw new Exception("The uploaded file exceeds the allowed limit.");
            } elseif (empty($fileBasename)) {
                throw new Exception("Please select a file to upload.");
            } elseif (!in_array($fileExt, $allowed_file_types)) {
                throw new Exception("Only these file typs are allowed for upload: " .
                    implode(', ', $allowed_file_types));
                unlink($_FILES["fileToUpload"]["tmp_name"]);
            } elseif (file_exists($targetDir . $newFileName)) {
                throw new Exception("You have already uploaded this file.");
            } else {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetDir . $newFileName);
                $uploadManager->uploadPictureDb($newFileName);
                message("File uploaded successfully.");
            }
        } else {
            switch ($_FILES['fileToUpload']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    throw new Exception("The uploaded file exceeds the upload_max_filesize directive in 
                                        php.ini");
                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception("The uploaded file exceeds the MAX_FILE_SIZE directive that was 
                                        specified in the HTML form");
                case UPLOAD_ERR_PARTIAL:
                    throw new Exception("The uploaded file was only partially uploaded");
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception("No file was uploaded");
                case UPLOAD_ERR_NO_TMP_DIR:
                    throw new Exception("Missing a temporary folder");
                case UPLOAD_ERR_CANT_WRITE:
                    throw new Exception("Failed to write file to disk");
                case UPLOAD_ERR_EXTENSION:
                    throw new Exception("File upload stopped by extension");
                default:
                    throw new Exception("Unknown upload error");
            }
        }
    } else {
        throw new Exception("Missing some needed data");
    }
}

function getRecent()
{
    $displayManager = new display();
    $recent = $displayManager->recent();
    require("private/view/display.php");
}

function getPopular()
{
    $displayManager = new display();
    $recent = $displayManager->popular();
    require("private/view/display.php");
}

//----------------------------------------------Users Section---------------------------------------------------------//

function checkDuplicate($login, $email, $passwd, $confirmpasswd, $registerManager)
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
    $login = htmlspecialchars($_POST['Login']);
    $email = htmlspecialchars($_POST['email']);
    $tmpPasswd = htmlspecialchars($_POST['passwd']);
    $passwd = password_hash($tmpPasswd, PASSWORD_DEFAULT);
    $confirmPasswd = htmlspecialchars($_POST['confirmpasswd']);
    $valid = checkDuplicate($login, $email, $tmpPasswd, $confirmPasswd, $registerManager);
    $validkey = hash('sha1', (round(microtime(true) * 1000) . rand(100, 999)));

    switch ($valid) {
        case 0:
            $registerManager->register($login, $email, $passwd, $validkey);
            verificationMail($email, $validkey);
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
        default:
            throw new Exception('Something unexpected happened, please try again or Contact us');
    }
    require('private/view/navRegister.php');
}

function login()
{
    $loginManager = new user();
    $login = htmlspecialchars($_POST['user']);
    $tmpPasswd = htmlspecialchars($_POST['passwd']);
    $passwd = htmlspecialchars($tmpPasswd, PASSWORD_DEFAULT);
    $users = $loginManager->login();

    foreach ($users as $tmp) {
        if ($tmp['login'] == $login) {

            if (password_verify($passwd, $tmp['password'])) {
                if ($tmp['status'] < 0) {
                    throw new Exception('Your account is actually banned');
                } elseif ($tmp['status'] == 0) {
                    throw new Exception('Your account is not active yet, please check the mail we sent during the registration.');
                } else {
                    $_SESSION['status'] = $tmp['status'];
                    $_SESSION['user'] = $login;
                    header('Location: index.php?action=getRecent');
                }
            } else {
                throw new Exception('wrong password');
            }
        }
    }
    throw new Exception('wrong login');
}

function verifyAccount($verifyId)
{
    $verifyManager = new user();
    $users = $verifyManager->verifyId();

    foreach ($users as $tmp) {
        if ($tmp['validkey'] == $verifyId) {
            if ($tmp['status'] == 0) {
                $verifyManager->changeStatus($tmp['id'], 1);
                throw new Exception('Your account is now verified, you may now log in');
            } else {
                throw new Exception('Your account has been verified already');
            }
        }
    }
    throw new Exception('We connot activate your account, please Contact us');
}

function logout()
{
    $_SESSION['status'] = 0;
    $_SESSION['user'] = "";
    header('Location: index.php?action=getRecent');
}

//----------------------------------------------Misc Tools Section----------------------------------------------------//

function message($message)
{
    $_POST['message'] = $message;
    require('private/view/message.php');
}

