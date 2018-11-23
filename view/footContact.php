<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:45
 */
ob_start(); ?>

<h1>Contact Us</h1>
<p>All field must be verified if you want a response !</p><br>
<form action="index.php?action=contactUs" method="post">
    <div>
        <label for="subject">Subject</label><br>
        <input type="text" id="subject" name="subject" required>
    </div>
    <br>
    <div>
        <label for="content">Message</label><br>
        <textarea id="content" name="content" required></textarea>
    </div>
    <br>
    <div>
        <label for="from">Your email</label><br>
        <input type="email" id="from" name="from" pattern='^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$' required>
    </div>
    <br>
    <div>
        <input type="submit" id="send" value="Send">
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
