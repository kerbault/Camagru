<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 20:26
 */

ob_start(); ?>

    <br>
    <form action="./index.php?action=register" method="post">
        Login :
        <input type="text" name="Login" id="Login" required><br>
        password :
        <input type="password" name="passwd" id="passwd" required><br>
        confirm password :
        <input type="password" name="confirmpasswd" id="confirmpasswd" required><br>
        email :
        <input type="email" name="email" id="email" required>
        <input type="submit" value="Register" name="Register">

    </form>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>