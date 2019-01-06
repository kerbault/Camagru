<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 14:38
 */

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=mysql;dbname=Camagru;charset=utf8', 'root', '');
        return $db;
    }
}