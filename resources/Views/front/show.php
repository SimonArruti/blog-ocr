<?php include(__DIR__ . "/../partials/header.php") ?>

<div class="container-fluid">
    <p class="lead"><a href="<?= URL . '/' ?>">Retour aux articles</a></p>
    <?php
    if (isset($_SESSION['messages']['comments']['warning']) && $_SESSION['messages']['comments']['warning'] != "") {
        echo "<div class='alert alert-dismissible alert-info'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <p>" . $_SESSION['messages']['comments']['warning'] . "</p>
            </div>";

        $_SESSION['messages']['comments']['warning'] = "";
    }
    if (isset($_SESSION['messages']['comments']['empty']) && $_SESSION['messages']['comments']['empty'] != "") {
        echo "<div class='alert alert-dismissible alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <p>" . $_SESSION['messages']['comments']['empty'] . "</p>
            </div>";

        $_SESSION['messages']['comments']['empty'] = "";
    }
    if (isset($_SESSION['messages']['comments']['success']) && $_SESSION['messages']['comments']['success'] != "") {
        echo "<div class='alert alert-dismissible alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <p>" . $_SESSION['messages']['comments']['success'] . "</p>
            </div>";

        $_SESSION['messages']['comments']['success'] = "";
    }

    ?>

    <h2><?= ucfirst($post->title) ?></h2>
    <p><?= html_entity_decode($post->content) ?></p>

    <h4>Commentaires</h4>

    <?php if (isset($_SESSION['is_online'])) : ?>
        <div class="col-xs-12 col-sm-12 col-md-8">
            <form class="" id="form-comment" method="post" action="<?= URL . '/comments/add/' . $post->id ?>">
                <div class="form-group">
                    <label class="control-label">Commentaire</label>
                    <input class="form-control" type="text" name="message" placeholder="Votre commentaire...">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </form>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">
            <form id="form-comment-reply" method="post" action="<?= URL . '/comments/add/reply/' . $post->id ?>" style="display: none">
                <div class="form-group">
                    <label class="control-label">Répondre au commentaire</label>
                    <input class="form-control" name="message" placeholder="Votre commentaire...">
                    <input id="reply_id" name="reply_id" type="hidden" value="0">
                </div>

                <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
        </div>

    <?php else: ?>

        <p><a href="<?= URL . '/login' ?>">Connectez-vous</a> pour poster un commentaire !</p>

    <?php endif ?>

    <?php if (empty($comments)) : ?>
        <p>Aucun commentaire</p>
    <?php else : ?>


        <?php foreach ($comments as $comment) : ?>

            <?php require(__DIR__ . "/../comments/comments_front.php") ?>

        <?php endforeach ?>

    <?php endif ?>

    <?php include(__DIR__ . "/../partials/footer.php") ?>
</div>
