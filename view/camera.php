<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 14/11/2018
 * Time: 21:45
 */
ob_start(); ?>
    <video id="video" width="640" height="480" autoplay></video>
    <button id="snap">Snap Photo</button>
    <canvas id="canvas" width="640" height="480"></canvas>
<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>