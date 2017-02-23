<?php
/**
 * Created by PhpStorm.
 * User: simonarruti
 * Date: 20/02/2017
 * Time: 14:59
 */

namespace App\Controllers\Post;

use App\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index () {
        $posts = Post::getAllPosts();

        $this->view("admin.crud.posts", compact("posts"));
    }

    public function create () {
        $this->view("admin.crud.create");
    }

    public function store (array $data) {
        $data_OK = array(
            "title" => htmlentities($data['title']),
            "abstract" => htmlentities($data['abstract']),
            "content" => htmlentities($data['content'])
        );

        Post::addPost($data_OK);

        $this->redirect("/admin/posts/list");

    }

    public function edit ($id) {
        $post = Post::getSinglePost($id);

        $this->view("admin.crud.edit", compact("post"));
    }

    public function update ($id, array $data) {
        $data_OK = array(
            "title" => $data['title'],
            "abstract" => $data['abstract'],
            "content" => $data['content']
        );

        Post::updatePost($id, $data_OK);

        $this->redirect("/admin/posts/list");
    }

    public function delete ($id) {
        Post::deletePost($id);

        $this->redirect("/admin/posts/list");
    }
}