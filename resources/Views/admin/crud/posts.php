<?php include(__DIR__ . "/../../partials/header.php") ?>

<div class="container-fluid">
    <h2>Articles</h2>

    <p class="lead"><a href="<?= URL . '/admin/posts' ?>">Retour au dashboard</a></p>

    <div class="col-md-10 col-md-offset-1">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date de publication</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?= $post->id ?></td>
                    <td><?= ucfirst($post->title) ?></td>
                    <td><p class="lead"><label class="label label-primary"><?= $post->date ?></label></p></td>
                    <td>
                        <form class="form-inline" action="<?= URL . '/admin/posts/delete/' . $post->id ?>" method="post">
                            <a class="btn btn-info" href="<?= URL . '/admin/posts/edit/' . $post->id ?>">Editer</a>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ?')">Supprimer</button>

                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include(__DIR__ . "/../../partials/footer.php") ?>
