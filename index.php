<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:02
 */

//• Un fichier index.php, contenant le point d’entrée de votre site, et situé à la racine
//de votre arborescence.
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getAbout':
            getAbout();
            break;
        case 'getContact':
            getContact();
            break;
        case 'getHelp':
            require("view/helpFaq.php");
            break;
        case 'getTOS':
            require("view/TOS.php");
            break;
        case 'getRecent':
            getRecent();
            break;
        case 'getPopular':
            getPopular();
            break;
        case 'getCapture':
            require("view/camera.php");
            break;
        case 'getUpload':
            getUpload();
            break;
        case 'getLogin':
            getLogin();
            break;
        case 'getRegister':
            getRegister();
            break;
        case 'getLogout':
            getLogout();
            break;
    }
} else {
//  recentPosts();
    require("view/camera.php");
}
