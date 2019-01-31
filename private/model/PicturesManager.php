<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 26/11/2018
 * Time: 17:35
 */

require_once('private/model/Manager.php');

class pictures extends Manager
{
	public function uploadPictureDb($pictureName)
	{
		$db     = $this->dbConnect();
		$userID = $_SESSION['userID'];

		$newPost = $db->prepare('INSERT INTO `pictures`(`userID`,`name`,`date`)
        VALUES(:userID, :name, NOW())');

		$newPost->execute(array(
							  'userID' => "$userID",
							  'name'   => "$pictureName"
						  ));
	}

	public function remPicture($pictureID)
	{
		$db = $this->dbConnect();

		$selected = $db->prepare('SELECT `name` FROM `pictures` WHERE `ID` = ?');
		$selected->execute(array($pictureID));
		$deleted = $selected->fetch();

		$likes = $db->prepare('DELETE FROM `likes` WHERE `pictureID` = ?');
		$likes->execute(array($pictureID));

		$comments = $db->prepare('DELETE FROM `comments` WHERE `pictureID` = ?');
		$comments->execute(array($pictureID));

		$picture = $db->prepare('DELETE FROM `pictures` WHERE `ID` = ?');
		$picture->execute(array($pictureID));

		return ($deleted);
	}
}