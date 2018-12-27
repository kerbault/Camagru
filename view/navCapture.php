<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 14/11/2018
 * Time: 21:42
 */
ob_start(); ?>

<br>
<div id="capturePage">
    <div id="active">
        <div class="camera">
            <video id="video">Video stream not available.</video>
            <button class="captureButton" id="snap">Take photo</button>
        </div>
        <form action="./index.php?action=uploadThis" method="post" enctype="multipart/form-data">
            <canvas id="canvas">
            </canvas>

            <div class="output">
                <img id="photo" alt="The screen capture will appear in this box.">
                <input class="captureButton" id="save" type="submit" value="Save" name="submit" required>
                <input type="hidden" name="name" value="<?= (round(microtime(true) * 1000) . rand(100, 999)); ?>">
            </div>

            You can upload you own picture :
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" onchange="preview_image(event)" required>
        </form>
    </div>

    <div id="tmp">
        <canvas id="canvas">
        </canvas>

        <div class="output">
            <img id="photo" alt="The screen capture will appear in this box.">
        </div>
    </div>
</div>

<script src="public/js/uploadPreview.js"></script>
<script src="public/js/capture.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
