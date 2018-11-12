<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:23
 */

$title = 'Camagru';

ob_start();
?>
    <?php require("navBar.php")?>
    <div>
        <h1>Hello Title</h1>

        <p>Hello shit content</p>
    </div>



<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>