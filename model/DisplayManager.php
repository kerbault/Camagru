<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 20/12/2018
 * Time: 22:42
 */

require_once('model/Manager.php');

class display extends Manager
{
    public function recent()
    {
        $db = $this->dbConnect();

        $recent = $db->query('SELECT * FROM `pictures` ORDER BY `id` DESC LIMIT 50');
        return $recent;
    }

    public function popular()
    {
        $db = $this->dbConnect();

        $recent = $db->query('SELECT * FROM `pictures` ORDER BY `likeCount` DESC LIMIT 50');
        return $recent;
    }

//    public function popular()
//    {
//        $db = $this->dbConnect();
//
//        $newPost = $db->prepare('INSERT INTO `pictures`(`userID`,`name`,`date`)
//        VALUES(:userID, :name, NOW())');
//
//        $newPost->execute(array(
//            'userID' => 0,
//            'name' => "$pictureName"
//        ));
//    }
}