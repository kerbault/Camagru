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
        <a href="index.php?action=getRecent" class="tab">Recent</a>
        <a href="index.php?action=getPopular" class="tab">Popular</a>
        <a href="index.php?action=" class="tab">Search</a>
        <a href="index.php?action=getCapture" class="tab">Capture</a>
        <a href="index.php?action=getUpload" class="tab">Upload</a>
    </div>
    <div class="logTab">
        <a href="index.php?action=getLogin" class="tab">Login</a>
        <a href="index.php?action=getRegister" class="tab">Register</a>
        <a href="index.php?action=getLogout" class="tab">Logout</a>
    </div>
</div>
