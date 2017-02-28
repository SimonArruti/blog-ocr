<h1>L'article n° <?= $post->id ?></h1>

<a href="<?= URL . '/' ?>">Retour aux articles</a>

<h2><?= $post->title ?></h2>
<p><?= $post->content ?></p>

<h2>Commentaires</h2>

<?php if (empty($comments)) : ?>
    <p>Aucun commentaire</p>
<?php else : ?>

    <?php foreach ($comments as $comment) : ?>
        <h4><?= $comment->author ?></h4>
        <p><?= $comment->message ?></p>
    <?php endforeach ?>

<?php endif ?>
