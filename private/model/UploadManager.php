<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 26/11/2018
 * Time: 17:35
 */

require_once('private/model/Manager.php');

class upload extends Manager
{
    public function uploadPictureDb($pictureName)
    {
        $db = $this->dbConnect();
        $userId = $_SESSION['id'];

        $newPost = $db->prepare('INSERT INTO `pictures`(`userID`,`name`,`date`)
        VALUES(:userID, :name, NOW())');

        $newPost->execute(array(
            'userID' => "$userId",
            'name' => "$pictureName"
        ));
    }
}