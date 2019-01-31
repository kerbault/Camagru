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

function like($pictureID)
{
	$commentsManager = new comments();
	$checkLikeTmp    = $commentsManager->checkLike($_SESSION['userID'], $pictureID);
	$checkLike       = $checkLikeTmp->fetch();

	if (verifyStatus() < 2 || $_SESSION['userID'] < 1) {
		throw new Exception("You need a valid account to like this picture");
	}

	if (!$checkLike) {
		$commentsManager->like($_SESSION['userID'], $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You already liked this picture");
	}
}

function dislike($pictureID)
{
	$commentsManager = new comments();
	$checkLikeTmp    = $commentsManager->checkLike($_SESSION['userID'], $pictureID);
	$checkLike       = $checkLikeTmp->fetch();

	if (verifyStatus() < 2 || $_SESSION['userID'] < 1) {
		throw new Exception("You need a valid account to dislike this picture");
	}

	if ($checkLike) {
		$commentsManager->dislike($_SESSION['userID'], $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You already disliked this picture");
	}
}

function contactHelp($subject, $content, $from)
{
	$to      = 'kerbault.contact@gmail.com';
	$prefix  = '[Camagru] ';
	$subject = htmlspecialchars($subject);
	$content = htmlspecialchars($content);
	$from    = htmlspecialchars($from);

	if (mail($to, $prefix . $subject, $content . $from)) {
		message("Your message has been sent, we will return to you as soon as possible");
	} else {
		throw new Exception('Something went wrong, Check if there is no empty field or try again later');
	}

}

function verificationMail($to, $user, $validKey)
{
	$prefix  = '[Camagru]';
	$url     = 'http://localhost:8008/';
	$subject = $prefix . ' Welcome on Camagru';
	$content = 'Welcome on Camagru, please clic on the following link : ';
	$link    = $url . 'index.php?action=verify&user=' . $user . '&verifyKey=' . $validKey;

	if (mail($to, $subject, $content . $link)) {
		throw new Exception('A mail has been sent to verify your account, please open the link given inside');
	} else {
		throw new Exception('Something went wrong, Check if there is no empty field or try again later');
	}
}

function mailLogin($to, $user, $validKey)
{
	$prefix  = '[Camagru]';
	$url     = 'http://localhost:8008/';
	$subject = $prefix . 'Your identifiants';
	$content = 'It seems like you forgot how to login, here is your user name "' . $user .
			   "\" if you need to reset your password please clic on the following link : ";
	$link    = $url . '/index.php?action=resetAccount2nd&user=' . $user . '&verifyKey=' . $validKey;

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