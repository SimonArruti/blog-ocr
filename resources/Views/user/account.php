<h1>Mon compte</h1>

<p>Modifier vos informations</p>

<form action="<?= URL . '/user/' . $id . '/account' ?>" method="post">
    <h2>Changer votre adresse mail</h2>
    <label>Adresse mail</label>
    <input type="email" name="email" value="<?= $email->email ?>">

    <h2>Changer votre mot de passe</h2>
    <label>Votre mot de passe actuel</label>
    <input type="text" name="old-password">

    <label>Nouveau mot de passe</label>
    <input type="text" name="new-password">

    <label>Confirmer le nouveau mot de passe</label>
    <input type="text" name="c-new-password">

    <button type="submit">Valider</button>
</form>