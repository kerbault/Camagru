<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:50
 */


function getRecent()
{
	$galleriesManager  = new galleries();
	$recentPopularList = $galleriesManager->recent();

	require("private/view/navRecentPopular.php");
}

function getPopular()
{
	$galleriesManager  = new galleries();
	$recentPopularList = $galleriesManager->popular();

	require("private/view/navRecentPopular.php");
}

function getOne($pictureID)
{
	$galleriesManager = new galleries();
	$pictureTmp       = $galleriesManager->focus($pictureID);
	$picture          = $pictureTmp->fetch();

	if ($picture == NULL) {
		throw new Exception("The picture you've been looking for doesn't exist");
	}

	$commentsManager = new comments();
	$commentsList    = $commentsManager->getComments($pictureID);

	$likesManager = new likes();
	$checkLikeTmp = $likesManager->checkLike($_SESSION['userID'], $pictureID);
	$liked        = $checkLikeTmp->fetch();

	require("private/view/displayOne.php");
}

function getGallery($userID)
{
	$galleriesManager = new galleries();

	$usersManager = new users();
	$userNameTmp  = $usersManager->getUserByID($userID);
	$userName     = $userNameTmp->fetch();


	$userPostsList = $galleriesManager->userPosts($userID);
	$userPosts     = $userPostsList->fetch();

	$userFavsList = $galleriesManager->userFavs($userID);
	$userFavs     = $userFavsList->fetch();

	if ($userPosts == NULL && $userFavs == NULL) {
		throw new Exception("This gallery doesn't exist or it's empty");
	}

	$userPostsList->closeCursor();
	$userPostsList->execute();

	$userFavsList->closeCursor();
	$userFavsList->execute();

	require("private/view/navGallery.php");
}

function getCapture($userID)
{
	$galleriesManager = new galleries();
	$userPostsList = $galleriesManager->userPosts($userID);

	require("private/view/navCapture.php");
}

function getUpload($userID)
{
	$galleriesManager = new galleries();
	$userPostsList = $galleriesManager->userPosts($userID);

	require("private/view/NavUpload.php");
}