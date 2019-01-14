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

		$recent = $db->query('SELECT * FROM `pictures` ORDER BY `id` DESC LIMIT 50');
		return $recent;
	}

	public function popular()
	{
		$db = $this->dbConnect();

		$popular = $db->query('SELECT * FROM `pictures` ORDER BY `likeCount` DESC LIMIT 50');
		return $popular;
	}

	public function focus($pictureId)
	{
		$db = $this->dbConnect();

		$pictureTmp = $db->prepare('SELECT `id`, `userID`, `likeCount`, `commentCount`, `name`, DATE_FORMAT(`date`, \'%d %M %Y at %Hh%im\') AS formatDate FROM `pictures` WHERE `id` = ?');
		$pictureTmp->execute(array($pictureId));

		return $pictureTmp;
	}

	public function gallery()
	{
		$db = $this->dbConnect();

		$recent = $db->query('SELECT * FROM `pictures` ORDER BY `id` DESC LIMIT 50');
		return $recent;
	}

	public function faved()
	{
		$db = $this->dbConnect();

		$recent = $db->query('SELECT * FROM `pictures` ORDER BY `id` DESC LIMIT 50');
		return $recent;
	}

	public function myPost()
	{
		$db = $this->dbConnect();

		$myPost = $db->query('SELECT * FROM `pictures` ORDER BY `id` DESC LIMIT 50');
		return $myPost;
	}

	public function myFavs()
	{
		$db = $this->dbConnect();

		$myFavs = $db->query('SELECT * FROM `pictures` ORDER BY `id` DESC LIMIT 50');
		return $myFavs;
	}
}