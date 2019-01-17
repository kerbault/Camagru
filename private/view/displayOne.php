<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 10/01/2019
 * Time: 15:06
 */

ob_start();

if (isset($picture) && isset($commentsTmp) && isset($liked)) {
	?>

	<br>
	<div class="center">
		<!-----------------------------------------Picture-Section------------------------------------------------------------->
		<div class="focusCard">

			<img class="focusPicture" src="public/captures/<?= $picture['name']; ?>">
			<div class="likeNcomment">
				<div class="likeCount">
					<?php if ($liked) { ?>
						<form action="./index.php?action=dislike" method="post">
							<input type="hidden" name="pictureId" value="<?= $picture['id'] ?>">
							<button class="likeButton"><img class="pLike" src="./public/images/star_Filled.png">
							</button>
						</form>
					<?php } else { ?>
						<form action="./index.php?action=like" method="post">
							<input type="hidden" name="pictureId" value="<?= $picture['id'] ?>">
							<button class="likeButton"><img class="pLike" src="./public/images/star_Empty.png">
							</button>
						</form>
					<?php } ?>
					<p class="nLike"><?= $picture['likeCount'] ?></p>
				</div>
				<div class="commentCount">
					<p class="nComment"><?= $picture['commentCount'] ?></p>
					<img class="pComment" src="./public/images/conversationFilled.png">
				</div>
			</div>

			<div class="postDateFocus">
				<p class="date">the <?= $picture['formatDate'] ?></p>
			</div>

			<div class="removeNBy">

				<?php if ($_SESSION['id'] === $picture['userID'] || verifyStatus() > 2) { ?>
					<form action="./index.php?action=remPicture" method="post">
					<input type="hidden" name="userId" value="<?= $picture['userID'] ?>">
					<input type="hidden" name="pictureId" value="<?= $picture['id'] ?>">
					<button onclick="return confirm('Are you sure to remove this picture and all the comments associated ?');">
						Remove
					</button>
					</form><?php
				} ?>
				<p style="margin-left: auto">by <?= $picture['likeCount'] ?></p>
			</div>
		</div>
		<!-----------------------------------------Comments-Section------------------------------------------------------------>
		<?php
		while ($comments = $commentsTmp->fetch()) {
			?>
			<div class="commentCard">
				<div>
					<p class="date">the <?= $comments['formatDate'] ?></p>
				</div>
				<br>
				<div>
					<p style="text-align: left"> <?= htmlspecialchars($comments['content']) ?></p>
				</div>
				<br>
				<div class="removeNBy">
					<?php if ($_SESSION['user'] === $comments['user'] || verifyStatus() > 2) { ?>
						<form action="./index.php?action=remComment" method="post">
						<input type="hidden" name="user" value="<?= $comments['user'] ?>">
						<input type="hidden" name="commentId" value="<?= $comments['id'] ?>">
						<input type="hidden" name="pictureId" value="<?= $picture['id'] ?>">
						<button onclick="return confirm('Are you sure to remove this comment ?');">
							Remove
						</button>
						</form><?php
					} ?>
					<p style="margin-left: auto">by <?= $comments['user'] ?></p>
				</div>
			</div>
			<?php
		}
		$commentsTmp->closeCursor();
		?>
		<!-----------------------------------------Post-Comment---------------------------------------------------------------->
		<?php if (verifyStatus() > 1) { ?>
			<div class="focusCard">
				<form action="index.php?action=addComment" method="post">
					<div>
						<label for="content">Comment</label><br>
						<textarea id="comment" name="content" maxlength="500" required></textarea>
					</div>
					<div>
						<input type="hidden" name="id" value=<?= $picture['id'] ?>>
						<input class="submit" type="submit" id="send" value="Post">
					</div>
				</form>
			</div>
		<?php } ?>
	</div>
	<?php

} else {
	throw new Exception("Ooops Something went wrong, please try again of contact us for more help");
}

$content = ob_get_clean();

require("template.php"); ?>
