<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:45
 */
ob_start(); ?>
<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>