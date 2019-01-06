<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 20/12/2018
 * Time: 18:22
 */

ob_start(); ?>
<br>
<p><?= $_POST['message'] ?></p>

<?php $content = ob_get_clean();

require("template.php"); ?>
