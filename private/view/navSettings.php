<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 06/01/2019
 * Time: 23:25
 */

ob_start(); ?>

<br>
<div class="center">
    <div class="logForm">
        <form style="width: 100%" action="./index.php?action=login" method="post">
            <p>Name</p>
            <input type="text" class="logInput" name="user" id="user"
                   pattern="[a-zA-Z0-9]{4,50}"
                   title="Must be alphanumeric and contain more than 3 characters"
                   required>
            <p>Password</p>
            <input type="password" class="logInput" name="passwd" id="passwd"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}"
                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                   required>
            <a href="public/other/camagru.fr.pdf"><p style="text-align: right">Forgot account?</p></a>
            <input type="submit" class="logSubmit" value="Login" name="Login">
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
