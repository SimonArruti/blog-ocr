<h1>L'article n° <?= $post->id ?></h1>

<a href="<?= URL . '/' ?>">Retour aux articles</a>

<?php
if (isset($_SESSION['messages']['comments']['warning']) && $_SESSION['messages']['comments']['warning'] != "") {
    echo "<p>" . $_SESSION['messages']['comments']['warning'] . "</p>";

    $_SESSION['messages']['comments']['warning'] = "";
}
if (isset($_SESSION['messages']['comments']['empty']) && $_SESSION['messages']['comments']['empty'] != "") {
    echo "<p>" . $_SESSION['messages']['comments']['empty'] . "</p>";

    $_SESSION['messages']['comments']['empty'] = "";
}

?>

<h2><?= $post->title ?></h2>
<p><?= $post->content ?></p>

<h2>Commentaires</h2>

<?php if (isset($_SESSION['is_online'])) : ?>

    <form id="form-comment" method="post" action="<?= URL . '/comments/add/' . $post->id ?>">
        <label>Commentaire</label>
        <textarea name="message" placeholder="Votre commentaire..."></textarea>

        <button type="submit">Envoyer</button>
    </form>

    <form id="form-comment-reply" method="post" action="<?= URL . '/comments/add/reply/' . $post->id ?>" style="display: none">
        <label>Répondre au commentaire</label>
        <textarea name="message" placeholder="Votre commentaire..."></textarea>
        <input id="reply_id" name="reply_id" type="hidden" value="0">

        <button type="submit">Envoyer</button>
    </form>

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

<script src="<?= URL . '/js/app.js' ?>"></script>
