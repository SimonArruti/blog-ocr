<?php
/**
 * Created by PhpStorm.
 * User: simonarruti
 * Date: 27/02/2017
 * Time: 21:33
 */

namespace App\Models;


class Comment
{
    public static function getAllCommentsByPost ($id) {

        global $bdd;

        $query = $bdd->connection()->prepare('
            SELECT id, author, message, reply_id, DATE_FORMAT(published_at, \'%d/%m/%Y, à %Hh%i\') 
            AS date 
            FROM comments 
            WHERE post_id = :id 
            AND warning = 0');
        $query->execute(array("id" => $id));

        $results = $query->fetchAll(\PDO::FETCH_OBJ);

        return $results;

    }

    public static function addComment ($user_id, $post_id, $user, $message) {
        global $bdd;

        $query = $bdd->connection()->prepare("INSERT INTO comments(user_id, post_id, author, message, published_at) VALUES (:userid, :postid, :author, :message, NOW())");

        $query->execute(array(
            "userid" => $user_id,
            "postid" => $post_id,
            "author" => $user,
            "message" => $message
        ));

    }

    public static function addReplyToComment ($user_id, $post_id, $reply_id, $user, $message) {
        global $bdd;

        $query = $bdd->connection()->prepare("INSERT INTO comments(user_id, post_id, reply_id, author, message, published_at) VALUES (:userid, :postid, :replyid, :author, :message, NOW())");

        $query->execute(array(
            "userid" => $user_id,
            "postid" => $post_id,
            "replyid" => $reply_id,
            "author" => $user,
            "message" => $message
        ));
    }

    public static function warnComment ($id) {
        global $bdd;

        $query = $bdd->connection()->prepare("UPDATE comments SET warning = 1 WHERE id = :id");
        $query->execute(array("id" => $id));

    }

    public static function unWarnComment ($id) {
        global $bdd;

        $query = $bdd->connection()->prepare("UPDATE comments SET warning = 0 WHERE id = :id");
        $query->execute(array("id" => $id));
    }

    public static function getWarnComments () {
        global $bdd;

        $query = $bdd->connection()->query("SELECT * FROM comments WHERE warning = 1");
        $results = $query->fetchAll(\PDO::FETCH_OBJ);

        return $results;
    }

    public static function deleteComment ($id) {
        global $bdd;

        $query = $bdd->connection()->prepare("DELETE FROM comments WHERE id = :id");
        $query->execute(array("id" => $id));
    }
}