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
	<h1 id="postTitle"><?= $userName['user'] ?>'s Posts</h1>
	<div class="display">
		<?php
		$postCount = 0;
		while ($userPosts = $userPostsTmp->fetch()) {
			?>
			<div class="item">
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
			$postCount++;
		}
		if ($postCount == 0) {
			?>
			<p>Empty</p>
			<?php
		} ?>
	</div>

	<button class="submit" id="load-more-posts"
			<?php if ($postCount <= 6) { ?>style="display: none" <?php } ?>>Load More Posts
	</button>

	<h1 id="favTitle"><?= $userName['user'] ?>'s Favs</h1>
	<div class="displayFav">
		<?php
		$postCount = 0;
		while ($userFavs = $userFavsTmp->fetch()) {
			?>
			<div class="itemFav">
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
			$postCount++;
		}
		if ($postCount == 0) {
			?>
			<p>Empty</p>
			<?php
		}
		$userFavsTmp->closeCursor();
		?>
	</div>

	<button class="submit" id="load-more-favs"
			<?php if ($postCount <= 6) { ?>style="display: none" <?php } ?>>Load More Favs
	</button>

	<script src="public/js/loadMore.js"></script>
	<script src="public/js/loadMoreFav.js"></script>
<?php
$content = ob_get_clean();

require("template.php"); ?>