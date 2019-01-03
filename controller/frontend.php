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
                throw new Exception("Only these file typs are allowed for upload: " . implode(', ', $allowed_file_types));
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
                    throw new Exception("The uploaded file exceeds the upload_max_filesize directive in php.ini");
                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form");
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
    require("view/display.php");
}

function getPopular()
{
    $displayManager = new display();
    $recent = $displayManager->popular();
    require("view/display.php");
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
    $login = $_POST['Login'];
    $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $valid = checkValidity($login, $email, $_POST['passwd'], $_POST['confirmpasswd'], $registerManager);

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
    require('view/navRegister.php');
}

//----------------------------------------------Misc Tools Section----------------------------------------------------//

function message($message)
{
    $_POST['message'] = $message;
    require('view/message.php');
}

