<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class FrontController
{
    use Helpers;

    public function index () {
        $posts = Post::getAllPosts();

        $this->view('front.home', compact("posts"));
    }

    public function show ($id) {
        $post = Post::getSinglePost($id);
        $comments = Comment::getAllCommentsByPost($id);

        $this->view('front.show', compact("post", "comments"));
    }

    // todo page about
}