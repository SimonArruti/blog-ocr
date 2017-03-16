<?php
/**
 * Created by PhpStorm.
 * User: simonarruti
 * Date: 20/02/2017
 * Time: 14:59
 */

namespace App\Controllers\Post;

use App\Helpers\Helpers;
use App\Models\Post;
use App\Validation\Validation;
use GUMP;

class PostController

{
    use Helpers;

    public function index () {
        $posts = Post::getAllPosts();

        $this->view("admin.crud.posts", compact("posts"));
    }

    public function create () {
        $this->view("admin.crud.create");
    }

    public function store (array $data) {

        $is_valid_store = GUMP::is_valid($data, array(
            "title" => "required|min_len,2|max_len,50",
            "abstract" => "required|min_len,2",
            "content" => "required|min_len,2"
        ));

        if ($is_valid_store === true) {
            $data_OK = array(
                "title" => htmlentities($data['title']),
                "abstract" => htmlentities($data['abstract']),
                "content" => htmlentities($data['content'])
            );

            Post::addPost($data_OK);

            $this->redirect("/admin/posts/list");
        }
        else {
            $this->redirect("/admin/posts/create")->withMessage("crud", "Les données envoyées ne correspondent pas aux restrictions des champs.", "create");
        }
    }

    public function edit ($id) {
        $post = Post::getSinglePost($id);

        $this->view("admin.crud.edit", compact("post"));
    }

    public function update ($id, array $data) {
        $is_valid_update = GUMP::is_valid($data, array(
            "title" => "required|min_len,2|max_len,50",
            "abstract" => "required|min_len,2",
            "content" => "required|min_len,2"
        ));

        if ($is_valid_update === true) {
            $data_OK = array(
                "title" => $data['title'],
                "abstract" => $data['abstract'],
                "content" => $data['content']
            );

            Post::updatePost($id, $data_OK);

            $this->redirect("/admin/posts/list");
        }
        else {
            $this->redirect("/admin/posts/edit/" . $id)->withMessage("crud", "Les données envoyées ne correspondent pas aux restrictions des champs.", "update");
        }


    }

    public function delete ($id) {
        Post::deletePost($id);

        $this->redirect("/admin/posts/list");
    }
}