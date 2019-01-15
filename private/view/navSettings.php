<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 06/01/2019
 * Time: 23:25
 */

ob_start();

if (isset($users)) ?>

	<div class="center">
		<h1>Preferences</h1>
		<div class="logForm">
			<form style="width: 100%" action="./index.php?action=register" method="post">
				<div class="settingContent">
					<p>Mail notifications :</p>
					<label class="switch">
						<input type="checkbox">
						<span class="slider round"></span>
					</label>
				</div>
			</form>
		</div>
	</div>
	<div class="center">
		<h1>Password change</h1>
		<div class="logForm">
			<form style="width: 100%" action="./index.php?action=register" method="post">
				<p>Old password</p>
				<input type="password" class="logInput" name="passwd" id="passwd" placeholder="ex : NoTh4tEz"
					   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}"
					   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
					   required>
				<p>New password</p>
				<input type="password" class="logInput" name="passwd" id="passwd" placeholder="ex : NoTh4tEz"
					   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}"
					   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
					   required>
				<p>Confirm new password</p>
				<input type="password" class="logInput" name="confirmpasswd" id="confirmpasswd"
					   placeholder="Same as above"
					   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}"
					   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
					   required>
				<input type="submit" class="submit" value="Save Change" name="saveChange">
			</form>
		</div>
	</div>
<div class="center">
	<h1>Admin</h1>
	<div class="logForm">
		<form style="width: 100%" action="./index.php?action=register" method="post">
			<div class="settingContent">
				<div class="custom-select" style="width:200px;">
					<select>
						<option value="0">Select user:</option>
						<?php
						while ($data = $users->fetch()) {
							?>
							<option value="<?= $data['id'] ?>"><?= $data['login'] ?></option><?php
						} ?>
					</select>
				</div>
				<div class="custom-select" style="width:200px;">
					<select>
						<option value="0">Select role:</option>
						<option value="-1">Blocked</option>
						<option value="1">Not verified</option>
						<option value="2">verified</option>
						<option value="3">Admin</option>
					</select>
				</div>
			</div>
			<input type="submit" class="submit" value="Save Change" name="saveChange">
		</form>
	</div>
</div>

<?php $content = ob_get_clean();

require("template.php"); ?>
