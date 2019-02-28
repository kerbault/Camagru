<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:53
 */

function checkDuplicate($userName, $email, $passwd, $confirmpasswd, $usersManager)
{
    $wrong = 0;
    $usersList = $usersManager->listUsers();

    foreach ($usersList as $user) {
        if ($user['user'] == $userName) {
            $wrong += 1;
        }
        if ($user['email'] == $email) {
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
        $usersManager = new users();
        $usersList = $usersManager->listUsers();
        require('private/view/navSettings.php');
    } else {
        throw new Exception('your account is not active yet or blocked, please verify before contacting us');
    }
}

function register()
{
    $usersManager = new users();
    $userName = htmlspecialchars($_POST['user']);
    $email = htmlspecialchars($_POST['email']);
    $tmpPasswd = htmlspecialchars($_POST['passwd']);
    $passwd = password_hash($tmpPasswd, PASSWORD_DEFAULT);
    $confirmPasswd = htmlspecialchars($_POST['confirmpasswd']);
    $validkey = hash('sha1', (round(microtime(true) * 1000) . rand(100, 999)));

    if (preg_match('/[a-zA-Z0-9]{4,25}/', $userName) == FALSE ||
        preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}/', $tmpPasswd) == FALSE ||
        preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,255}$/', $email) == FALSE) {
        throw new Exception('I know what you did there and it won\'t work');
    }

    $valid = checkDuplicate($userName, $email, $tmpPasswd, $confirmPasswd, $usersManager);
    switch ($valid) {
        case 0:
            $usersManager->register($userName, $email, $passwd, $validkey);
            verificationMail($email, $userName, $validkey);
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

function login($userName, $passwd)
{

    $passwd = htmlspecialchars($passwd);
    $userName = htmlspecialchars($userName);

    $usersManager = new users();
    $user = $usersManager->login($userName);

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
    $usersManager = new users();
    $verify = $usersManager->verifyKey($user);

    if ($verify['validkey'] == $verifyKey && $verify['validkey'] !== '0') {
        if ($verify['status'] == 1) {
            $usersManager->changeStatus($verify['ID'], 2);
            $usersManager->changeValidKey($verify['ID'], 0);
            message('Your account is now verified, you may now log in');
        } else {
            throw new Exception('Your account has been verified already');
        }
    } else {
        throw new Exception('We connot verify your account or is verified already');
    }
}

function verifyStatus()
{
    if ($_SESSION['userID'] > 0) {
        $usersManager = new users();
        $status = $usersManager->verifyStatus($_SESSION['userID']);

        return ($status['status']);
    } else {
        return (0);
    }
}

function changeStatus($userID, $status)
{
    if (verifyStatus() > 2) {
        if ($status == 0 || $userID == 0) {
            throw new Exception('You need to select valid fields');
        }

        $usersManager = new users();
        $req = $usersManager->changeStatus($userID, $status);

        if ($req) {
            header('Location: index.php?action=getSettings');
        } else {
            throw new Exception('Error: status not updated');
        }
    } else {
        throw new Exception('You don\'t have the right to do that');
    }

}

function changePassword($oldPassword, $newPassword, $confirmPasswd)
{

    $oldPassword = htmlspecialchars($oldPassword);
    $newPassword = htmlspecialchars($newPassword);
    $confirmPasswd = htmlspecialchars($confirmPasswd);

    if ($newPassword === $confirmPasswd) {

        $usersManager = new users();

        $userTmp = $usersManager->getUserByID($_SESSION['userID']);
        $user = $userTmp->fetch();

        if (password_verify($oldPassword, $user['password'])) {
            $safePassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $usersManager->changePassword($_SESSION['userID'], $safePassword);
            message("Password changed with success");
        } else {
            throw new Exception('wrong password');
        }
    } else {
        throw new Exception('Confirmed password is different from the new one');

    }
}

function resetPassword($userName, $verifyKey, $newPassword, $confirmPasswd)
{
    $userName = htmlspecialchars($userName);
    $verifyKey = htmlspecialchars($verifyKey);
    $newPassword = htmlspecialchars($newPassword);
    $confirmPasswd = htmlspecialchars($confirmPasswd);

    $usersManager = new users();
    $verify = $usersManager->verifyKey($userName);

    if ($verify['validkey'] == $verifyKey && $verify['validkey'] != 0) {
        if ($newPassword === $confirmPasswd) {
            $usersManager = new users();

            $userTmp = $usersManager->getUserByName($userName);
            $user = $userTmp->fetch();

            if ($verifyKey == $user['validkey']) {
                $safePassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $usersManager->changePassword($user['ID'], $safePassword);
                $usersManager->changeValidKey($user['ID'], 0);

                message("Password changed with success");
            } else {
                throw new Exception('wrong password');
            }
        } else {
            throw new Exception('Confirmed password is different from the new one');
        }
    } else {
        throw new Exception('We cannot change your password, please Contact us');
    }
}

function changeNotif($userID, $notifStatus)
{
    $usersManager = new users();
    $req = $usersManager->changeNotif($userID, $notifStatus);

    header('Location: index.php?action=getSettings');
}

function forgetLogin($email)
{
    $email = htmlspecialchars($email);

    $usersManager = new users();
    $userTmp = $usersManager->getUserByEmail($email);
    $user = $userTmp->fetch();
    $validkey = hash('sha1', (round(microtime(true) * 1000) . rand(10000000, 99999999)));

    if ($user) {
        $usersManager->changeValidKey($user['ID'], $validkey);
        mailLogin($user['email'], $user['user'], $validkey);
    }
    message('A mail has been sent to reset your password if this one is found in our database');

}