<?php
/**
 * Created by PhpStorm.
 * User: kerbault
 * Date: 20/12/2018
 * Time: 22:42
 */

require_once('private/model/Manager.php');

class comments extends Manager
{
    public function getComments($pictureID)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, pictureID, userID, content, DATE_FORMAT(`commentDate`, \'%d %M %Y at %Hh%im\') AS formatDate FROM comments WHERE pictureID = ? ORDER BY commentDate DESC');
        $comments->execute(array($pictureID));

        return $comments;
    }

    public function postComment($pictureID, $userID, $content)
    {
        printf($pictureID);
        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO comments(pictureID, userID, content, `commentDate`) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($pictureID, $userID, $content));

        $addComment = $db->prepare('UPDATE `pictures` SET `commentCount` = `commentCount` + 1 WHERE `id` = ?');
        $addComment->execute(array($pictureID));

        return $affectedLines;
    }

    public function remComment($commentID)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('DELETE FROM comments WHERE ID = ?');
        $comments->execute(array($commentID));
    }
}