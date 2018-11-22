<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:02
 */

//• Un fichier index.php, contenant le point d’entrée de votre site, et situé à la racine
//de votre arborescence.

require('controller/frontend.php');

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
            if (!isset($_POST['subject']) || $_POST['subject'] == "")
            {
                sendMail();
            }
            break;
    }
} else {
//  recentPosts();
    require("view/navRecent.php");
}
