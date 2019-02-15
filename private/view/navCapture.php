<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 14/11/2018
 * Time: 21:42
 */
ob_start();

if (verifyStatus() > 1) {
	?>

	<br>

	<div id="active">
		<div id="captureUploadLinks">
			<a href="index.php?action=getCapture" style="align-items: center">Capture</a>
			<p style="margin: 0px 5px">|</p>
			<a href="index.php?action=getUpload" style="align-items: center">Upload</a>
		</div>
		<div class="camera">

			<div class="captureFrame">
				<video autoplay="true" id="video">Video stream not available.</video>
				<img id="CrownLayer" src="./public/images/layers/Crown.png">
				<img id="MustacheLayer" src="./public/images/layers/Mustache.png">
				<img id="RaybanLayer" src="./public/images/layers/Rayban.png">
				<img id="SunglassesLayer" src="./public/images/layers/Sunglasses.png">
				<img id="TrollLayer" src="./public/images/layers/Troll.png">
			</div>
			<button class="captureButton" id="snap" onclick="takePicture();">Take photo</button>
		</div>
		<div class="camera">
			<canvas id="canvas"></canvas>
			<div class="output">
				<div class="captureFrame">
					<img src="./public/images/you_photo_here.png" id="photo" title="your picture"
						 alt="The screen capture will appear in this box.">
					<img id="CrownLayerBis" src="./public/images/layers/Crown.png">
					<img id="MustacheLayerBis" src="./public/images/layers/Mustache.png">
					<img id="RaybanLayerBis" src="./public/images/layers/Rayban.png">
					<img id="SunglassesLayerBis" src="./public/images/layers/Sunglasses.png">
					<img id="TrollLayerBis" src="./public/images/layers/Troll.png">
				</div>
				<input class="captureButton" id="sendMontage" type="submit" value="Save" name="submit"
					   required onclick="sendMontage();">
			</div>
			<div id="layersList">
				<label>
					<input type="radio" id="None" name="layer" value="None" onclick="showNone();"
						   checked>
					<img class="layersIcon" src="./public/images/layers/None.png">
				</label>
				<label>
					<input type="radio" id="Crown" name="layer" value="Crown" onclick="showCrown();">
					<img class="layersIcon" src="./public/images/layers/Crownpreview.png">
				</label>
				<label>
					<input type="radio" id="Mustache" name="layer" value="Mustache"
						   onclick="showMustache();">
					<img class="layersIcon" src="./public/images/layers/Mustachepreview.png">
				</label>
				<label>
					<input type="radio" id="Rayban" name="layer" value="Rayban"
						   onclick="showRayban();">
					<img class="layersIcon" src="./public/images/layers/Raybanpreview.png">
				</label>
				<label>
					<input type="radio" id="Sunglasses" name="layer" value="Sunglasses"
						   onclick="showSunglasses();">
					<img class="layersIcon" src="./public/images/layers/Sunglassespreview.png">
				</label>
				<label>
					<input type="radio" id="Troll" name="layer" value="Troll" onclick="showTroll();">
					<img class="layersIcon" src="./public/images/layers/Trollpreview.png">
				</label>
				<label>
					<input type="radio" id="GreyScale" name="layer" value="GreyScale" onclick="showGreyScale
						();">
					<img class="layersIcon" src="./public/images/layers/GreyScalePreview.png">
				</label>
			</div>
		</div>
	</div>
	<div>
		<h1 id="postTitle">My previous captures</h1>
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
							<img class="pLike" src="./public/images/star_Filled.png" title="Liked"
								 alt="Liked">
							<p class="nLike"><?= $userPost['likeCount'] ?></p>
						</div>
						<div class="commentCount">
							<p class="nComment"><?= $userPost['commentCount'] ?></p>
							<img class="pComment" src="./public/images/conversationFilled.png"
								 title="Comments"
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
				<?php if ($postCount <= 6) { ?>style="display: none" <?php } ?>>Load More captures
		</button>
	</div>

	<script src="public/js/layersPreview.js"></script>
	<script src="public/js/loadMore.js"></script>
	<script src="public/js/capture.js"></script>

<?php } else { ?>
	<br><p>You need to <a href="index.php?action=getLogin">Login</a> or <a
				href="index.php?action=getRegister">
			Register</a> to access this page.</p>
	<?php
}

$content = ob_get_clean(); ?>

<?php require("template.php"); ?>


