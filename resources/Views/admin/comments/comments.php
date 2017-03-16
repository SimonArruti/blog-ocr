<?php include(__DIR__ . "/../../partials/header.php") ?>

<div class="container-fluid">
    <h2>Modérer les commentaires</h2>

    <p class="lead"><a href="<?= URL . '/admin/posts' ?>">Retour au dashboard</a></p>

    <?php if (isset($_SESSION['messages']['comments']['delete']) && $_SESSION['messages']['comments']['delete'] != "") {
        echo "<div class=\"alert alert-dismissible alert-success\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <p>" . $_SESSION['messages']['comments']['delete'] . "</p>
            </div>";

        $_SESSION['messages']['comments']['delete'] = "";
    }
    ?>
    <?php if (isset($_SESSION['messages']['comments']['restore']) && $_SESSION['messages']['comments']['restore'] != "") {
        echo "<div class=\"alert alert-dismissible alert-success\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <p>" . $_SESSION['messages']['comments']['restore'] . "</p>
            </div>";

        $_SESSION['messages']['comments']['restore'] = "";
    }
    ?>
    <?php if (!empty($comments)) : ?>

        <div class="list-group">

            <?php foreach ($comments as $comment) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Auteur: <?= ucfirst($comment->author) ?></h4>
                        <p class="lead"><label class="label label-primary">Publié le <?= $comment->date ?></label></p>
                    </div>
                    <div class="panel-body">
                        <p>Commentaire: "<?= $comment->message ?>"</p>
                        <form action="<?= URL . '/admin/posts/comments/delete/' . $comment->id ?>" method="post">
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer le commentaire</button>
                        </form>
                        <br>
                        <form action="<?= URL . '/admin/posts/comments/restore/' . $comment->id ?>" method="post">
                            <button class="btn btn-warning" type="submit">Restaurer le commentaire</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    <?php else : ?>
        <p>Aucun commentaire à modérer.</p>
    <?php endif ?>
</div>
<?php include(__DIR__ . "/../../partials/footer.php") ?>
