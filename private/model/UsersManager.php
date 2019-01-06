<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 29/11/2018
 * Time: 17:32
 */

require_once('private/model/Manager.php');

class user extends Manager
{
    public function checkValidity()
    {
        $db = $this->dbConnect();
        $users = $db->query('SELECT `login`,`email` FROM `users`');
        return $users;
    }

    public function register($login, $email, $passwd, $validkey)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `users`(`login`,`password`,`email`,`creationDate`, `validkey`)
                                        VALUES (:login, :password, :email, NOW(), :validkey)');
        $req->execute(array(
            'login' => $login,
            'password' => $passwd,
            'email' => $email,
            'validkey' => $validkey
        ));
    }

    public function login()
    {
        $db = $this->dbConnect();
        $users = $db->query('SELECT `login`,`password`,`status` FROM `users`');
        return $users;
    }

    public function verifyId()
    {
        $db = $this->dbConnect();
        $users = $db->query('SELECT `id`, `status`, `validkey` FROM `users`');
        return $users;
    }

    public function changeStatus($id, $status)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE `users` SET `status` = :status WHERE `id` = :id');
        $req->execute(array(
            'status' => $id,
            'id' => $status
        ));
    }
}