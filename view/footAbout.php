<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 19:31
 */
ob_start();
if (preg_match('/Camagru$/', getcwd())) { ?>

    <h1>About</h1>

    <p>This website has been made by Kerbault as a school project for "Le 101" school, the initial subject is the
        following</p><br>

    <a href="public/other/camagru.fr.pdf" target="_blank">Camagru.fr.pdf</a>

    <?php $content = ob_get_clean(); ?>

    <?php require("template.php");
} else {
    header('Location: ../index.php');
} ?>
