<h1>Create</h1>

<?php if (isset($_SESSION['messages']['crud']['create']) && $_SESSION['messages']['crud']['create'] != "") {
    echo "<p>" . $_SESSION['messages']['crud']['create'] . "</p>";

    $_SESSION['messages']['crud']['create'] = "";
} ?>

<a href="<?= URL . '/admin/posts' ?>">Retour au dashboard</a>

<form action="<?= URL . '/admin/posts/store' ?>" method="post">
    <label>Titre</label>
    <input type="text" name="title">

    <label>Résumé</label>
    <textarea name="abstract"></textarea>

    <label>Contenu</label>
    <textarea name="content"></textarea>

    <button type="submit">Valider</button>
</form>