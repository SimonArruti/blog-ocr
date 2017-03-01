<?php

namespace App\Controllers\Comment;

use App\Helpers\Helpers;
use App\Models\Comment;

class CommentController {

    use Helpers;

    public function add ($post_id, $comment) {
        $comment = htmlentities($comment['message']);
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['name'];

        Comment::addComment($user_id, $post_id, $username, $comment);

        $this->redirect("/posts/" . $post_id);
    }

    public function warn ($post_id, $comment_id) {
        if (isset($_SESSION['is_online'])) {
            Comment::warnComment($comment_id);

            $this->redirect("/posts/" . $post_id)->withMessage("comments", "Le commentaire a bien été signalé", "warning");
        }
        else {
            $this->redirect("/");
        }
    }

    public function delete ($id) {
        Comment::deleteComment($id);

        $this->redirect("/admin/posts/comments")->withMessage("comments", "Le commentaire a bien été supprimé.", "delete");
    }

}