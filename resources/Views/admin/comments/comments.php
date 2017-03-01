<h1>Commentaires signalés</h1>

<a href="<?= URL . '/admin/posts' ?>">Retour au dashboard</a>

<?php if (isset($_SESSION['messages']['comments']['delete']) && $_SESSION['messages']['comments']['delete'] != "") {
    echo "<p>" . $_SESSION['messages']['comments']['delete'] . "</p>";

    $_SESSION['messages']['comments']['delete'] = "";
}

?>

<?php if (!empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>
        <h4><?= $comment->author ?></h4>
        <p><?= $comment->message ?></p>
        <form action="<?= URL . '/admin/posts/comments/delete/' . $comment->id ?>" method="post">
            <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer le commentaire</button>
        </form>
    <?php endforeach ?>

<?php else : ?>
    <p>Aucun commentaire à modérer.</p>
<?php endif ?>