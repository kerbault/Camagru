<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 20:38
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