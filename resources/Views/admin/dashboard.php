<?php include(__DIR__ . "/../partials/header.php") ?>
<?php if (!isset($_SESSION)) session_start(); ?>

<div class="container-fluid">
    <h2>Dashboard</h2>

    <p class="lead"><a href="<?= URL . '/' ?>">Retour au site</a></p>

    <?php if (isset($_SESSION['messages']['login_success']['admin']) &&     $_SESSION['messages']['login_success']['admin'] != "") {
        echo "<div class=\"alert alert-dismissible alert-success\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                <p>" . $_SESSION['messages']['login_success']['admin'] . "</p>
            </div>";

        $_SESSION['messages']['login_success']['admin'] = "";
    }
    ?>

    <div class="list-group col-xs-12 col-sm-12 col-md-4">
        <a class="list-group-item" href="<?= URL . '/admin/posts/create' ?>">Créer</a>
        <a class="list-group-item" href="<?= URL . '/admin/posts/list' ?>">Liste des posts</a>
        <a class="list-group-item" href="<?= URL . '/admin/posts/comments' ?>">Commentaire signalés
            <span class='badge'><?= $count != 0 ? $count : 0 ?></span>
        </a>
        <a class="list-group-item" href="<?= URL . '/admin/users' ?>">Liste des utilisateurs</a>
    </div>
</div>

<?php include(__DIR__ . "/../partials/footer.php") ?>
