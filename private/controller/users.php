<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:53
 */

function checkDuplicate($user, $email, $passwd, $confirmpasswd, $registerManager)
{
	$wrong = 0;
	$users = $registerManager->checkValidity();

	foreach ($users as $tmp) {
		if ($tmp['user'] == $user) {
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

function getSettings()
{
	if (verifyStatus() > 1) {
		$usersManager = new user();
		$users = $usersManager->listUsers();
		require('private/view/navSettings.php');
	} else {
		throw new Exception('your account is not active yet or blocked, please verify before contacting us');
	}
}

function register()
{
	$registerManager = new user();
	$user = htmlspecialchars($_POST['user']);
	$email = htmlspecialchars($_POST['email']);
	$tmpPasswd = htmlspecialchars($_POST['passwd']);
	$passwd = password_hash($tmpPasswd, PASSWORD_DEFAULT);
	$confirmPasswd = htmlspecialchars($_POST['confirmpasswd']);
	$validkey = hash('sha1', (round(microtime(true) * 1000) . rand(100, 999)));

	if (preg_match('/[a-zA-Z0-9]{4,25}/', $user) == FALSE ||
		preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}/', $tmpPasswd) == FALSE ||
		preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,255}$/', $email) == FALSE) {
		throw new Exception('I know what you did there and it won\'t work');
	}

	$valid = checkDuplicate($user, $email, $tmpPasswd, $confirmPasswd, $registerManager);
	switch ($valid) {
		case 0:
			$registerManager->register($user, $email, $passwd, $validkey);
			verificationMail($email, $user, $validkey);
		case 1:
			throw new Exception('user already used');
		case 2:
			throw new Exception('email already used');
		case 4:
			throw new Exception('confirmed password is different from the original');
		case 3:
			throw new Exception('user and email already used');
		case 5:
			throw new Exception('user already used and confirmed password is different from the original ');
		case 7:
			throw new Exception('user and email already used and confirmed password is different from the original ');
		default:
			throw new Exception('Something unexpected happened, please try again or Contact us');
	}
	require('private/view/navRegister.php');
}

function login($user, $passwd)
{
	$userManager = new user();

	$user = $userManager->login($user);

	if (password_verify($passwd, $user['password'])) {
		if ($user['status'] < 0) {
			throw new Exception('Your account is actually blocked');
		} elseif ($user['status'] == 1) {
			throw new Exception('Your account is not active yet, please check the mail we sent during the registration.');
		} else {
			$_SESSION['userID'] = $user['ID'];
			header('Location: index.php?action=getRecent');
		}
	} else {
		throw new Exception('wrong login or password');
	}
}

function logout()
{
	$_SESSION['userID'] = 0;
	header('Location: index.php?action=getRecent');
}

function verifyAccount($user, $verifyKey)
{
	$userManager = new user();
	$verify = $userManager->verifyKey($user);

	if ($verify['validkey'] == $verifyKey) {
		if ($verify['status'] == 1) {
			$userManager->changeStatus($verify['ID'], 2);
			throw new Exception('Your account is now verified, you may now log in');
		} else {
			throw new Exception('Your account has been verified already');
		}
	} else {
		throw new Exception('We connot verify your account, please Contact us');
	}
}

function verifyStatus()
{
	if ($_SESSION['userID'] > 0) {
		$userManager = new user();
		$status = $userManager->verifyStatus($_SESSION['userID']);

		return ($status['status']);
	};
}

function changeStatus($userID, $status)
{
	if (verifyStatus() > 2) {
		if ($status == 0 || $userID == 0) {
			throw new Exception('You need to select valid fields');
		}

		$userManager = new user();
		$req = $userManager->changeStatus($userID, $status);

		if ($req) {
			header('Location: index.php?action=getSettings');
		} else {
			throw new Exception('Error: status not updated');
		}
	} else {
		throw new Exception('You don\'t have the right to do that');
	}

}

function changePassword()
{

}

function changeNotif($userID, $notifStatus)
{
	$userManager = new user();
	$req = $userManager->changeNotif($userID, $notifStatus);

	header('Location: index.php?action=getSettings');
}