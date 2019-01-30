<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 2019-01-30
 * Time: 01:45
 */

ob_start(); ?>

	<br>
	<div class="center">
		<div class="logForm">
			<form style="width: 100%" action="./index.php?action=resetAccount1st" method="post">
				<p>Enter your email</p>
				<input type="email" class="logInput" name="email" id="email"
					   placeholder="ex : seriously.dude@mate.wtf"
					   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,255}$"
					   title="This email adress is invalid"
					   required>
				<input type="submit" class="submit" value="Send Email" name="Register">

			</form>
		</div>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>