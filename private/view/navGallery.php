<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 20:38
 */

ob_start();
?>
	<br>
	<h1 id="postTitle"><?= $userName['user'] ?>'s Posts</h1>
	<div class="display">
		<?php
		$postCount = 0;
		Foreach ($userPostsList as $userPost) {
			?>
			<div class="item visually-hidden">
				<a href="index.php?action=getOne&pictureID=<?= $userPost['ID']; ?>">
					<img class="preview"
						 src="public/captures/<?= $userPost["subDir"] . "/" . $userPost['name'];
						 ?>"
						 title="<?= $userPost['name']; ?>" alt="<?= $userPost['name']; ?>"></a>
				<div class="likeNcomment">
					<div class="likeCount">
						<img class="pLike" src="./public/images/star_Filled.png" title="Liked" alt="Liked">
						<p class="nLike"><?= $userPost['likeCount'] ?></p>
					</div>
					<div class="commentCount">
						<p class="nComment"><?= $userPost['commentCount'] ?></p>
						<img class="pComment" src="./public/images/conversationFilled.png" title="Comments"
							 alt="Comments">
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
		Foreach ($userFavsList as $userFav) {
			?>
			<div class="itemFav visually-hidden-fav">
				<a href="index.php?action=getOne&pictureID=<?= $userFav['ID']; ?>">
					<img class="preview"
						 src="public/captures/<?= $userFav['subDir'] . "/" . $userFav['name'];
						 ?>"></a>
				<div class="likeNcomment">
					<div class="likeCount">
						<img class="pLike" src="./public/images/star_Filled.png" title="Liked" alt="Liked">
						<p class="nLike"><?= $userFav['likeCount'] ?></p>
					</div>
					<div class="commentCount">
						<p class="nComment"><?= $userFav['commentCount'] ?></p>
						<img class="pComment" src="./public/images/conversationFilled.png" title="Comments"
							 alt="Comments">
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
		$userFavsList->closeCursor();
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