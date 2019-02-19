<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 10/01/2019
 * Time: 15:06
 */

ob_start();

if (isset($picture) && isset($commentsList) && isset($liked)) {
	?>

	<br>
	<div class="center">
		<!--------------------Picture-Section------------------------------------------------------------->
		<div class="focusCard">

			<img class="focusPicture"
				 src="public/captures/<?= $picture["subDir"] . "/" . $picture['name']; ?>"
				 title="<?= $picture['name']; ?>"
				 alt="<?= $picture['subDir'] . "/" . $picture['name']; ?>">
			<div class="likeNcomment">
				<div class="likeCount">
					<?php if ($liked) { ?>
						<form action="./index.php?action=dislike" method="post">
							<input type="hidden" name="pictureID" value="<?= $picture['ID'] ?>">
							<button class="likeButton"><img class="pLike"
															src="./public/images/star_Filled.png"
															title="Liked"
															alt="Liked">

							</button>
						</form>
					<?php } else { ?>
						<form action="./index.php?action=like" method="post">
							<input type="hidden" name="pictureID" value="<?= $picture['ID'] ?>">
							<button class="likeButton"><img class="pLike"
															src="./public/images/star_Empty.png"
															title="Not liked"
															alt="Not liked">
							</button>
						</form>
					<?php } ?>
					<p class="nLike"><?= $picture['likeCount'] ?></p>
				</div>
				<div class="commentCount">
					<p class="nComment"><?= $picture['commentCount'] ?></p>
					<img class="pComment" src="./public/images/conversationFilled.png" title="Comments"
						 alt="Comments">
				</div>
			</div>

			<div class="postDateFocus">
				<p class="date">the <?= $picture['formatDate'] ?></p>
			</div>

			<div class="removeNBy">

				<?php if ($_SESSION['userID'] === $picture['userID'] || verifyStatus() > 2) { ?>
					<form action="./index.php?action=remPicture" method="post">
					<input type="hidden" name="userID" value="<?= $picture['userID'] ?>">
					<input type="hidden" name="pictureID" value="<?= $picture['ID'] ?>">
					<button onclick="return confirm('Are you sure to remove this picture and all the comments associated ?');">
						Remove
					</button>
					</form><?php
				} ?>
				<div class="byDiv">
					<p>by&nbsp;</p>
					<a href="index.php?action=getGallery&userID=<?= $picture['userID'] ?>"> <?=
						$picture['user'] ?></a>
				</div>
			</div>
		</div>
		<!--------------------Comments-Section------------------------------------------------------------>
		<?php
		foreach ($commentsList as $comment) {
			?>
			<div class="commentCard">
				<div>
					<p class="date">the <?= $comment['formatDate'] ?></p>
				</div>
				<br>
				<div>
					<p style="text-align: left"> <?= htmlspecialchars($comment['content']) ?></p>
				</div>
				<br>
				<div class="removeNBy">
					<?php if ($_SESSION['userID'] === $comment['userID'] || verifyStatus() > 2) { ?>
						<form action="./index.php?action=remComment" method="post">
						<input type="hidden" name="userID" value="<?= $comment['userID'] ?>">
						<input type="hidden" name="commentID" value="<?= $comment['ID'] ?>">
						<input type="hidden" name="pictureID" value="<?= $picture['ID'] ?>">
						<button onclick="return confirm('Are you sure to remove this comment ?');">
							Remove
						</button>
						</form><?php
					} ?>
					<div class="byDiv">
						<p>by&nbsp;</p>
						<a href="index.php?action=getGallery&userID=<?= $comment['userID'] ?>"> <?=
							$comment['user'] ?></a>
					</div>
				</div>
			</div>
			<?php
		}
		$commentsList->closeCursor();
		?>
		<!--------------------Post-Comment---------------------------------------------------------------->
		<?php if (verifyStatus() > 1) { ?>
			<div class="focusCard">
				<form action="index.php?action=addComment" method="post">
					<div>
						<label for="content">Comment</label><br>
						<textarea id="comment" name="content" maxlength="500" required></textarea>
					</div>
					<div>
						<input type="hidden" name="ID" value=<?= $picture['ID'] ?>>
						<input type="hidden" name="userID" value="<?= $picture['userID'] ?>">
						<input class="submit" type="submit" value="Post">
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
