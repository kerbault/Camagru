<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:23
 */

ob_start();

if (isset($recentPopularList)) { ?>
	<br>
	<div class="display">
		<?php
		$postCount = 0;
		Foreach ($recentPopularList as $picture) {
			?>
			<div class="item visually-hidden">
				<a href="index.php?action=getOne&pictureID=<?= $picture['pictureID']; ?>">
					<img class="preview"
						 src="public/captures/<?= $picture['subDir'] . "/" . $picture['name'];
						 ?>"
						 title="<?= $picture['name']; ?>" alt="<?= $picture['name']; ?>"></a>
				<div class="likeNcomment">
					<div class="likeCount">
						<img class="pLike" src="./public/images/star_Filled.png" title="Liked" alt="Liked">
						<p class="nLike"><?= $picture['likeCount'] ?></p>
					</div>
					<div class="commentCount">
						<p class="nComment"><?= $picture['commentCount'] ?></p>
						<img class="pComment" src="./public/images/conversationFilled.png" title="Comments"
							 alt="Comments">
					</div>
				</div>
			</div>
			<?php
			$postCount++;
		} ?>
	</div>
	<button class="submit" id="load-more-posts"
			<?php if ($postCount <= 6) { ?>style="display: none" <?php } ?>>Load More Posts
	</button>
	<?php
	$recentPopularList->closeCursor();
	?>
	<script src="public/js/loadMore.js"></script>
	<?php

} else {
	throw new Exception("Ooops Something went wrong, please try again of contact us for more help");
}

$content = ob_get_clean();

require("template.php"); ?>
