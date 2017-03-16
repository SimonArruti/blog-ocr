<h1>Oubli de mot de passe</h1>

<h3>Indiquer votre email pour récupérer votre mot de passe</h3>

<form action="<?= URL . '/forgot' ?>" method="post">
    <label>Votre email</label>
    <input type="email" name="email" placeholder="Email...">

    <button type="submit">Récupérer</button>
</form>