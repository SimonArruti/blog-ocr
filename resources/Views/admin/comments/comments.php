<h1>Modérer les commentaires</h1>

<a href="<?= URL . '/admin/posts' ?>">Retour au dashboard</a>

<?php if (isset($_SESSION['messages']['comments']['delete']) && $_SESSION['messages']['comments']['delete'] != "") {
    echo "<p>" . $_SESSION['messages']['comments']['delete'] . "</p>";

    $_SESSION['messages']['comments']['delete'] = "";
}
?>
<?php if (isset($_SESSION['messages']['comments']['restore']) && $_SESSION['messages']['comments']['restore'] != "") {
    echo "<p>" . $_SESSION['messages']['comments']['restore'] . "</p>";

    $_SESSION['messages']['comments']['restore'] = "";
}
?>

<?php if (!empty($comments)) : ?>
    <?php foreach ($comments as $comment) : ?>
        <h4><?= $comment->author ?></h4>
        <p><?= $comment->message ?></p>
        <form action="<?= URL . '/admin/posts/comments/delete/' . $comment->id ?>" method="post">
            <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer le commentaire</button>
        </form>
        <form action="<?= URL . '/admin/posts/comments/restore/' . $comment->id ?>" method="post">
            <button type="submit">Restaurer le commentaire</button>
        </form>
    <?php endforeach ?>

<?php else : ?>
    <p>Aucun commentaire à modérer.</p>
<?php endif ?>