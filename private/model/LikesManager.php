<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 2019-01-31
 * Time: 17:27
 */

require_once('private/model/Manager.php');

class likes extends Manager
{
	public function checkLike($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$liked = $db->prepare('	SELECT * 
										  	FROM `likes` 
											WHERE `userID` = :userID AND `pictureID` = :pictureID');
		$liked->execute(array(
							'userID'    => $userID,
							'pictureID' => $pictureID
						));

		return $liked;

	}

	public function like($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$like = $db->prepare('	INSERT INTO	`likes` (`userID`, `pictureID`, `likeDate`) 
										VALUES(:userID, :pictureID, NOW())');
		$like->execute(array(
						   'userID'    => $userID,
						   'pictureID' => $pictureID
					   ));

		$addLike = $db->prepare('	UPDATE `pictures` 
											SET `likeCount` = `likeCount` + 1 
											WHERE `ID` = ?');
		$addLike->execute(array($pictureID));
	}

	public function dislike($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$like = $db->prepare('	DELETE FROM `likes` 
										WHERE `userID` = :userID AND `pictureID` = :pictureID');
		$like->execute(array(
						   'userID'    => $userID,
						   'pictureID' => $pictureID
					   ));

		$remLike = $db->prepare('	UPDATE `pictures` 
											SET `likeCount` = `likeCount` - 1 
											WHERE `ID` = ?');
		$remLike->execute(array($pictureID));
	}

}