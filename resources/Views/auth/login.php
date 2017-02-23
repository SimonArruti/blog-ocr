<h1>Connexion</h1>

<?php if (isset($_SESSION['messages']['login_error']) && $_SESSION['messages']['login_error'] != "") {
    echo "<p>" . $_SESSION['messages']['login_error'] . "</p>";

    $_SESSION['messages']['login_error'] = "";
}
if (isset($_SESSION['messages']['register_success']) && $_SESSION['messages']['register_success']) {
    echo "<p>" . $_SESSION['messages']['register_success'] . "</p>";

    $_SESSION['messages']['register_success'] = "";
}
?>

<form action="<?= URL . '/login' ?>"method="post">
    <label>Email</label>
    <input type="text" name="email">

    <label>Mot de passe</label>
    <input type="text" name="password">

    <button type="submit">Connexion</button>
</form>