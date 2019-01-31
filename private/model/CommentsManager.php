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

		$comments = $db->prepare('	SELECT	comments.ID AS ID,
													users.user AS user,
													pictureID,
													userID,
													content,
													DATE_FORMAT(`commentDate`, \'%d %M %Y at %Hh%im\') AS formatDate
											FROM comments 
											INNER JOIN users ON users.ID = comments.userID 
											WHERE pictureID = ?
											ORDER BY commentDate ASC');
		$comments->execute(array($pictureID));

		return $comments;
	}

	public function postComment($pictureID, $userID, $content)
	{
		$db = $this->dbConnect();

		$comments = $db->prepare('	INSERT INTO	comments(pictureID, 
														userID, 
														content, 
														`commentDate`) 
											VALUES(:pictureID, :userID, :content, NOW())');
		$comments->execute(array(
							   'pictureID' => $pictureID,
							   'userID'    => $userID,
							   'content'   => $content
						   ));

		$addComment = $db->prepare('	UPDATE `pictures` 
								  				SET `commentCount` = `commentCount` + 1 
								  				WHERE `ID` = ?');
		$addComment->execute(array($pictureID));


	}

	public function remComment($commentID, $pictureID)
	{
		$db = $this->dbConnect();

		$comments = $db->prepare('	DELETE FROM comments 
											WHERE ID = ?');
		$comments->execute(array($commentID));

		$addComment =
			$db->prepare('	UPDATE `pictures` 
									SET `commentCount` = `commentCount` - 1 
									WHERE `ID` = ?');
		$addComment->execute(array($pictureID));
	}

	public function notification($userID)
	{
		$db = $this->dbConnect();

		$userTmp = $db->prepare('	SELECT	`email`,
													`notification`													   										
											FROM 	`users`
											WHERE 	`ID` = ?');
		$userTmp->execute(array($userID));

		return ($userTmp);
	}
}

