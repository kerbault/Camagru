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

require_once('private/model/UploadManager.php');
require_once('private/model/UsersManager.php');
require_once('private/model/DisplayManager.php');
require_once('private/model/CommentManager.php');

require_once('private/controller/mailing.php');
require_once('private/controller/galleries.php');
require_once('private/controller/pictures.php');
require_once('private/controller/users.php');
require_once('private/controller/misc.php');

try {
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
					throw new Exception('Some field are empty, please check again1');
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
				if (isset($_GET['userID'])) {
					getGallery($_GET['userID']);
				} else {
					throw new Exception('Some field are empty, please check again1');
				}
				break;
			case 'getSettings':
				getSettings();
				break;
//-----------------------------------------actions-section-----------------------------------------------//
			case 'getLogout':
				logout();
				break;
			case 'contactUs':
				contactHelp();
				break;
			case 'uploadThis':
				uploadPicture();
				break;
			case 'register':
				register();
				break;
			case 'login':
				if (isset($_POST['user']) && isset($_POST['passwd'])) {
					login(htmlspecialchars($_POST['user']), htmlspecialchars($_POST['passwd']));
					break;
				} else {
					throw new Exception('Some field are empty, please check again7');
				}
			case 'verify':
				if (isset($_GET['user']) && isset($_GET['verifyKey'])) {
					verifyAccount(htmlspecialchars($_GET['user']), htmlspecialchars($_GET['verifyKey']));
					break;
				} else {
					throw new Exception('Some field are empty, please check again7');
				}
			case 'changeStatus':
				if (isset($_POST['userID']) && isset($_POST['newStatus'])) {
					changeStatus($_POST['userID'], $_POST['newStatus']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again7');
				}
			case 'changePasswd':
				changePassword();
				break;
			case 'changeNotif':
				if (isset($_SESSION['userID']) && isset($_POST['notifStatus'])) {
					changeNotif($_SESSION['userID'], $_POST['notifStatus']);
					break;
				} else if (isset($_SESSION['userID'])) {
					changeNotif($_SESSION['userID'], 0);
					break;
				} else {
					throw new Exception('Some field are empty, please check again6');
				}
			case 'remPicture':
				remPicture();
				break;
			case 'addComment':
				addComment();
				break;
			case 'remComment':
				remComment();
				break;
			case 'like':
				if (isset($_POST['pictureID'])) {
					like($_POST['pictureID']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again6');
				}
			case 'dislike':
				if (isset($_POST['pictureID'])) {
					dislike($_POST['pictureID']);
					break;
				} else {
					throw new Exception('Some field are empty, please check again7');
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