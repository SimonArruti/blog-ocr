<?php

namespace App\Controllers\Admin;

use App\Helpers\Helpers;
use App\Models\Comment;

class AdminController
{
    use Helpers;

    public function index () {
        $count = Comment::countWarnComments();

        $this->view("admin.dashboard", compact("count"));
    }

    public function comments () {
        $comments = Comment::getWarnComments();

        $this->view("admin.comments.comments", compact("comments"));
    }
}