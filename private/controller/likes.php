<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 2019-01-31
 * Time: 20:25
 */

function like($pictureID)
{
	$likesManager = new likes();
	$checkLikeTmp = $likesManager->checkLike($_SESSION['userID'], $pictureID);
	$checkLike    = $checkLikeTmp->fetch();

	if (verifyStatus() < 2) {
		throw new Exception("You need a valid account to like this picture");
	}

	if (!$checkLike) {
		$likesManager->like($_SESSION['userID'], $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You already liked this picture");
	}
}

function dislike($pictureID)
{
	$likesManager = new likes();
	$checkLikeTmp = $likesManager->checkLike($_SESSION['userID'], $pictureID);
	$checkLike    = $checkLikeTmp->fetch();

	if (verifyStatus() < 2) {
		throw new Exception("You need a valid account to dislike this picture");
	}

	if ($checkLike) {
		$likesManager->dislike($_SESSION['userID'], $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You already disliked this picture");
	}
}