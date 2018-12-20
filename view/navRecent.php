<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:23
 */

ob_start(); ?>

<?php
while ($data = $recent->fetch()) {
    ?>
    <div>
        <img src="uploads/<?php echo $data['name']; ?>">
    </div>
    <?php
}
$recent->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require("template.php"); ?>
