<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:03
 */

include('database.php');

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$create_db = file_get_contents('private/config/Camagru.sql');
	$db->exec($create_db);
	$db = null;
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
?>