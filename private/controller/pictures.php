<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:54
 */

function uploadPicture($fileNameBase, $fileToUpload)
{
	ob_get_contents();
	ob_end_clean();

	$allowedSize        = 2000000;
	$allowed_file_types = array('.jpg', '.gif', '.png', '.jpeg');
	$targetDir          = "public/captures/";

	if (isset($fileToUpload['error']) && $fileToUpload['error'] == 0) {
		$picturesManager = new pictures();
		$fileName        = $fileToUpload["name"];
		$fileBasename    = substr($fileName, 0, strripos($fileName, '.'));
		$fileExt         = substr($fileName, strripos($fileName, '.'));
		$fileSize        = $fileToUpload["size"];
		$newFileName     = $fileNameBase . $fileExt;

		if ($fileSize > $allowedSize) {
			throw new Exception("The uploaded file exceeds the allowed limit.");
		} elseif (empty($fileBasename)) {
			throw new Exception("Please select a file to upload.");
		} elseif (!in_array($fileExt, $allowed_file_types)) {
			throw new Exception("Only these file typs are allowed for upload: " .
								implode(', ', $allowed_file_types));
			unlink($fileToUpload["tmp_name"]);
		} elseif (file_exists($targetDir . $newFileName)) {
			throw new Exception("You have already uploaded this file.");
		} else {
			move_uploaded_file($fileToUpload["tmp_name"], $targetDir . $newFileName);
			$picturesManager->uploadPictureDb($newFileName);
			message("File uploaded successfully.");
		}
	} else {
		switch ($fileToUpload['error']) {
			case UPLOAD_ERR_INI_SIZE:
				throw new Exception("The uploaded file exceeds the upload_max_filesize directive in php.ini");
			case UPLOAD_ERR_FORM_SIZE:
				throw new Exception("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form");
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
}

function remPicture($userID, $pictureID)
{
	if (($userID === $_SESSION['userID'] && verifyStatus() > 1) || verifyStatus() > 2) {
		$picturesManager = new pictures();
		$deleted         = $picturesManager->remPicture($pictureID);

		if ($deleted['name'] != "") {
			try {
				unlink('./public/captures/' . $deleted['name']);
				header('location: index.php');
			} catch (Exception $e) {
				throw new Exception("Hahem problem");
			}
		}
	} else {
		throw new Exception('You don\'t have the right to remove this picture');
	}
}