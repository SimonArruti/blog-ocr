<?php include(__DIR__ . "/../../partials/header.php") ?>
<div class="container-fluid">
    <h2>Create</h2>

    <?php if (isset($_SESSION['messages']['crud']['create']) && $_SESSION['messages']['crud']['create'] != "") {
        echo "<p>" . $_SESSION['messages']['crud']['create'] . "</p>";

        $_SESSION['messages']['crud']['create'] = "";
    } ?>

    <p class="lead"><a href="<?= URL . '/admin/posts' ?>">Retour au dashboard</a></p>

    <form class="form-horizontal" action="<?= URL . '/admin/posts/store' ?>" method="post">
        <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="form-group">
                <label class="control-label">Titre</label>
                <input class="form-control" type="text" name="title">
            </div>

            <div class="form-group">
                <label class="control-label">Résumé</label>
                <textarea class="form-control" name="abstract"></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="control-label">Contenu</label>
                <textarea id="content" name="content"></textarea>
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
        height: 350,
        menubar: false,
        toolbar: 'undo redo | bold italic underline link | preview | fontselect'
    });
</script>

<?php include(__DIR__ . "/../../partials/footer.php") ?>