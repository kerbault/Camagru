<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 03/01/2019
 * Time: 22:38
 */

session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = "";
}

if (!isset($_SESSION['status'])) {
    $_SESSION['status'] = 0;
}

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = 0;
}