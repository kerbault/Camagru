<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 14/11/2018
 * Time: 21:42
 */
ob_start(); ?>

<div class="contentarea">
    <h1>
        MDN - WebRTC: Still photo capture demo
    </h1>
    <p>
        This example demonstrates how to set up a media stream using your built-in webcam, fetch an image from that
        stream, and create a PNG using that image.
    </p>
    <div class="camera">
        <video id="video">Video stream not available.</video>
        <button id="startbutton">Take photo</button>
    </div>
    <canvas id="canvas">
    </canvas>
    <div class="output">
        <img id="photo" alt="The screen capture will appear in this box.">
    </div>
    <p>
        Visit our article <a href="https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/Taking_still_photos">
            Taking still photos with WebRTC</a> to learn more about the technologies used here.
    </p>
</div>
<script src="public/js/capture.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
