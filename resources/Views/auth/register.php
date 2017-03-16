<?php include(__DIR__ . "/../partials/header.php") ?>
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h2>Inscription</h2>

        <?php
        if (isset($_SESSION['messages']['register_error']['empty']) && $_SESSION['messages']['register_error']['empty'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['register_error']['empty'] . "</p>
                </div>";

            $_SESSION['messages']['register_error']['empty'] = "";
        }
        if (isset($_SESSION['messages']['register_error']['pseudo']) && $_SESSION['messages']['register_error']['pseudo'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['register_error']['pseudo'] . "</p>
                </div>";

            $_SESSION['messages']['register_error']['pseudo'] = "";
        }
        if (isset($_SESSION['messages']['register_error']['email']) && $_SESSION['messages']['register_error']['email'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['register_error']['email'] . "</p>
                </div>";

            $_SESSION['messages']['register_error']['email'] = "";
        }
        if (isset($_SESSION['messages']['register_error']['password']) && $_SESSION['messages']['register_error']['password'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['register_error']['password'] . "</p>
                </div>";

            $_SESSION['messages']['register_error']['password'] = "";
        }
        ?>

        <form action="<?= URL . "/register" ?>" method="post">
            <div class="form-group">
                <label class="control-label">Pseudo</label>
                <input class="form-control" type="text" name="username">
            </div>

            <div class="form-group">
                <label class="control-label">Email</label>
                <input class="form-control" type="email" name="email">
            </div>

            <div class="form-group">
                <label class="control-label">Mot de passe</label>
                <input class="form-control" type="text" name="password">
            </div>

            <div class="form-group">
                <label class="control-label">Confirmation de mot de passe</label>
                <input class="form-control" type="text" name="c-password">
            </div>

            <button class="btn btn-primary" type="submit">Valider</button>
        </form>
    </div>
</div>

<?php include(__DIR__ . "/../partials/footer.php") ?>