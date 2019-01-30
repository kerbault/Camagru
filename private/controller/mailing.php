<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:48
 */

function contactHelp()
{
	if (isset($_POST['from']) && isset($_POST['content']) && isset($_POST['subject'])) {

		$to     = 'kerbault.contact@gmail.com';
		$prefix = '[Camagru] ';

		echo($to);
		echo($prefix . $_POST['subject']);
		echo($_POST['content'] . $_POST['from']);
		$sent = mail($to, $prefix . $_POST['subject'], $_POST['content'] . $_POST['from']);
		var_dump($sent);
		if ($sent) {
			// header('Location: index.php?action=getContact');
		} else {
			throw new Exception('Something went wrong, Check if there is no empty field or try again later');
		}
	} else {
		throw new Exception('Some field are empty, please check again2');
	}
}

function verificationMail($to, $user, $validKey)
{
	$subject = 'Welcome on Camagru';
	$content = 'Welcome on Camagru, please clic on the following link : ';
	$link    =
		'http://localhost:8008/01_progress/Camagru/index.php?action=resetAccount2nd&user=' . $user .
		'&verifyKey=' .
		$validKey;
	$sent    = mail($to, $subject, $content . $link);
	if ($sent) {
		throw new Exception('A mail has been sent to verify your account, please open the link given inside');
	} else {
		throw new Exception('Something went wrong, Check if there is no empty field or try again later');
	}
}

function mailLogin($to, $user, $validKey)
{
	$subject = 'Welcome on Camagru';
	$content = 'It seems like you forgot how to login, here is your user name "' . $user .
			   "\" if you need to reset your password please clic on the following link : ";
	$link    =
		'http://localhost:8008/01_progress/Camagru/index.php?action=resetAccount2nd&user=' . $user .
		'&verifyKey=' . $validKey;
	mail($to, $subject, $content . $link);
}

function notifyComment($userID, $pictureID)
{
	$commentManager = new comments();

	$userTmp = $commentManager->notification($userID);
	$user    = $userTmp->fetch();

	if ($user['notification'] == 1) {
		$to      = $user['email'];
		$subject = '[Camagru] You have a notification';
		$content = 'Someone commented the following picture :';
		$link    =
			'http://localhost:8008/01_progress/Camagru/index.php?action=getOne&pictureID=' . $pictureID;

		$sent = mail($to, $subject, $content . $link);
		if (!$sent) {
			throw new Exception('Something went wrong, Check if there is no empty field or try again later');
		}
	}
}