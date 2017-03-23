<?php

namespace App\Models;


class Admin extends User
{
    public static function getAllUsers () {
        global $bdd;

        $query = $bdd->connection()->query("SELECT * FROM users");
        $results = $query->fetchAll(\PDO::FETCH_OBJ);

        return $results;
    }

    public static function ban ($id) {
        global $bdd;

        $query = $bdd->connection()->prepare("UPDATE users SET status = 0 WHERE id = :id");
        $query->execute(array("id" => $id));
    }

    public static function unBan ($id) {
        global $bdd;

        $query = $bdd->connection()->prepare("UPDATE users SET status = 1 WHERE id = :id");
        $query->execute(array("id" => $id));
    }
}