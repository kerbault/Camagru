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
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Camagru</title>
        <link href="./public/css/style.css" rel="stylesheet">
        <link href="./public/images/favicon.png" rel="icon">
        <meta>
    </head>

    <header>
        <?php require("navBar.php") ?>
    </header>
    <body>
    <div id="body">
        <?= $content ?>
    </div>
    </body>
    <footer id="footer">
        <?php require("foot.php") ?>
    </footer>
    </html>

