<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 06/01/2019
 * Time: 23:25
 */

ob_start();

if (isset($users) && verifyStatus() > 1) ?>

<div class="center">
	<h1>Preferences</h1>
	<div class="logForm">
		<form style="width: 100%" action="./index.php?action=changeNotif" method="post">
			<div class="settingContent">
				<p>Mail notifications :</p>
				<label class="switch">
					<input type="checkbox"<?php
					while ($data = $users->fetch()) {
						if ($data['ID'] === $_SESSION['userID']) {
							if ($data['notification'] == 1) {
								?>
								checked="checked"
								<?php
							}
						}
					}
					$users->closeCursor();
					?> value="1" name="notifStatus">
					<span class="slider round"></span>
				</label>
			</div>
			<input type="submit" class="submit" value="Save Change" name="saveChange">
		</form>
	</div>
</div>
<div class="center">
	<h1>Password change</h1>
	<div class="logForm">
		<form style="width: 100%" action="./index.php?action=changePasswd" method="post">
			<p>Old password</p>
			<input type="password" class="logInput" name="oldPasswd" id="oldPasswd"
				   placeholder="ex : NoTh4tEz"
				   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}"
				   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
				   required>
			<p>New password</p>
			<input type="password" class="logInput" name="newPasswd" id="newPasswd"
				   placeholder="ex : NoTh4tEz"
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
<?php if (verifyStatus() > 2) { ?>
	<div class="center">
		<h1>Admin</h1>
		<div class="logForm">
			<form style="width: 100%" action="./index.php?action=changeStatus" method="post">
				<p>Change users' status</p>
				<div class="settingContent">
					<div class="custom-select">
						<select name="userID">
							<option value="0">Select user:</option>
							<?php
							$users->execute();
							while ($data = $users->fetch()) {
								?>
								<option value="<?= $data['ID'] ?>"><?= $data['ID'] . " " . $data['user']
								?></option><?php
							}
							$users->closeCursor();
							?>
						</select>
					</div>
					<div class="custom-select">
						<select name="newStatus">
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
	<?php
}

$content = ob_get_clean();

require("template.php"); ?>
