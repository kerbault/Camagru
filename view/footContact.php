<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:45
 */
ob_start(); ?>

<h1>Contact Us</h1>
<div>
    <p>All field must be verified if you want a response !</p><br>
    <form action="index.php?action=contactUs" method="post">
        <div>
            <label for="subject">Subject</label><br>
            <input type="text" id="subject" name="subject">
        </div><br>
        <div>
            <label for="content">Message</label><br>
            <textarea id="content" name="content"></textarea>
        </div><br>
        <div>
            <label for="from">Your email</label><br>
            <input type="text" id="from" name="from">
        </div><br>
        <div>
            <input type="submit" name="Send">
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
