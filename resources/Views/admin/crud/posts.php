<h1>Posts</h1>

<a href="<?= URL . '/admin/posts' ?>">Retour au dashboard</a>

<?php foreach ($posts as $post) : ?>
    <h3><?= $post->title ?></h3>
    <p><?= $post->abstract ?></p>
    <p>publié le <?= $post->date ?></p>
    <a href="<?= URL . '/admin/posts/edit/' . $post->id ?>">Editer</a>
    <form action="<?= URL . '/admin/posts/delete/' . $post->id ?>" method="post">
        <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer</button>
    </form>
<?php endforeach ?>