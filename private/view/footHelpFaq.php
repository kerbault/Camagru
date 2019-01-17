<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:46
 */
ob_start(); ?>

<div class="container">
	<video autoplay="true" class="js-stream">

	</video>
</div>
<script src="public/js/capture.js"></script>

<?php $content = ob_get_clean();

require("template.php"); ?>
