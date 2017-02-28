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

        $query = $bdd->connection()->prepare("SELECT * from comments WHERE post_id = :id");
        $query->execute(array("id" => $id));

        $results = $query->fetchAll(\PDO::FETCH_OBJ);

        return $results;

    }
}