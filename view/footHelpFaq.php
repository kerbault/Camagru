<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:46
 */
ob_start();
if (preg_match('/Camagru$/', getcwd())) { ?>

    <center>
        <h1>Help & Faq</h1>
        <div>
            <h1>Hello Title</h1>

            <p>Hello content</p>
            <p>Hello content</p>
            <p>Hello content</p>
            <p>Hello content</p>
            <p>Hello content</p>
            <p>Hello content</p>
        </div>
        <img src="https://i.imgur.com/Q4tDgE7.gif">
    </center>

    <?php $content = ob_get_clean(); ?>

    <?php require("template.php");
} else {
    header('Location: ../index.php');
} ?>
