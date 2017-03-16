<?php include(__DIR__ . "/../partials/header.php") ?>
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        <h2>Mon compte</h2>

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