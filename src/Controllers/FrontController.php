<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Models\Post;

class FrontController
{
    use Helpers;

    public function index () {
        $posts = Post::getAllPosts();

        $this->view('front.home', compact("posts"));
    }

    public function show ($id) {
        $post = Post::getSinglePost($id);

        $this->view('front.show', compact("post"));
    }

    // todo page about
}