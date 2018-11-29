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
//require('controller/frontend.php');
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

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'getAbout':
                require("view/footAbout.php");
                break;
            case 'getContact':
                require("view/footContact.php");
                break;
            case 'getHelp':
                require("view/footHelpFaq.php");
                break;
            case 'getTOS':
                require("view/footTOS.php");
                break;
            case 'getRecent':
                require("view/navRecent.php");
                break;
            case 'getPopular':
                require("view/navPopular.php");
                break;
            case 'getCapture':
                require("view/navCapture.php");
                break;
            case 'getUpload':
                require("view/navUpload.php");
                break;
            case 'getLogin':
                require("view/navLogin.php");
                break;
            case 'getRegister':
                require("view/navRegister.php");
                break;
            case 'getLogout':
                require("view/navRecent.php");
                break;
            case 'contactUs':
                if (isset($_POST['form']) && isset($_POST['content']) && isset($_POST['subject'])) {
                    contactHelp($_POST['from'], $_POST['content'], $_POST['subject']);
                    break;
                } else {
                    throw new Exception('Some field are empty, please check again');
                }
            case 'uploadThis':
                uploadPicture();
                break;
            case 'register':
                register();
                break;
        }
    } else {
        require("view/navRecent.php");
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}