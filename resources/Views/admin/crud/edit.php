<?php include(__DIR__ . "/../../partials/header.php") ?>

<div class="container-fluid">

    <h2>Edition de l'article "<?= $post->title ?>"</h2>

    <?php if (isset($_SESSION['messages']['crud']['update']) && $_SESSION['messages']['crud']['update'] != "") {
        echo "<p>" . $_SESSION['messages']['crud']['update'] . "</p>";

        $_SESSION['messages']['crud']['update'] = "";
    } ?>

    <p class="lead"><a href="<?= URL . '/admin/posts/list' ?>">Retour aux posts</a></p>

    <form class="form-horizontal" action="<?= URL . "/admin/posts/update/" . $post->id ?>" method="post">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <label class="control-label">Titre</label>
                <input class="form-control" type="text" name="title" value="<?= $post->title ?>">
            </div>

            <div class="form-group">
                <label class="control-label">Résumé</label>
                <textarea class="form-control" name="abstract"><?= $post->abstract ?></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>Contenu</label>
                <textarea id="content" name="content"><?= $post->content ?></textarea>
            </div>
            <p class="text-center">
                <button class="btn btn-primary" type="submit">Valider</button>
            </p>
        </div>
    </form>
</div>

<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'#content',
        plugins: 'link, preview',
        height: 400,
        menubar: false,
        toolbar: 'undo redo | bold italic underline link | preview | fontselect'
    });
</script>
<?php include(__DIR__ . "/../../partials/footer.php") ?>