<?php include(__DIR__ . "/../partials/header.php") ?>
<?php var_dump($_SESSION) ?>
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h2>Mon compte</h2>

        <?php
        if (isset($_SESSION['messages']['account']['success_email']) && $_SESSION['messages']['account']['success_email'] != "") {
            echo "<div class=\"alert alert-dismissible alert-success\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <p>" . $_SESSION['messages']['account']['success_email'] . "</p>
                    </div>";

            $_SESSION['messages']['account']['success_email'] = "";
        }
        if (isset($_SESSION['messages']['account']['error_email']) && $_SESSION['messages']['account']['error_email'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <p>" . $_SESSION['messages']['account']['error_email'] . "</p>
                    </div>";

            $_SESSION['messages']['account']['error_email'] = "";
        }
        if (isset($_SESSION['messages']['account']['error_password']) && $_SESSION['messages']['account']['error_password'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <p>" . $_SESSION['messages']['account']['error_password'] . "</p>
                    </div>";

            $_SESSION['messages']['account']['error_password'] = "";
        }
        ?>

        <h5>Modifier vos informations</h5>

        <form action="<?= URL . '/user/' . $id . '/account' ?>" method="post">
            <p class="lead">Changer votre adresse mail</p>
            <div class="form-group">
                <label class="control-label">Adresse mail</label>
                <input class="form-control" type="email" name="email" value="<?= $email->email ?>">
            </div>

            <p class="lead">Changer votre mot de passe</p>
            <div class="form-group">
                <label class="control-label">Votre mot de passe actuel</label>
                <input class="form-control" type="text" name="old-password">
            </div>

            <div class="form-group">
                <label class="control-label">Nouveau mot de passe</label>
                <input class="form-control" type="text" name="new-password">
            </div>

            <div class="form-group">
                <label class="control-label">Confirmer le nouveau mot de passe</label>
                <input class="form-control" type="text" name="c-new-password">
            </div>

            <button class="btn btn-primary" type="submit">Valider</button>
        </form>
    </div>
</div>

<?php include(__DIR__ . "/../partials/footer.php") ?>