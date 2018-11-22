<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 14/11/2018
 * Time: 21:44
 */

require_once("model/Manager.php");

class CameraManager extends Manager
{
    public function savePicture()
    {
        $db = $this->dbConnect();

    }
}