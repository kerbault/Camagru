<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:23
 */

ob_start();

if (isset($display)) { ?>
    <br>
    <div class="display">
        <?php
        while ($data = $display->fetch()) {
            ?>
            <div class="card">
                <a href="index.php?action=getOne&id=<?= $data['id']; ?>">
                    <img class="preview" src="public/captures/<?= $data['name']; ?>"></a>
                <div class="likeNcomment">
                    <div class="likeCount">
                        <img class="pLike" src="./public/images/star_Filled.png">
                        <p class="nLike"><?= $data['likeCount'] ?></p>
                    </div>
                    <div class="commentCount">
                        <p class="nComment"><?= $data['commentCount'] ?></p>
                        <img class="pComment" src="./public/images/conversationFilled.png">
                    </div>
                </div>
            </div>
            <?php
        }
        $display->closeCursor();
        ?>
    </div>
    <?php

} else {
    throw new Exception("Ooops Something went wrong, please try again of contact us for more help");
}

$content = ob_get_clean();

require("template.php"); ?>
