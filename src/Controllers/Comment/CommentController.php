<?php

namespace App\Controllers\Comment;

use App\Helpers\Helpers;
use App\Models\Comment;

class CommentController {

    use Helpers;

    public function add ($post_id, $data) {
        if ($data['message'] === '') {
            $this->redirect("/posts/" . $post_id)->withMessage("comments", "Le commentaire ne doit pas être vide !", "empty");

            return;
        }

        $comment = htmlentities($data['message']);
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['name'];

        if (!isset($data['reply_id'])) {
            Comment::addComment($user_id, $post_id, $username, $comment);

            $this->redirect("/posts/" . $post_id)->withMessage("comments", "Votre commentaire a bien été ajouté.", "success");

            return;
        }
        else {
            if ($data['message'] === '') {
                $this->redirect("/posts/" . $post_id)->withMessage("comments", "Le commentaire ne doit pas être vide !", "empty");

                return;
            }

            $reply_id = $data['reply_id'];
            Comment::addReplyToComment($user_id, $post_id, $reply_id, $username, $comment);

            $this->redirect("/posts/" . $post_id)->withMessage("comments", "Votre commentaire a bien été ajouté.", "success");

            return;
        }
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

    public function restore ($id) {
        Comment::unWarnComment($id);

        $this->redirect("/admin/posts/comments")->withMessage("comments", "Le commentaire a bien été restauré.", "restore");
    }

    public function delete ($id) {
        Comment::deleteComment($id);

        $this->redirect("/admin/posts/comments")->withMessage("comments", "Le commentaire a bien été supprimé.", "delete");
    }

}