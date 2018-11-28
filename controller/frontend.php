<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 14:12
 */

require_once('model/CameraManager.php');
require_once('model/ContactManager.php');
require_once('model/UploadManager.php');

function contactHelp($from, $content, $subject)
{
    $contactManager = new ContactManager();
    $from = htmlspecialchars($from);
    $subject = htmlspecialchars($subject);
    $content = htmlspecialchars($content);
    $sent = $contactManager->sendMail($from, $content, $subject);

    require('view/footContact.php');
}

function uploadPicture()
{
    $uploadManager = new upload();
    $uploadStatus = $uploadManager->uploadPicture();
    require('view/navUpload.php');
}