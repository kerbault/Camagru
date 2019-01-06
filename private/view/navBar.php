<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 19:14
 */
?>

<div class="navBar">
    <div class="navTab">
        <!--        <a href="https://www.youtube.com/watch?v=_F0rCIOvqsQ">-->
        <!--            <img id="homeTab" src="./public/images/home-solid.png" alt="Home" title="Home">-->
        <!--        </a>-->
        <a href="index.php?action=getRecent" class="tab"
            <?php if (isset($_GET['action']) && $_GET['action'] == 'getRecent') { ?>
                id="current"
            <?php } ?>>Recent</a>
        <a href="index.php?action=getPopular" class="tab"
            <?php if (isset($_GET['action']) && $_GET['action'] == 'getPopular') { ?>
                id="current"
            <?php } ?>>Popular</a>
        <!--        <a href="index.php?action=" class="tab">Search</a>-->
        <a href="index.php?action=getCapture" class="tab"
            <?php if (isset($_GET['action']) && $_GET['action'] == 'getCapture') { ?>
                id="current"
            <?php } ?>>Capture</a>
    </div>
    <div class="logTab">
        <?php if ($_SESSION["user"] == "") { ?>

            <a href="index.php?action=getLogin" class="tab"
                <?php if (isset($_GET['action']) && $_GET['action'] == 'getLogin') { ?>
                    id="current"
                <?php } ?>>Login</a>

            <a href="index.php?action=getRegister" class="tab"
                <?php if (isset($_GET['action']) && $_GET['action'] == 'getRegister') { ?>
                    id="current"
                <?php } ?>>Register</a>

        <?php } else { ?>
            <a href="index.php?action=getGallery" class="tab"
                <?php if (isset($_GET['action']) && $_GET['action'] == 'getGallery') { ?>
                    id="current"
                <?php } ?>>Gallery</a>

            <a href="index.php?action=getSettings" class="tab"
                <?php if (isset($_GET['action']) && $_GET['action'] == 'getSettings') { ?>
                    id="current"
                <?php } ?>>Settings</a>

            <a href="index.php?action=getLogout" class="tab"
                <?php if (isset($_GET['action']) && $_GET['action'] == 'getLogout') { ?>
                    id="current"
                <?php } ?>>Logout</a>
        <?php } ?>
    </div>
</div>

