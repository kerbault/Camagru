<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 16/11/2018
 * Time: 20:45
 */
ob_start(); ?>

<h1>Contact Us</h1>
<p>All field must be verified if you want a response !</p><br>
<form action="index.php?action=contactUs" method="post">
	<div>
		<label for="subject">Subject</label><br>
		<input type="text" id="subject" name="subject" placeholder="ex : I can't remove my picture"
			   required>
	</div>
	<br>
	<div>
		<label for="content">Message</label><br>
		<textarea id="content" name="content" placeholder="ex : Hello, my user name is AwsomeName and I	cannot remove the following picture :

<insert link here>

please can you fix that ?"
				  required></textarea>
	</div>
	<br>
	<div>
		<label for="from">Your email</label><br>
		<input type="email" id="from" name="from"
			   pattern='^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$'
			   placeholder="ex : seriously.dude@mate.wtf" required>
	</div>
	<br>
	<div>
		<input class="submit" type="submit" id="send" value="Send">
	</div>
</form>

<?php $content = ob_get_clean();

require("template.php"); ?>
