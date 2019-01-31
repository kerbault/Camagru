<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:02
 */

//• Un fichier index.php, contenant le point d’entrée de votre site, et situé à la racine
//de votre arborescence.

require_once('private/view/session.php');

require_once('private/controller/comments.php');
require_once('private/controller/galleries.php');
require_once('private/controller/likes.php');
require_once('private/controller/misc.php');
require_once('private/controller/pictures.php');
require_once('private/controller/users.php');

require_once('private/model/CommentsManager.php');
require_once('private/model/GalleriesManager.php');
require_once('private/model/Manager.php');
require_once('private/model/likesManager.php');
require_once('private/model/PicturesManager.php');
require_once('private/model/UsersManager.php');


try {
	require_once('private/config/setup.php');

	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
//-----------------------------------------display-section-----------------------------------------------//
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
				if (isset($_GET['pictureID'])) {
					getOne($_GET['pictureID']);
				} else {
					throw new Exception('Some field are empty in getOne, please check');
				}
				break;
			case 'getRecent':
				getRecent();
				break;
			case 'getPopular':
				getPopular();
				break;
			case 'getCapture':
				require("private/view/navCapture.php");
				break;
			case 'getLogin':
				require("private/view/navLogin.php");
				break;
			case 'getRegister':
				require("private/view/navRegister.php");
				break;
			case 'getMyGallery':
				if (isset($_GET['userID'])) {
					getGallery($_GET['userID']);
				} else {
					throw new Exception('Some field are empty in getMyGallery, please check');
				}
				break;
			case 'getGallery':
				if (isset($_GET['userID'])) {
					getGallery($_GET['userID']);
				} else {
					throw new Exception('Some field are empty in getGallery, please check');
				}
				break;
			case 'getSettings':
				getSettings();
				break;
			case 'forgetLogin':
				require("private/view/forgetLogin.php");
				break;

//-----------------------------------------actions-section-----------------------------------------------//
			case 'getLogout':
				logout();
				break;
			case 'contactUs':
				if (isset($_POST['subject']) && isset($_POST['content']) && isset($_POST['from'])) {
					contactHelp($_POST['subject'], $_POST['content'], $_POST['from']);
					break;
				} else {
					throw new Exception('Some field are empty in contactUs, please check');
				}
			case 'register':
				register();
				break;
			case 'login':
				if (isset($_POST['user']) && isset($_POST['passwd'])) {
					login($_POST['user'], $_POST['passwd']);
					break;
				} else {
					throw new Exception('Some field are empty in contactUs, please check');
				}
			case 'verify':
				if (isset($_GET['user']) && isset($_GET['verifyKey'])) {
					verifyAccount(htmlspecialchars($_GET['user']), htmlspecialchars($_GET['verifyKey']));
					break;
				} else {
					throw new Exception('Some field are empty in verify, please check');
				}
			case 'changeStatus':
				if (isset($_POST['userID']) && isset($_POST['newStatus'])) {
					changeStatus($_POST['userID'], $_POST['newStatus']);
					break;
				} else {
					throw new Exception('Some field are empty in changeStatus, please check');
				}
			case 'changePasswd':
				if (isset($_POST['oldPasswd']) && isset($_POST['newPasswd']) &&
					isset($_POST['confirmpasswd'])) {
					changePassword($_POST['oldPasswd'], $_POST['newPasswd'], $_POST['confirmpasswd']);
					break;
				} else {
					throw new Exception('Fuck you');

				}
			case 'changeNotif':
				if (isset($_SESSION['userID']) && isset($_POST['notifStatus'])) {
					changeNotif($_SESSION['userID'], $_POST['notifStatus']);
					break;
				} else if (isset($_SESSION['userID'])) {
					changeNotif($_SESSION['userID'], 0);
					break;
				} else {
					throw new Exception('Some field are empty in changeNotif, please check');
				}
			case 'resetAccount1st':
				if (isset($_POST['email'])) {
					forgetLogin($_POST['email']);
					break;
				} else {
					throw new Exception('Some field are empty in resetAccount1st, please check');
				}
			case 'resetAccount2nd':
				if (isset($_GET['user']) && isset($_GET['verifyKey'])) {
					Require("private/view/resetPassword.php");
					break;
				} else {
					throw new Exception('Some field are empty in resetAccount2nd, please check');
				}
			case 'resetAccount3rd':
				if (isset($_POST['passwd']) && isset($_POST['confirmpasswd']) &&
					isset($_POST['userName']) && isset($_POST['verifyKey'])) {

					resetPassword($_POST['userName'], $_POST['verifyKey'], $_POST['passwd'],
								  $_POST['confirmpasswd']);
					break;
				} else {
					throw new Exception('Some field are empty in resetAccount3rd, please check');
				}
			case 'uploadThis':
				if (isset($_POST['name']) && isset($_FILES['fileToUpload'])) {
					uploadPicture($_POST['name'], $_FILES['fileToUpload']);
					break;
				} else {
					throw new Exception("Some field are empty in uploadThis, please check");
				}
			case 'remPicture':
				if (isset($_POST['userID']) && isset($_POST['pictureID'])) {
					remPicture($_POST['userID'], $_POST['pictureID']);
					break;
				} else {
					throw new Exception("Some field are empty in remPicture, please check");
				}
			case 'addComment':
				if (isset($_POST['content']) && isset($_POST['ID']) && isset($_POST['userID'])) {
					addComment($_POST['content'], $_POST['ID'], $_POST['userID']);
					break;
				} else {
					throw new Exception('Some field are empty in addComment, please check');
				}
			case 'remComment':
				if (isset($_POST['userID']) && isset($_POST['commentID']) && isset($_POST['pictureID'])) {
					remComment($_POST['userID'], $_POST['commentID'], $_POST['pictureID']);
					break;
				} else {
					throw new Exception('Some field test are empty, please check again');
				}
			case 'like':
				if (isset($_POST['pictureID'])) {
					like($_POST['pictureID']);
					break;
				} else {
					throw new Exception('Some field are empty in like, please check');
				}
			case 'dislike':
				if (isset($_POST['pictureID'])) {
					dislike($_POST['pictureID']);
					break;
				} else {
					throw new Exception('Some field are empty in dislike, please check');
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