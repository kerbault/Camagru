<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 20:38
 */

ob_start();

//if (isset($userPostsTmp) && isset($userFavsTmp)) { ?>
	<br>
	<h1>Posted</h1>
	<div class="display">
		<?php
		while ($userPosts = $userPostsTmp->fetch()) {
			?>
			<div class="card">
				<a href="index.php?action=getOne&pictureID=<?= $userPosts['ID']; ?>">
					<img class="preview" src="public/captures/<?= $userPosts['name']; ?>"></a>
				<div class="likeNcomment">
					<div class="likeCount">
						<img class="pLike" src="./public/images/star_Filled.png">
						<p class="nLike"><?= $userPosts['likeCount'] ?></p>
					</div>
					<div class="commentCount">
						<p class="nComment"><?= $userPosts['commentCount'] ?></p>
						<img class="pComment" src="./public/images/conversationFilled.png">
					</div>
				</div>
			</div>
			<?php
		}
		$userPostsTmp->closeCursor();
		?>
	</div>

	<h1>Faved</h1>
	<div class="display">
		<?php
		while ($userFavs = $userFavsTmp->fetch()) {
			?>
			<div class="card">
				<a href="index.php?action=getOne&pictureID=<?= $userFavs['ID']; ?>">
					<img class="preview" src="public/captures/<?= $userFavs['name']; ?>"></a>
				<div class="likeNcomment">
					<div class="likeCount">
						<img class="pLike" src="./public/images/star_Filled.png">
						<p class="nLike"><?= $userFavs['likeCount'] ?></p>
					</div>
					<div class="commentCount">
						<p class="nComment"><?= $userFavs['commentCount'] ?></p>
						<img class="pComment" src="./public/images/conversationFilled.png">
					</div>
				</div>
			</div>
			<?php
		}
		$userFavsTmp->closeCursor();
		?>
	</div>

<?php

//} else {
//	throw new Exception("Ooops Something went wrong, please try again of contact us for more help");
//}

$content = ob_get_clean(); ?>

<?php require("template.php"); ?>