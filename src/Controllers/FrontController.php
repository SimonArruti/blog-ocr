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

        $this->view('front.home', compact("posts", "ip"));
    }

    public function show ($id) {
        $post = Post::getSinglePost($id);
        $comments = Comment::getAllCommentsWithChildren($id);

        $this->view('front.show', compact("post", "comments"));
    }

    public function account ($id) {
        $user = new User($id);
        $email = $user->getEmail();

        $this->view("user.account", compact("id", "email"));

    }

    // todo page about
}