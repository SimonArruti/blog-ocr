<h1>Edition du post "<?= $post->title ?>"</h1>

<a href="<?= URL . '/' ?>">Retour aux posts</a>

<form action="<?= URL . "/admin/posts/update/" . $post->id ?>" method="post">
    <label>Titre</label>
    <input type="text" name="title" value="<?= $post->title ?>">

    <label>Résumé</label>
    <input type="text" name="abstract" value="<?= $post->abstract ?>">

    <label>Contenu</label>
    <input type="text" name="content" value="<?= $post->content ?>">

    <button type="submit">Valider</button>
</form>