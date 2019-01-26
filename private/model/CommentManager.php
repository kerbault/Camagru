<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 20/12/2018
 * Time: 22:42
 */

require_once('private/model/Manager.php');

class comments extends Manager
{
	public function getComments($pictureID)
	{
		$db = $this->dbConnect();

		$comments =
			$db->prepare('	SELECT	comments.ID AS ID,
											users.user AS user,
											pictureID,
											userID,
											content,
											DATE_FORMAT(`commentDate`, \'%d %M %Y at %Hh%im\') AS formatDate
									FROM comments INNER JOIN users ON users.ID = comments.userID 
									WHERE pictureID = ?
									ORDER BY commentDate ASC');
		$comments->execute(array($pictureID));

		return $comments;
	}

	public function postComment($pictureID, $userID, $content)
	{
		$db = $this->dbConnect();

		$comments =
			$db->prepare('INSERT INTO comments(pictureID, userID, content, `commentDate`) VALUES(?, ?, ?, NOW())');
		$comments->execute(array($pictureID, $userID, $content));

		$addComment =
			$db->prepare('UPDATE `pictures` SET `commentCount` = `commentCount` + 1 WHERE `ID` = ?');
		$addComment->execute(array($pictureID));
	}

	public function remComment($commentID, $pictureID)
	{
		$db = $this->dbConnect();

		$comments = $db->prepare('DELETE FROM comments WHERE ID = ?');
		$comments->execute(array($commentID));

		$addComment =
			$db->prepare('UPDATE `pictures` SET `commentCount` = `commentCount` - 1 WHERE `ID` = ?');
		$addComment->execute(array($pictureID));
	}

	public function checkLike($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$liked =
			$db->prepare('SELECT * FROM `likes` WHERE `userID` = :userID AND `pictureID` = :pictureID');
		$liked->execute(array(
			'userID'    => $userID,
			'pictureID' => $pictureID
		));

		return $liked;

	}

	public function like($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$like =
			$db->prepare('INSERT INTO `likes`(`userID`, `pictureID`, `likeDate`) VALUES(:userID, :pictureID, NOW())');
		$like->execute(array(
			'userID'    => $userID,
			'pictureID' => $pictureID
		));

		$addLike = $db->prepare('UPDATE `pictures` SET `likeCount` = `likeCount` + 1 WHERE `ID` = ?');
		$addLike->execute(array($pictureID));
	}

	public function dislike($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$like = $db->prepare('DELETE FROM `likes` WHERE `userID` = :userID AND `pictureID` = :pictureID');
		$like->execute(array(
			'userID'    => $userID,
			'pictureID' => $pictureID
		));

		$remLike = $db->prepare('UPDATE `pictures` SET `likeCount` = `likeCount` - 1 WHERE `ID` = ?');
		$remLike->execute(array($pictureID));
	}
}