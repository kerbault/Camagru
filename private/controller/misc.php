<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 17/01/2019
 * Time: 16:57
 */

function message($message)
{
	$_POST['message'] = $message;
	require('private/view/message.php');
}