<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:54
 */

function uploadPicture($fileNameBase, $fileToUpload, $layerName)
{
	ob_get_contents();
	ob_end_clean();


	if ($layerName == "None") {
		throw new Exception("You need to select a layer to make it happen");
	}

	$usersManager = new users();
	$user         = $usersManager->getUserByID($_SESSION['userID']);
	$user         = $user->fetch();

	$allowedSize        = 2000000;
	$allowed_file_types = array('.jpg', '.png', '.jpeg');
	$targetSubDir       = $user['ID'] . "_" . $user['user'];
	$targetDir          = "public/captures/" . $targetSubDir . "/";

	if (isset($fileToUpload['error']) && $fileToUpload['error'] == 0) {
		$picturesManager  = new pictures();
		$fileName         = $fileToUpload["name"];
		$fileBasename     = substr($fileName, 0, strripos($fileName, '.'));
		$fileExt          = substr($fileName, strripos($fileName, '.'));
		$sourceProperties = getimagesize($fileToUpload["tmp_name"]);
		$fileSize         = $fileToUpload["size"];
		$newFileName      = $fileNameBase . ".png";

		if ($fileSize > $allowedSize) {
			throw new Exception("The uploaded file exceeds the allowed limit.");
		} elseif ($fileBasename === NULL) {
			throw new Exception("Please select a file to upload.");
		} elseif (!in_array($fileExt, $allowed_file_types)) {
			throw new Exception("Only these file typs are allowed for upload: " .
								implode(', ', $allowed_file_types));
			unlink($fileToUpload["tmp_name"]);
		} elseif (file_exists($targetDir . $newFileName)) {
			throw new Exception("You have already uploaded this file.");
		} else {
			if (!file_exists('public/captures/' . $targetSubDir)) {
				mkdir('public/captures/' . $targetSubDir);
			}
			switch ($fileExt) {
				case ".png":
					$imageResourceId = imagecreatefrompng($fileToUpload["tmp_name"]);
					$resizedPicture  = imageResize($imageResourceId, $sourceProperties[0],
												   $sourceProperties[1]);
					if ($layerName == 'GreyScale') {
						imagefilter($resizedPicture, IMG_FILTER_GRAYSCALE);
						imagepng($resizedPicture, $targetDir . $newFileName);
					} else {
						mergePictures($resizedPicture, $layerName, $targetDir . $newFileName);
					}
					break;

				case ".jpeg":
					$imageResourceId = imagecreatefromjpeg($fileToUpload["tmp_name"]);
					$resizedPicture  = imageResize($imageResourceId, $sourceProperties[0],
												   $sourceProperties[1]);
					if ($layerName == 'GreyScale') {
						imagefilter($resizedPicture, IMG_FILTER_GRAYSCALE);
						imagepng($resizedPicture, $targetDir . $newFileName);
					} else {
						mergePictures($resizedPicture, $layerName, $targetDir . $newFileName);
					}
					break;

				case ".jpg":
					$imageResourceId = imagecreatefromjpeg($fileToUpload["tmp_name"]);
					$resizedPicture  = imageResize($imageResourceId, $sourceProperties[0],
												   $sourceProperties[1]);
					if ($layerName == 'GreyScale') {
						imagefilter($resizedPicture, IMG_FILTER_GRAYSCALE);
						imagepng($resizedPicture, $targetDir . $newFileName);
					} else {
						mergePictures($resizedPicture, $layerName, $targetDir . $newFileName);
					}
					break;

				default:
					echo "Invalid Image type.";
					exit;
					break;
			}
			$picturesManager->uploadPictureDb($newFileName, $targetSubDir);
			header('location: index.php?action=getUpload');

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

function imageResize($imageResourceId, $width, $height)
{
	$targetWidth  = 600;
	$targetHeight = 450;

	$src_ratio = $width / $height;
	if ($targetWidth / $targetHeight > $src_ratio) {
		$new_h = $targetWidth / $src_ratio;
		$new_w = $targetWidth;
	} else {
		$new_w = $targetHeight * $src_ratio;
		$new_h = $targetHeight;
	}
	$x_mid = $new_w / 2;
	$y_mid = $new_h / 2;

	$resizedPicture = imagecreatetruecolor($targetWidth, $targetHeight);

	imagesavealpha($resizedPicture, true);
	$trans_background = imagecolorallocatealpha($resizedPicture, 0, 0, 0, 127);
	imagefill($resizedPicture, 0, 0, $trans_background);

	$newpic = imagecreatetruecolor(round($new_w), round($new_h));
	imagecopyresampled($newpic, $imageResourceId, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
	$resizedPicture = imagecreatetruecolor($targetWidth, $targetHeight);
	imagecopyresampled($resizedPicture, $newpic, 0, 0, ($x_mid - ($targetWidth / 2)),
		($y_mid - ($targetHeight / 2)), $targetWidth, $targetHeight, $targetWidth, $targetHeight);
	return $resizedPicture;
}

function remPicture($userID, $pictureID)
{
	if (($userID === $_SESSION['userID'] && verifyStatus() > 1) || verifyStatus() > 2) {
		$picturesManager = new pictures();
		$deleted         = $picturesManager->remPicture($pictureID);

		if ($deleted['name'] != "") {
			try {
				unlink('./public/captures/' . $deleted['subDir'] . "/" . $deleted['name']);
				header('location: index.php');
			} catch (Exception $e) {
				throw new Exception("Hahem problem");
			}
		}
	} else {
		throw new Exception('You don\'t have the right to remove this picture');
	}
}

function mergePictures($base, $layerName, $destName)
{
	define("WIDTH", 600);
	define("HEIGHT", 450);

	$dest_image = imagecreatetruecolor(WIDTH, HEIGHT);
	imagesavealpha($dest_image, true);
	$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
	imagefill($dest_image, 0, 0, $trans_background);
	$layer = imagecreatefrompng('public/images/layers/' . $layerName . '.png');

	imagecopy($dest_image, $base, 0, 0, 0, 0, WIDTH, HEIGHT);
	imagecopy($dest_image, $layer, 0, 0, 0, 0, WIDTH, HEIGHT);

	imagepng($dest_image, $destName);

	imagedestroy($base);
	imagedestroy($layer);
	imagedestroy($dest_image);
}