<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 14:12
 */

require_once('model/CameraManager.php');
require_once('model/ContactManager.php');

function contactHelp($from, $content, $subject)
{
    $contactManager = new ContactManager();
    $from = htmlspecialchars($from);
    $subject = htmlspecialchars($subject);
    $content = htmlspecialchars($content);
    $sent = $contactManager->sendMail($from, $content, $subject);
}