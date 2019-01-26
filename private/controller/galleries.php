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
	require("private/view/navRecentPopular.php");
}

function getPopular()
{
	$displayManager = new display();
	$display = $displayManager->popular();
	require("private/view/navRecentPopular.php");
}

function getOne($pictureID)
{
	$displayManager = new display();
	$pictureTmp = $displayManager->focus($pictureID);
	$picture = $pictureTmp->fetch();

	if ($picture == NULL) {
		throw new Exception("The picture you've been looking for doesn't exist");
	}

	$commentsManager = new comments();
	$commentsTmp = $commentsManager->getComments($pictureID);

	$checkLikeTmp = $commentsManager->checkLike($_SESSION['userID'], $pictureID);
	$liked = $checkLikeTmp->fetch();

	$usersManager = new user();
	$users = $usersManager->listUsers();

	require("private/view/displayOne.php");
}


function getGallery($userID)
{
	$displayManager = new display();

	$userPostsTmp = $displayManager->userPosts($userID);
	$userPosts = $userPostsTmp->fetch();


	$userFavsTmp = $displayManager->userFavs($userID);
	$userFavs = $userFavsTmp->fetch();

	if ($userPosts === NULL && $userFavs === NULL) {
		throw new Exception("This gallery doesn't exist or it's empty");
	}

	$userPostsTmp->closeCursor();
	$userPostsTmp->execute();

	$userFavsTmp->closeCursor();
	$userFavsTmp->execute();

	require("private/view/navGallery.php");
}

