<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:50
 */



function getRecent()
{
	$displayManager = new display();
	$display = $displayManager->recent();
	require("private/view/display.php");
}

function getPopular()
{
	$displayManager = new display();
	$display = $displayManager->popular();
	require("private/view/display.php");
}

function getOne($pictureId)
{
	$displayManager = new display();
	$pictureTmp = $displayManager->focus($pictureId);
	$picture = $pictureTmp->fetch();

	if ($picture == NULL) {
		throw new Exception("The picture you've been looking for doesn't exist");
	}

	$commentsManager = new comments();
	$commentsTmp = $commentsManager->getComments($pictureId);

	$checkLikeTmp = $commentsManager->checkLike($_SESSION['id'], $pictureId);
	$liked = $checkLikeTmp->fetch();

	$usersManager = new user();
	$users = $usersManager->getUser();

	require("private/view/displayOne.php");
}

function getGallery()
{
	if ($_SESSION['user'] != "") {
		$displayManager = new display();
		$myPostTmp = $displayManager->myPost();
		$myFavsTmp = $displayManager->myPost();
		require("private/view/navGallery.php");
	} else {
		throw new Exception("You need an account to access this page");
	}
}

