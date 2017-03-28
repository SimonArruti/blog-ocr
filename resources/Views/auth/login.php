<?php include(__DIR__ . "/../partials/header.php") ?>

<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h2>Connexion</h2>

        <?php
        if (isset($_SESSION['messages']['login_error']['empty']) && $_SESSION['messages']['login_error']['empty'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['login_error']['empty'] . "</p>
                </div>";

            $_SESSION['messages']['login_error']['empty'] = "";
        }
        if (isset($_SESSION['messages']['login_error']['invalid_field']) && $_SESSION['messages']['login_error']['invalid_field'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['login_error']['invalid_field'] . "</p>
                </div>";

            $_SESSION['messages']['login_error']['invalid_field'] = "";
        }
        if (isset($_SESSION['messages']['register_success']) && $_SESSION['messages']['register_success']) {
            echo "<div class=\"alert alert-dismissible alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['register_success'] . "</p>
                </div>";

            $_SESSION['messages']['register_success'] = "";
        }
        ?>

        <form action="<?= URL . '/login' ?>" method="post">
            <div class="form-group">
                <label class="control-label">Email</label>
                <input class="form-control" type="text" name="email">
            </div>

            <div class="form-group">
                <label class="control-label">Mot de passe</label>
                <input class="form-control" type="password" name="password">
            </div>
            <p><a href="<?= URL . '/forgot' ?>">Mot de passe oublié ?</a></p>
            <button class="btn btn-primary" type="submit">Connexion</button>
        </form>

    </div>
</div>
<?php include(__DIR__ . "/../partials/footer.php") ?>
