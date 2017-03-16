<?php include(__DIR__ . "/../partials/header.php") ?>
<div class="container-fluid">
    <div class="col-lg-8 col-md-offset-2">
        <h1>Accueil</h1>

        <?php if (isset($_SESSION['messages']['login_success']['user'])) {
            echo "<p>" . $_SESSION['messages']['login_success']['user'] . "</p>";
            $_SESSION['messages']['login_success']['user'] = '';
        } ?>

        <?php foreach ($posts as $post) : ?>
            <div class="panel panel-default">
                <div class="panel-heading"><h3><?= ucfirst($post->title) ?></h3></div>
                <div class="panel-body">
                    <p>Résumé: <?= $post->abstract ?></p>
                    <p>Publié le <?= $post->date ?></p>
                    <a href="<?= URL . '/posts/' . $post->id ?>">Voir plus</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php include(__DIR__ . "/../partials/footer.php") ?>



