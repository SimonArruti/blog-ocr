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

        $comments = $query->fetchAll(\PDO::FETCH_OBJ);

        $comments_by_id = [];

        foreach ($comments as $comment) {
            $comments_by_id[$comment->id] = $comment;
        }

        return $comments_by_id;
    }

    public static function getAllCommentsWithChildren($post_id, $unset_children = true)
    {
        $comments = $comments_by_id = self::getAllCommentsByPost($post_id);

        foreach ($comments as $id => $comment) {

            if ($comment->reply_id != null) {
                $comments_by_id[$comment->reply_id]->children[] = $comment;

                if ($unset_children) {
                    unset($comments[$id]);
                }
            }
        }

        return $comments;
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

        $query = $bdd->connection()->query("SELECT id, author, message, DATE_FORMAT(published_at, '%d/%m/%Y, à %Hh%i') 
            AS date FROM comments WHERE warning = 1");
        $results = $query->fetchAll(\PDO::FETCH_OBJ);

        return $results;
    }

    public static function deleteComment ($id) {
        global $bdd;

        $query = $bdd->connection()->prepare("DELETE FROM comments WHERE id = :id");
        $query->execute(array("id" => $id));
    }

    public static function countWarnComments () {
        global $bdd;
        $query = $bdd->connection()->query("SELECT COUNT(*) AS count FROM comments WHERE warning = 1");
        $result = $query->fetch(\PDO::FETCH_OBJ);

        $count = $result->count;

        return $count;
    }
}