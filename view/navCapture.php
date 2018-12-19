<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 14/11/2018
 * Time: 21:42
 */
ob_start(); ?>

<div class="camera">
    <video id="video">Video stream not available.</video>
    <button class="captureButton" id="snap">Take photo</button>
</div>

<canvas id="canvas">
</canvas>

<div class="output">
    <img id="photo" alt="The screen capture will appear in this box.">
    <button class="captureButton" id="save">Save</button>
</div>
<script src="public/js/capture.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
