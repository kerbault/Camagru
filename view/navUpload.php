<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 20:40
 */

ob_start(); ?>

    <form action="./view/upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>