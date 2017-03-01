<h1>L'article n° <?= $post->id ?></h1>

<a href="<?= URL . '/' ?>">Retour aux articles</a>

<?php if (isset($_SESSION['messages']['comments']['warning']) && $_SESSION['messages']['comments']['warning'] != "") {
    echo "<p>" . $_SESSION['messages']['comments']['warning'] . "</p>";

    $_SESSION['messages']['comments']['warning'] = "";
}

?>

<h2><?= $post->title ?></h2>
<p><?= $post->content ?></p>

<h2>Commentaires</h2>

<?php if (isset($_SESSION['is_online'])) : ?>

    <form method="post" action="<?= URL . '/comments/add/' . $post->id ?>">
        <label>Commentaire</label>
        <textarea name="message" placeholder="Votre commentaire..."></textarea>

        <button type="submit">Envoyer</button>
    </form>

<?php else: ?>

    <p><a href="<?= URL . '/login' ?>">Connectez-vous</a> pour poster un commentaire !</p>

<?php endif ?>

<?php if (empty($comments)) : ?>
    <p>Aucun commentaire</p>
<?php else : ?>

    <?php foreach ($comments as $comment) : ?>
        <h4><?= $comment->author ?></h4>
        <p><?= $comment->message ?></p>
        <?php if (isset($_SESSION['is_online'])) : ?>
            <form action="<?= URL . '/comments/warn/' . $post->id . '/' . $comment->id ?>" method="post">
                <button type="submit">Signaler le commentaire</button>
            </form>
        <?php endif ?>
    <?php endforeach ?>

<?php endif ?>
