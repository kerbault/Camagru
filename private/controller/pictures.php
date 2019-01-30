<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:54
 */

function uploadPicture()
{
	ob_get_contents();
	ob_end_clean();

	$allowedSize        = 2000000;
	$allowed_file_types = array('.jpg', '.gif', '.png', '.jpeg');
	$targetDir          = "public/captures/";

	if (isset($_POST['submit']) && isset($_POST['name']) && isset($_FILES['fileToUpload']['error'])) {
		if ($_FILES['fileToUpload']['error'] == 0) {
			$uploadManager = new upload();
			$fileName      = $_FILES["fileToUpload"]["name"];
			$fileBasename  = substr($fileName, 0, strripos($fileName, '.'));
			$fileExt       = substr($fileName, strripos($fileName, '.'));
			$fileSize      = $_FILES["fileToUpload"]["size"];
			$newFileName   = $_POST['name'] . $fileExt;

			if ($fileSize > $allowedSize) {
				throw new Exception("The uploaded file exceeds the allowed limit.");
			} elseif (empty($fileBasename)) {
				throw new Exception("Please select a file to upload.");
			} elseif (!in_array($fileExt, $allowed_file_types)) {
				throw new Exception("Only these file typs are allowed for upload: " .
									implode(', ', $allowed_file_types));
				unlink($_FILES["fileToUpload"]["tmp_name"]);
			} elseif (file_exists($targetDir . $newFileName)) {
				throw new Exception("You have already uploaded this file.");
			} else {
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetDir . $newFileName);
				$uploadManager->uploadPictureDb($newFileName);
				message("File uploaded successfully.");
			}
		} else {
			switch ($_FILES['fileToUpload']['error']) {
				case UPLOAD_ERR_INI_SIZE:
					throw new Exception("The uploaded file exceeds the upload_max_filesize directive in 
                                        php.ini");
				case UPLOAD_ERR_FORM_SIZE:
					throw new Exception("The uploaded file exceeds the MAX_FILE_SIZE directive that was 
                                        specified in the HTML form");
				case UPLOAD_ERR_PARTIAL:
					throw new Exception("The uploaded file was only partially uploaded");
				case UPLOAD_ERR_NO_FILE:
					throw new Exception("No file was uploaded");
				case UPLOAD_ERR_NO_TMP_DIR:
					throw new Exception("Missing a temporary folder");
				case UPLOAD_ERR_CANT_WRITE:
					throw new Exception("Failed to write file to disk");
				case UPLOAD_ERR_EXTENSION:
					throw new Exception("File upload stopped by extension");
				default:
					throw new Exception("Unknown upload error");
			}
		}
	} else {
		throw new Exception("Missing some needed data");
	}
}

function remPicture($userID, $pictureID)
{
	if (isset($_POST['userID']) && isset($_POST['pictureID'])) {

		$userID    = $_POST['userID'];
		$pictureID = $_POST['pictureID'];

		if (($userID === $_SESSION['userID'] && verifyStatus() > 1) || verifyStatus() > 2) {
			$uploadManager = new upload();
			$deleted       = $uploadManager->remPicture($pictureID);

			if ($deleted['name'] != "") {
				try {
					unlink('./public/captures/' . $deleted['name']);
					header('location: index.php');
				} catch (Exception $e) {
					throw new Exception("Hahem problem");
				}
			}
		} else {
			throw new Exception("You don't have the rights to remove this picture");
		}

	} else {
		throw new Exception('Some field are empty, please check again4');
	}
}

function addComment()
{
	if (isset($_POST['content']) && isset($_POST['ID'])) {

		$content   = $_POST['content'];
		$pictureID = $_POST['ID'];
		$userID    = $_POST['userID'];

		if (verifyStatus() > 1 && $_SESSION['userID'] > 0) {
			$commentsManager = new comments();
			$commentsManager->postComment($pictureID, $_SESSION['userID'], $content);
			notifyComment($userID, $pictureID);
			header('location: index.php?action=getOne&pictureID=' . $pictureID);
		} else {
			throw new Exception("You need a valid account to post a comment");
		}

	} else {
		throw new Exception('Some field are empty, please check again5');
	}
}

function remComment()
{
	if (isset($_POST['user']) && isset($_POST['commentID']) && isset($_POST['pictureID'])) {

		$user      = $_POST['user'];
		$commentID = $_POST['commentID'];
		$pictureID = $_POST['pictureID'];

		if (($user === $_SESSION['userID'] && verifyStatus() > 1) || verifyStatus() > 2) {
			$commentsManager = new comments();
			$commentsManager->remComment($commentID, $pictureID);
			header('location: index.php?action=getOne&pictureID=' . $pictureID);
		} else {
			throw new Exception("You don't have the right to remove this comment");
		}

	} else {
		throw new Exception('Some field test are empty, please check again');
	}
}

function like($pictureID)
{
	$commentsManager = new comments();
	$checkLikeTmp    = $commentsManager->checkLike($_SESSION['userID'], $pictureID);
	$checkLike       = $checkLikeTmp->fetch();

	if (verifyStatus() < 2 || $_SESSION['userID'] < 1) {
		throw new Exception("You need a valid account to like this picture");
	}

	if (!$checkLike) {
		$commentsManager->like($_SESSION['userID'], $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You already liked this picture");
	}
}

function dislike($pictureID)
{
	$commentsManager = new comments();
	$checkLikeTmp    = $commentsManager->checkLike($_SESSION['userID'], $pictureID);
	$checkLike       = $checkLikeTmp->fetch();

	if (verifyStatus() < 2 || $_SESSION['userID'] < 1) {
		throw new Exception("You need a valid account to dislike this picture");
	}

	if ($checkLike) {
		$commentsManager->dislike($_SESSION['userID'], $pictureID);
		header('location: index.php?action=getOne&pictureID=' . $pictureID);
	} else {
		throw new Exception("You already disliked this picture");
	}

}