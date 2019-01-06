<?php

require_once('private/model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($pictureID)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, pictureID, userID, content, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE pictureID = ? ORDER BY comment_date DESC');
        $comments->execute(array($pictureID));

        return $comments;
    }

    public function postComment($pictureID, $userID, $content)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(pictureID, userID, content, `date`) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($pictureID, $userID, $content));

        return $affectedLines;
    }

    public function remComment($commentID)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM comments WHERE ID = ?');
        $comments->execute(array($commentID));
    }
}