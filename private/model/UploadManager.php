<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 26/11/2018
 * Time: 17:35
 */

require_once('private/model/Manager.php');

class upload extends Manager
{
	public function uploadPictureDb($pictureName)
	{
		$db = $this->dbConnect();
		$userId = $_SESSION['id'];

		$newPost = $db->prepare('INSERT INTO `pictures`(`userID`,`name`,`date`)
        VALUES(:userID, :name, NOW())');

		$newPost->execute(array(
			'userID' => "$userId",
			'name' => "$pictureName"
		));
	}

	public function remPicture($pictureId)
	{
		$db = $this->dbConnect();

		$selected = $db->prepare('SELECT `name` FROM `pictures` WHERE `id` = ?');
		$selected->execute(array($pictureId));
		$deleted = $selected->fetch();

		$likes = $db->prepare('DELETE FROM `likes` WHERE `pictureID` = ?');
		$likes->execute(array($pictureId));

		$comments = $db->prepare('DELETE FROM `comments` WHERE `pictureID` = ?');
		$comments->execute(array($pictureId));

		$picture = $db->prepare('DELETE FROM `pictures` WHERE `id` = ?');
		$picture->execute(array($pictureId));

		return ($deleted);
	}
}