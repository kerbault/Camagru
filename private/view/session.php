<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 03/01/2019
 * Time: 22:38
 */

session_start();

if (!isset($_SESSION['userID'])) {
	$_SESSION['userID'] = 0;
}