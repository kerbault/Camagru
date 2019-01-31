<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:57
 */

function message($message)
{
	$_POST['message'] = $message;
	require('private/view/message.php');
}

function contactHelp($subject, $content, $from)
{
	$to      = 'kerbault.contact@gmail.com';
	$prefix  = '[Camagru] ';
	$subject = htmlspecialchars($subject);
	$content = htmlspecialchars($content);
	$from    = htmlspecialchars($from);

	if (mail($to, $prefix . $subject, $content . "\n\n" . $from)) {
		message("Your message has been sent, we will return to you as soon as possible");
	} else {
		throw new Exception('Something went wrong, Check if there is no empty field or try again later');
	}

}

function verificationMail($to, $userName, $validKey)
{
	$prefix  = '[Camagru]';
	$url     = 'http://localhost:8008/';
	$subject = $prefix . ' Welcome on Camagru';
	$content = 'Welcome on Camagru, please clic on the following link : ';
	$link    = $url . 'index.php?action=verify&user=' . $userName . '&verifyKey=' . $validKey;

	if (mail($to, $subject, $content . $link)) {
		throw new Exception('A mail has been sent to verify your account, please open the link given inside');
	} else {
		throw new Exception('Something went wrong, Check if there is no empty field or try again later');
	}
}

function mailLogin($to, $userName, $validKey)
{
	$prefix  = '[Camagru]';
	$url     = 'http://localhost:8008/';
	$subject = $prefix . 'Your identifiants';
	$content = 'It seems like you forgot how to login, here is your user name "' . $userName .
			   "\" if you need to reset your password please clic on the following link : ";
	$link    = $url . '/index.php?action=resetAccount2nd&user=' . $userName . '&verifyKey=' . $validKey;

	if (!mail($to, $subject, $content . $link)) {
		throw new Exception('Something went wrong with mailing, please contact us to let us know');
	}
}

function notifyComment($userID, $pictureID)
{
	$commentsManager = new comments();

	$userTmp = $commentsManager->notification($userID);
	$user    = $userTmp->fetch();

	if ($user['notification'] == 1) {
		$prefix  = '[Camagru]';
		$url     = 'http://localhost:8008/';
		$to      = $user['email'];
		$subject = $prefix . ' You have a notification';
		$content = 'Someone commented the following picture :';
		$link    = $url . '/index.php?action=getOne&pictureID=' . $pictureID;

		if (!mail($to, $subject, $content . $link)) {
			throw new Exception('Something went wrong with mailing, please contact us to let us know');
		}
	}
}