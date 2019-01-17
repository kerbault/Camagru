<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:48
 */

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