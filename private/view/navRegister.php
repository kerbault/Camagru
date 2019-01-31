<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 20:26
 */

ob_start(); ?>

	<br>
	<div class="center">
		<div class="logForm">
			<form style="width: 100%" action="./index.php?action=register" method="post">
				<p>Name</p>
				<input type="text" class="logInput" name="user" id="user" placeholder="ex : PaulAmploi91"
					   pattern="[a-zA-Z0-9]{4,25}"
					   title="Must be alphanumeric and contain more than 3 characters"
					   required>
				<p>Password</p>
				<input type="password" class="logInput" name="passwd" id="passwd"
					   placeholder="ex : NoTh4tEz"
					   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}"
					   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
					   required>
				<p>Confirm Password</p>
				<input type="password" class="logInput" name="confirmpasswd" id="confirmpasswd"
					   placeholder="Same as above"
					   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}"
					   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
					   required>
				<p>Email</p>
				<input type="email" class="logInput" name="email" id="email"
					   placeholder="ex : seriously.dude@mate.wtf"
					   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,255}$"
					   title="This email adress is invalid"
					   required>
				<input type="submit" class="submit" value="Register" name="Register">

			</form>
		</div>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>