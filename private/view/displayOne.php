<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 10/01/2019
 * Time: 15:06
 */

ob_start();

if (isset($pictureTmp) && isset($commentsTmp)) {
    $picture = $pictureTmp->fetch()
    ?>

    <br>
    <div class="center">
        <div class="focusCard">

            <img class="focusPicture" src="public/captures/<?= $picture['name']; ?>">
            <div class="likeNcomment">
                <div class="likeCount">
                    <img class="pLike" src="./public/images/star_Filled.png">
                    <p class="nLike"><?= $picture['likeCount'] ?></p>
                </div>
                <div class="commentCount">
                    <p class="nComment"><?= $picture['commentCount'] ?></p>
                    <img class="pComment" src="./public/images/conversationFilled.png">
                </div>
            </div>

            <div class="postDate">
                <p>Posted the <?= $picture['formatDate'] ?></p>
            </div>
            <div class="author">
                <p>by <?= $picture['likeCount'] ?></p>
            </div>


            <div class="center">
                <a href="index.php?action=removePicture"
                   onclick="return confirm('Are you sure to remove this picture and all the comments associated ?');">Remove</a>
            </div>
        </div>
        <?php
        while ($comments = $commentsTmp->fetch()) {
            ?>
            <div class="comments">
                <div class="postDate">
                    <p>Posted the <?= $comments['formatDate'] ?></p>
                </div>
                <div class="author">
                    <p>by <?php if (isset($comments['likeCount'])) {
                            echo $comments['likeCount'];
                        } else {
                            echo "Deleted Account";
                        } ?></p>
                </div>
            </div>
            <?php
        }
        $commentsTmp->closeCursor();
        ?>
        <div class="focusCard">
            <form action="index.php?action=addComment" method="post">
                <div>
                    <label for="content">Message</label><br>
                    <textarea id="comment" name="content" required></textarea>
                </div>
                <div>
                    <input type="hidden" name="id" value=<?= $picture['id'] ?>>
                    <input class="submit" type="submit" id="send" value="Post">
                </div>
            </form>
        </div>
    </div>
    <?php

} else {
    throw new Exception("Ooops Something went wrong, please try again of contact us for more help");
}

$content = ob_get_clean();

require("template.php"); ?>
