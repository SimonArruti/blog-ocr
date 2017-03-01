<?php

namespace App\Controllers\Admin;

use App\Helpers\Helpers;
use App\Models\Comment;

class AdminController
{
    use Helpers;

    public function index () {
        global $bdd;
        $query = $bdd->connection()->query("SELECT COUNT(*) AS count FROM comments WHERE warning = 1");
        $result = $query->fetch(\PDO::FETCH_OBJ);

        $count = $result->count;

        $this->view("admin.dashboard", compact("count"));
    }

    public function comments () {
        $comments = Comment::getWarnComments();

        $this->view("admin.comments.comments", compact("comments"));
    }
}