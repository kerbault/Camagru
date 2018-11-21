<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:46
 */
ob_start(); ?>

    <center><h1>🌟RTFM🌟</h1></center>

<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>