<?php include(__DIR__ . "/../partials/header.php") ?>
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h2>Oubli de mot de passe</h2>

        <?php
        if (isset($_SESSION['messages']['forgot']['wrong_email']) && $_SESSION['messages']['forgot']['wrong_email'] != "") {
            echo "<div class=\"alert alert-dismissible alert-warning\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <p>" . $_SESSION['messages']['forgot']['wrong_email'] . "</p>
                    </div>";

            $_SESSION['messages']['forgot']['wrong_email'] = "";
        }
        if (isset($_SESSION['messages']['forgot']['send_success']) && $_SESSION['messages']['forgot']['send_success'] != "") {
            echo "<div class=\"alert alert-dismissible alert-success\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <p>" . $_SESSION['messages']['forgot']['send_success'] . "</p>
                    </div>";

            $_SESSION['messages']['forgot']['send_success'] = "";
        }
        ?>

        <p class="lead">Indiquer votre email pour récupérer votre mot de passe.</p>

        <form action="<?= URL . '/forgot' ?>" method="post">
            <div class="form-group">
                <label class="control-label">Votre email</label>
                <input class="form-control" type="email" name="email" placeholder="Email...">
            </div>

            <button class="btn btn-primary" type="submit">Récupérer</button>
        </form>
    </div>
</div>

<?php include(__DIR__ . "/../partials/footer.php") ?>