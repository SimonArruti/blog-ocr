<?php

namespace App\Models;

class Post {

    public static function getAllPosts () {

        global $bdd;

        $query = $bdd->connection()->query('SELECT * FROM posts ORDER BY published_at DESC');
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
        $content = $data['content'];

        $prepare = $bdd->connection()->prepare('INSERT INTO posts(title, content, published_at) VALUES (:title, :content, NOW())');

        $prepare->execute(array(
            "title" => $title,
            "content" => $content
        ));
    }

    public static function updatePost ($id, array $data) {
        global $bdd;

        $title = $data['title'];
        $content = $data['content'];

        $prepare = $bdd->connection()->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');

        $prepare->execute(array(
            "title" => $title,
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