<h1>Create</h1>

<a href="<?= URL . '/admin/posts' ?>">Retour aux posts</a>

<form action="<?= URL . '/admin/posts/store' ?>" method="post">
    <label>Titre</label>
    <input type="text" name="title">

    <label>Résumé</label>
    <textarea name="abstract"></textarea>

    <label>Contenu</label>
    <textarea name="content"></textarea>

    <button type="submit">Valider</button>
</form>