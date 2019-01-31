<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 29/11/2018
 * Time: 17:32
 */

require_once('private/model/Manager.php');

class users extends Manager
{
	public function listUsers()
	{
		$db = $this->dbConnect();

		$users = $db->query('SELECT `ID`, `user`, `email`, `notification` FROM `users`');

		return $users;
	}

	public function getUserByID($userID)
	{
		$db = $this->dbConnect();

		$userNameTmp = $db->prepare('SELECT * FROM `users` WHERE `ID` = ?');
		$userNameTmp->execute(array($userID));

		return $userNameTmp;
	}

	public function getUserByName($user)
	{
		$db = $this->dbConnect();

		$userNameTmp = $db->prepare('SELECT * FROM `users` WHERE `user` = ?');
		$userNameTmp->execute(array($user));

		return $userNameTmp;
	}

	public function getUserByEmail($email)
	{
		$db = $this->dbConnect();

		$userNameTmp = $db->prepare('SELECT `ID`, `user`, `email` FROM `users` WHERE `email` = ?');
		$userNameTmp->execute(array($email));

		return $userNameTmp;
	}

	public function register($user, $email, $passwd, $validkey)
	{
		$db = $this->dbConnect();

		$insert = $db->prepare('	INSERT INTO `users`(`user`, `password`, `email`, `creationDate`, `validkey`)
               	                        	VALUES (:user, :password, :email, NOW(), :validkey)');
		$req    = $insert->execute(array(
									   'user'     => $user,
									   'password' => $passwd,
									   'email'    => $email,
									   'validkey' => $validkey
								   ));
		return ($req);
	}

	public function login($user)
	{
		$db = $this->dbConnect();

		$loginTmp =
			$db->prepare('SELECT `ID`, `user`, `password`, `status` FROM `users` WHERE `user` = ?');
		$loginTmp->execute(array($user));
		$login = $loginTmp->fetch();

		return $login;
	}

	public function verifyKey($user)
	{
		$db = $this->dbConnect();

		$verifyTmp =
			$db->prepare('SELECT `ID`, `user`, `status`, `validkey` FROM `users` WHERE `user` = ?');
		$verifyTmp->execute(array($user));
		$verify = $verifyTmp->fetch();

		return $verify;
	}

	public function verifyStatus($userID)
	{
		$db = $this->dbConnect();

		$statusTmp = $db->prepare('SELECT `status` FROM `users` WHERE `ID` = ?');
		$statusTmp->execute(array($userID));
		$status = $statusTmp->fetch();

		return $status;
	}

	public function changeStatus($userID, $status)
	{
		$db = $this->dbConnect();

		$update = $db->prepare('UPDATE `users` SET `status` = :status WHERE `ID` = :ID');
		$req    = $update->execute(array(
									   'status' => $status,
									   'ID'     => $userID
								   ));
		return ($req);
	}

	public function changePassword($userID, $newPassword)
	{
		$db = $this->dbConnect();

		$update = $db->prepare('UPDATE `users` SET `password` = :newPassword WHERE `ID` = :userID');
		$req    = $update->execute(array(
									   'newPassword' => $newPassword,
									   'userID'      => $userID
								   ));
		return ($req);
	}

	public function changeNotif($userID, $validkey)
	{
		$db = $this->dbConnect();

		$update = $db->prepare('UPDATE `users` SET `notification` = :notification WHERE `ID` = :userID');
		$req    = $update->execute(array(
									   'userID'       => $userID,
									   'notification' => $validkey
								   ));
		return ($req);
	}

	public function changeValidKey($userID, $validkey)
	{
		$db = $this->dbConnect();

		$update = $db->prepare('UPDATE `users` SET `validkey` = :validkey WHERE `ID` = :userID');
		$req    = $update->execute(array(
									   'validkey' => $validkey,
									   'userID'   => $userID
								   ));
		return ($req);
	}
}