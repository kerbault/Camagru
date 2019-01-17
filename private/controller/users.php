<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:53
 */

function checkDuplicate($login, $email, $passwd, $confirmpasswd, $registerManager)
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
	$login = htmlspecialchars($_POST['Login']);
	$email = htmlspecialchars($_POST['email']);
	$tmpPasswd = htmlspecialchars($_POST['passwd']);
	$passwd = password_hash($tmpPasswd, PASSWORD_DEFAULT);
	$confirmPasswd = htmlspecialchars($_POST['confirmpasswd']);
	$validkey = hash('sha1', (round(microtime(true) * 1000) . rand(100, 999)));

	if (preg_match('/[a-zA-Z0-9]{4,25}/', $login) == FALSE ||
		preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}/', $tmpPasswd) == FALSE ||
		preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,255}$/', $email) == FALSE) {
		throw new Exception('I know what you did there and it won\'t work');
	}

	$valid = checkDuplicate($login, $email, $tmpPasswd, $confirmPasswd, $registerManager);
	switch ($valid) {
		case 0:
			$registerManager->register($login, $email, $passwd, $validkey);
			verificationMail($email, $validkey);
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
		default:
			throw new Exception('Something unexpected happened, please try again or Contact us');
	}
	require('private/view/navRegister.php');
}

function login()
{
	$loginManager = new user();
	$login = htmlspecialchars($_POST['user']);
	$tmpPasswd = htmlspecialchars($_POST['passwd']);
	$passwd = htmlspecialchars($tmpPasswd, PASSWORD_DEFAULT);
	$users = $loginManager->login();

	foreach ($users as $tmp) {
		if ($tmp['login'] == $login) {

			if (password_verify($passwd, $tmp['password'])) {
				if ($tmp['status'] < 0) {
					throw new Exception('Your account is actually blocked');
				} elseif ($tmp['status'] == 1) {
					throw new Exception('Your account is not active yet, please check the mail we sent during the registration.');
				} else {
					$_SESSION['id'] = $tmp['id'];
					$_SESSION['user'] = $login;
					header('Location: index.php?action=getRecent');
				}
			} else {
				throw new Exception('wrong password');
			}
		}
	}
	throw new Exception('wrong login');
}

function logout()
{
	$_SESSION['user'] = "";
	$_SESSION['id'] = 0;
	header('Location: index.php?action=getRecent');
}

function verifyAccount($verifyId)
{
	$userManager = new user();
	$users = $userManager->verifyId();

	foreach ($users as $tmp) {
		if ($tmp['validkey'] == $verifyId) {
			if ($tmp['status'] == 1) {
				$userManager->changeStatus($tmp['id'], 2);
				throw new Exception('Your account is now verified, you may now log in');
			} else {
				throw new Exception('Your account has been verified already');
			}
		}
	}
	throw new Exception('We connot activate your account, please Contact us');
}

