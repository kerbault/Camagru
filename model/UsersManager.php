<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 29/11/2018
 * Time: 17:32
 */

class user extends Manager
{
    public function checkValidity()
    {
        $db = $this->dbConnect();
        $users = $db->query('SELECT `login`,`email` FROM `users`');
        return $users;
    }

    public function register($login, $email, $passwd)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `users`(`login`,`password`,`email`,`creationDate`) VALUES (:login, :password, :email, NOW())');
        $req->execute(array(
            'login' => $login,
            'password' => $passwd,
            'email' => $email
        ));
    }

    public function login()
    {

    }
}