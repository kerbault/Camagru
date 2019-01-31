<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 2019-01-31
 * Time: 16:56
 */

function addComment($content, $pictureID, $userID)
{
	$content = htmlspecialchars($content);

	if (verifyStatus() > 1) {
		$commentsManager = new comments();
		$commentsManager->postComment($pictureID, $_SESSION['userID'], $content);
		notifyComment($userID, $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You need a valid account to post a comment");
	}
}

function remComment($userID, $commentID, $pictureID)
{
	if (($userID === $_SESSION['userID'] && verifyStatus() > 1) || verifyStatus() > 1) {
		$commentsManager = new comments();
		$commentsManager->remComment($commentID, $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You don't have the right to remove this comment");
	}
}