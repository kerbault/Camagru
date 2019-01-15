<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:02
 */

//• Un fichier index.php, contenant le point d’entrée de votre site, et situé à la racine
//de votre arborescence.

require('private/view/session.php');
require('private/controller/frontend.php');

try {
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
//--------------------------------------------------display-section---------------------------------------------------//
			case 'getAbout':
				require("private/view/footAbout.php");
				break;
			case 'getContact':
				require("private/view/footContact.php");
				break;
			case 'getHelp':
				require("private/view/footHelpFaq.php");
				break;
			case 'getTOS':
				require("private/view/footTOS.php");
				break;
			case 'getOne':
				if (isset($_GET['id'])) {
					getOne($_GET['id']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again');
				}
			case 'getRecent':
				getRecent();
				break;
			case 'getPopular':
				getPopular();
				break;
			case 'getCapture':
				require("private/view/navCapture.php");
				break;
			case 'getUpload':
				require("private/view/navUpload.php");
				break;
			case 'getLogin':
				require("private/view/navLogin.php");
				break;
			case 'getRegister':
				require("private/view/navRegister.php");
				break;
			case 'getGallery':
				getGallery();
				break;
			case 'getSettings':
				getSettings();
				break;
//--------------------------------------------------actions-section---------------------------------------------------//
			case 'getLogout':
				logout();
				break;
			case 'contactUs':
				if (isset($_POST['from']) && isset($_POST['content']) && isset($_POST['subject'])) {
					contactHelp($_POST['from'], $_POST['content'], $_POST['subject']);
				} else {
					throw new Exception('Some field are empty, please check again');
				}
				break;
			case 'uploadThis':
				uploadPicture();
				break;
			case 'register':
				register();
				break;
			case 'login':
				login();
				break;
			case 'verify':
				if (isset($_GET['verifyId'])) {
					verifyAccount($_GET['verifyId']);
				} else {
					throw new Exception('Some field are empty, please check again');
				}
				break;
			case 'remPicture':
				if (isset($_POST['userId']) && isset($_POST['pictureId'])) {
					remPicture($_POST['userId'], $_POST['pictureId']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again');
				}
			case 'addComment':
				if (isset($_POST['content']) && isset($_POST['id'])) {
					addComment($_POST['content'], $_POST['id']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again');
				}
			case 'remComment':
				if (isset($_POST['user']) && isset($_POST['commentId']) && isset($_POST['pictureId'])) {
					remComment($_POST['commentId'], $_POST['user'], $_POST['pictureId']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again');
				}
			case 'like':
				if (isset($_POST['pictureId'])) {
					like($_POST['pictureId']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again');
				}
			case 'dislike':
				if (isset($_POST['pictureId'])) {
					dislike($_POST['pictureId']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again');
				}
			default:
				throw new Exception("The page you're trying to access doesn't exist");
		}
	} else {
		getRecent();
	}
} catch (Exception $e) {
	message($e->getMessage());
}