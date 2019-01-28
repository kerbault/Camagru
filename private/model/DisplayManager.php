<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 20/12/2018
 * Time: 22:42
 */

require_once('private/model/Manager.php');

class display extends Manager
{
	public function recent()
	{
		$db = $this->dbConnect();

		$recent = $db->query('SELECT	pictures.ID as pictureID,
												name,
												likeCount,
												commentCount   										
										FROM `pictures`
										INNER JOIN users ON users.ID = pictures.userID 
										ORDER BY pictures.ID DESC LIMIT 50');

		return $recent;
	}

	public function popular()
	{
		$db = $this->dbConnect();

		$popular = $db->query('SELECT * 
										 FROM `pictures`
										 INNER JOIN users ON users.ID = pictures.userID 
										 ORDER BY `likeCount` DESC LIMIT 50');

		return $popular;
	}

	public function focus($pictureID)
	{
		$db = $this->dbConnect();

		$pictureTmp = $db->prepare('SELECT	pictures.ID,
													userID,
													users.user AS user,
 													`likeCount`, 
 													`commentCount`, 
 													`name`,
 													DATE_FORMAT(`date`, \'%d %M %Y at %Hh%im\') AS formatDate 
											  FROM `pictures` 
											  INNER JOIN users ON users.ID = pictures.userID
											  WHERE pictures.ID = ?');
		$pictureTmp->execute(array($pictureID));

		return $pictureTmp;
	}

	public function gallery()
	{
		$db = $this->dbConnect();

		$recent = $db->query('SELECT * FROM `pictures` ORDER BY `ID` DESC LIMIT 50');

		return $recent;
	}

	public function faved()
	{
		$db = $this->dbConnect();

		$recent = $db->query('SELECT * FROM `pictures` ORDER BY `ID` DESC LIMIT 50');

		return $recent;
	}

	public function userPosts($userID)
	{
		$db = $this->dbConnect();

		$userPostsTmp =
			$db->prepare('SELECT * 
									FROM `pictures` 
									WHERE `userID` = ? 
									ORDER BY `ID` DESC LIMIT 50 ');
		$userPostsTmp->execute(array($userID));

		return $userPostsTmp;
	}

	public function userFavs($userID)
	{
		$db = $this->dbConnect();

		$userFavsTmp =
			$db->prepare('SELECT * 
									FROM `likes`
									INNER JOIN pictures ON pictures.ID = likes.pictureID
									WHERE likes.userID = ? 
									ORDER BY `likeDate` DESC LIMIT 50 ');
		$userFavsTmp->execute(array($userID));

		return $userFavsTmp;
	}
}