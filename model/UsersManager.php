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
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
    }

    public function login()
    {

    }
}