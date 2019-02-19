<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:46
 */
ob_start(); ?>

<h1>How do I take picture ?</h1>
<p>You need to have a camera plugged to your computer or on your phone and go to the <a
			href="index.php?action=getCapture">Capture page</a>, if
	you don't have a camera you can upload a picture of your own.</p>

<h1>Why can't I save picture without layer ?</h1>
<p>The Camagru subject gave us the obligation to save a picture only in case a layer has been selected.</p>

<h1>I can't access to my account, what should I do ?</h1>
<p><a href="index.php?action=getContact">Contact us</a> for further information.</p>

<?php $content = ob_get_clean();

require("template.php"); ?>
