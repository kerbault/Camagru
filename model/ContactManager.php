<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 22/11/2018
 * Time: 13:45
 */

require_once('model/Manager.php');

class ContactManager extends Manager
{
    public function sendMail($from, $content, $subject)
    {
        $db = $this->dbConnect();
        $to = 'kerbault.contact@gmail.com';
        $prefix = '[Camagru] ';

        $sent = mail($to, $prefix . $subject, $content, $from);
        if ($sent) {
            $ret = "Your message has been sent with success !";
        } else {
            $ret = "Something went wrong, Check if there is no empty field or try again later";
        }
        return ($ret);
    }
}