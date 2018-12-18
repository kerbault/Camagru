<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 14:12
 */

require_once('model/CameraManager.php');
require_once('model/UploadManager.php');
require_once('model/UsersManager.php');

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
    $uploadManager = new upload();
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            throw new Exception("File is not an image.");
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        throw new Exception('Sorry, your file was not uploaded.');
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            throw new Exception('Sorry, there was an error uploading your file.');
        }
    }

    if ($uploadStatus === false) {
        throw new Exception('Something went wrong with the uploading, please try again later or contact us!');
    } else {
        header('Location: index.php');
    }
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