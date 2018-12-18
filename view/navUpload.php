<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 20:40
 */

ob_start(); ?>

    <br>
    <form action="./index.php?action=uploadThis" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>