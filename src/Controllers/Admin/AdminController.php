<?php

namespace App\Controllers\Admin;

use App\Helpers\Helpers;
use App\Models\Admin;
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

    public function users () {
        $users = Admin::getAllUsers();

        $this->view("admin.users", compact("users"));
    }

    public function banUser ($id) {
        Admin::ban($id);

        $this->redirect("/admin/users")->withMessage("users", "L'utilisateur à bien été banni.", "ban");
    }

    public function unBanUser ($id) {
        Admin::unBan($id);

        $this->redirect("/admin/users")->withMessage("users", "L'utilisateur a bien été rétabli.", "unban");
    }
}