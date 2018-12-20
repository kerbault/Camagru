<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 20/12/2018
 * Time: 18:22
 */

ob_start(); ?>

    <p><?php echo $_POST['message']?></p>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>