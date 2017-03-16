<?php

namespace App\Models;

class Post {

    public static function getAllPosts () {

        global $bdd;

        $query = $bdd->connection()->query('
            SELECT id, title, abstract, DATE_FORMAT(published_at, \'%d/%m/%Y, à %Hh%i\') AS date
            FROM posts 
            ORDER BY id
            DESC
        ');
        $results = $query->fetchAll(\PDO::FETCH_OBJ);

        return $results;
    }

    public static function getSinglePost ($id) {
        global $bdd;

        $prepare = $bdd->connection()->prepare('SELECT * FROM posts WHERE id = :id');
        $prepare->bindParam(':id', $id);

        $prepare->execute();
        $result = $prepare->fetch(\PDO::FETCH_OBJ);

        return $result;
    }

    public static function addPost (array $data) {
        global $bdd;

        $title = $data['title'];
        $abstract = $data['abstract'];
        $content = $data['content'];

        $prepare = $bdd->connection()->prepare('INSERT INTO posts(title, abstract, content, published_at) VALUES (:title, :abstract, :content, NOW())');

        $prepare->execute(array(
            "title" => $title,
            "abstract" => $abstract,
            "content" => $content
        ));
    }

    public static function updatePost ($id, array $data) {
        global $bdd;

        $title = $data['title'];
        $abstract = $data['abstract'];
        $content = $data['content'];

        $prepare = $bdd->connection()->prepare('UPDATE posts SET title = :title, abstract = :abstract, content = :content, updated_at = NOW() WHERE id = :id');

        $prepare->execute(array(
            "title" => $title,
            "abstract" => $abstract,
            "content" => $content,
            "id" => $id
        ));
    }

    public static function deletePost ($id) {
        global $bdd;

        $prepare = $bdd->connection()->prepare('DELETE FROM posts WHERE id = :id');

        $prepare->execute(array("id" => $id));
    }

}