<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:02
 */

//• Un fichier index.php, contenant le point d’entrée de votre site, et situé à la racine
//de votre arborescence.

//<?php
//require('private/controller/frontend.php');
//
//try {
//    if (isset($_GET['action'])) {
//        if ($_GET['action'] == 'listPosts') {
//            listPosts();
//        } elseif ($_GET['action'] == 'post') {
//            if (isset($_GET['id']) && $_GET['id'] > 0) {
//                post();
//            } else {
//                throw new Exception('Aucun identifiant de billet envoyé');
//            }
//        } elseif ($_GET['action'] == 'addComment') {
//            if (isset($_GET['id']) && $_GET['id'] > 0) {
//                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
//                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
//                } else {
//                    throw new Exception('Tous les champs ne sont pas remplis !');
//                }
//            } else {
//                throw new Exception('Aucun identifiant de billet envoyé');
//            }
//        }
//    } else {
//        listPosts();
//    }
//} catch (Exception $e) {
//    echo 'Erreur : ' . $e->getMessage();
//}

require('private/view/session.php');
require('private/controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
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
            case 'getRecent':
                getRecent();
                break;
            case 'getPopular':
                getPopular();
                break;
            case 'getCapture':
                if ($_SESSION['status'] > 0) {
                    require("private/view/navCapture.php");
                    break;
                } else {
                    throw new Exception("Please, Log in or register to access this page");
                }
            case 'getUpload':
                require("private/view/navUpload.php");
                break;
            case 'getLogin':
                require("private/view/navLogin.php");
                break;
            case 'getRegister':
                require("private/view/navRegister.php");
                break;
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
            default:
                throw new Exception("The page you're trying to access doesn't exist");
        }
    } else {
        getRecent();
    }
} catch (Exception $e) {
    message($e->getMessage());
}