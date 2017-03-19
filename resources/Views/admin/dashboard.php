<?php include(__DIR__ . "/../partials/header.php") ?>
<?php if (!isset($_SESSION)) session_start(); //var_dump($_SESSION) ?>

<div class="container-fluid">
    <h2>Dashboard</h2>

    <p class="lead"><a href="<?= URL . '/' ?>">Retour au site</a></p>

    <?php if (isset($_SESSION['messages']['login_success']['admin']) && $_SESSION['messages']['login_success']['admin'] != "") {
        echo "<p>" . $_SESSION['messages']['login_success']['admin'] . "</p>";

        $_SESSION['messages']['login_success']['admin'] = "";
    }
    ?>

    <div class="list-group col-xs-12 col-sm-12 col-md-4">
        <a class="list-group-item" href="<?= URL . '/admin/posts/create' ?>">Créer</a>
        <a class="list-group-item" href="<?= URL . '/admin/posts/list' ?>">Liste des posts</a>
        <a class="list-group-item" href="<?= URL . '/admin/posts/comments' ?>">Commentaire signalés
            <span class='badge'><?= $count != 0 ? $count : 0 ?></span>
        </a>
    </div>
</div>

<?php include(__DIR__ . "/../partials/footer.php") ?>
