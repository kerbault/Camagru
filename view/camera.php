<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 14/11/2018
 * Time: 21:45
 */
ob_start(); ?>

    <script src="../public/js/camagru.js"></script>
    <video id="video"></video>
    <button id="startbutton">Prendre une photo</button>
    <canvas id="canvas"></canvas>
    <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>