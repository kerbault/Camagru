<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 20/12/2018
 * Time: 22:42
 */

require_once('private/model/Manager.php');

class galleries extends Manager
{
	public function recent()
	{
		$db = $this->dbConnect();

		$recent = $db->query('SELECT	pictures.ID as pictureID,
												pictures.name,
												likeCount,
												commentCount   										
										FROM `pictures`
										INNER JOIN users ON users.ID = pictures.userID 
										ORDER BY pictures.ID DESC');

		return $recent;
	}

	public function popular()
	{
		$db = $this->dbConnect();

		$popular = $db->query('SELECT pictures.ID as pictureID,
												pictures.name,
												likeCount,
												commentCount 
										 FROM `pictures`
										 INNER JOIN users ON users.ID = pictures.userID 
										 ORDER BY `likeCount` DESC');

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

		$recent = $db->query('SELECT * FROM `pictures` ORDER BY `ID` DESC');

		return $recent;
	}

	public function userPosts($userID)
	{
		$db = $this->dbConnect();

		$userPostsList =
			$db->prepare('SELECT * 
									FROM `pictures` 
									WHERE `userID` = ? 
									ORDER BY `ID` DESC');
		$userPostsList->execute(array($userID));

		return $userPostsList;
	}

	public function userFavs($userID)
	{
		$db = $this->dbConnect();

		$userFavsList =
			$db->prepare('SELECT * 
									FROM `likes`
									INNER JOIN users ON users.ID = likes.userID
									INNER JOIN pictures ON pictures.ID = likes.pictureID
									WHERE likes.userID = ? 
									ORDER BY `likeDate` DESC');
		$userFavsList->execute(array($userID));

		return $userFavsList;
	}
}