<h1>Edition du post "<?= $post->title ?>"</h1>

<?php if (isset($_SESSION['messages']['crud']['update']) && $_SESSION['messages']['crud']['update'] != "") {
    echo "<p>" . $_SESSION['messages']['crud']['update'] . "</p>";

    $_SESSION['messages']['crud']['update'] = "";
} ?>

<a href="<?= URL . '/admin/posts/list' ?>">Retour aux posts</a>

<form action="<?= URL . "/admin/posts/update/" . $post->id ?>" method="post">
    <label>Titre</label>
    <input type="text" name="title" value="<?= $post->title ?>">

    <label>Résumé</label>
    <input type="text" name="abstract" value="<?= $post->abstract ?>">

    <label>Contenu</label>
    <input type="text" name="content" value="<?= $post->content ?>">

    <button type="submit">Valider</button>
</form>