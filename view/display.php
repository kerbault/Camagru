<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:23
 */

ob_start(); ?>

<?php
if (isset($recent)) { ?>
    <br>
    <div class="display">
        <?php
        while ($data = $recent->fetch()) {
            ?>
            <div class="card">
                <img class="preview" src="public/captures/<?= $data['name']; ?>">
                <div class="likeNcomment">
                    <div class="likeCount">
                        <img class="pLike" src="./public/images/home-solid.png">
                        <p class="nLike"><?= $data['likeCount'] ?></p>
                    </div>
                    <div class="commentCount">
                        <p class="nComment"><?= $data['likeCount'] ?></p>
                        <img class="pComment" src="./public/images/home-solid.png">
                    </div>
                </div>
            </div>
            <?php
        }
        $recent->closeCursor();
        ?>
    </div>
    <?php

} else {
    throw new Exception("Ooops Something went wrong, please try again of contact us for more help");
}
?>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
