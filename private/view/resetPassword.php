<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 2019-01-30
 * Time: 02:24
 */

ob_start(); ?>

	<br>
	<div class="center">
		<div class="logForm">
			<form style="width: 100%" action="./index.php?action=resetAccount3rd" method="post">
				<p>New Password</p>
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
				<input type="hidden" name="userName" value="<?= $_GET['user'] ?>">
				<input type="hidden" name="verifyKey" value="<?= $_GET['verifyKey'] ?>">
				<input type="submit" class="submit" value="Change Password" name="Change Password">

			</form>
		</div>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>