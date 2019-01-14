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
	public function getComments($pictureId)
	{
		$db = $this->dbConnect();

		$comments = $db->prepare('SELECT `id`, `pictureID`, `user`, `content`, DATE_FORMAT(`commentDate`, \'%d %M %Y at %Hh%im\') AS formatDate FROM comments WHERE pictureID = ? ORDER BY commentDate ASC ');
		$comments->execute(array($pictureId));

		return $comments;
	}

	public function postComment($pictureId, $user, $content)
	{
		$db = $this->dbConnect();

		$comments = $db->prepare('INSERT INTO comments(pictureID, user, content, `commentDate`) VALUES(?, ?, ?, NOW())');
		$comments->execute(array($pictureId, $user, $content));

		$addComment = $db->prepare('UPDATE `pictures` SET `commentCount` = `commentCount` + 1 WHERE `id` = ?');
		$addComment->execute(array($pictureId));
	}

	public function remComment($commentID, $pictureId)
	{
		$db = $this->dbConnect();

		$comments = $db->prepare('DELETE FROM comments WHERE ID = ?');
		$comments->execute(array($commentID));

		$addComment = $db->prepare('UPDATE `pictures` SET `commentCount` = `commentCount` - 1 WHERE `id` = ?');
		$addComment->execute(array($pictureId));
	}

	public function checkLike($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$liked = $db->prepare('SELECT * FROM `likes` WHERE `userID` = :userID AND `pictureID` = :pictureID');
		$liked->execute(array(
			'userID' => $userID,
			'pictureID' => $pictureID
		));

		return $liked;

	}

	public function like($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$like = $db->prepare('INSERT INTO `likes`(`userID`, `pictureID`, `likeDate`) VALUES(:userID, :pictureID, NOW())');
		$like->execute(array(
			'userID' => $userID,
			'pictureID' => $pictureID
		));

		$addLike = $db->prepare('UPDATE `pictures` SET `likeCount` = `likeCount` + 1 WHERE `id` = ?');
		$addLike->execute(array($pictureID));
	}

	public function dislike($userID, $pictureID)
	{
		$db = $this->dbConnect();

		$like = $db->prepare('DELETE FROM `likes` WHERE `userID` = :userID AND `pictureID` = :pictureID');
		$like->execute(array(
			'userID' => $userID,
			'pictureID' => $pictureID
		));

		$remLike = $db->prepare('UPDATE `pictures` SET `likeCount` = `likeCount` - 1 WHERE `id` = ?');
		$remLike->execute(array($pictureID));
	}
}