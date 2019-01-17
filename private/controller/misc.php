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

function verifyStatus()
{
	if ($_SESSION['id'] > 0) {
		$userManager = new user();
		$status = $userManager->verifyStatus($_SESSION['id']);

		return ($status['status']);
	};
}

function changeStatus()
{
	if (verifyStatus() > 2 && isset($_POST['userId']) && isset($_POST['newStatus'])) {
		$userManager = new user();
		$userManager->changeStatus($_POST['userId'], $_POST['newStatus']);
		message("Status updated with success");
	} else {
		throw new Exception('You don\'t have the rights to do that');
	}
}