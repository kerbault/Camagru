<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:12
 */
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Camagru</title>
        <link href="./public/css/style.css" rel="stylesheet"/>
        <link href="./public/images/favicon.png" rel="icon">
    </head>

    <header>
        <?php require("navBar.php") ?>
    </header>
    <body>
        <div id="content">
            <?= $content ?>
        </div>
    </body>
    <footer id="footer">
        <?php require("foot.php") ?>
    </footer>
</html>
