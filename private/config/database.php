<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 12/11/2018
 * Time: 18:05
 */

$DB_BASE      = 'Camagru';
$DB_DSN_LIGHT = 'mysql:host=mysql';
$DB_DSN       = $DB_DSN_LIGHT . ';dbname=' . $DB_BASE;
$DB_USER      = 'root';
$DB_PASSWORD  = 'root';

//Le DSN (Data Source Name) contient les informations requises pour se connecter à la
//base, par exemple ’mysql:dbname=testdb;host=127.0.0.1’. En général, un DSN est
//constitué du nom du pilote PDO, suivi d’une syntaxe spécifique au pilote. Plus de détails
//sont disponibles dans la documentation PDO de chaque pilote 2
//    .