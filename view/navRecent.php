<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:23
 */

ob_start(); ?>

<center>
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

<?php require("template.php"); ?>
