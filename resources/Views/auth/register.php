<?php session_start(); //var_dump($_SESSION) ?>

<h1>Register</h1>

<?php
if (isset($_SESSION['messages']['register_error']['pseudo']) && $_SESSION['messages']['register_error']['pseudo'] != "") {
    echo "<p>" . $_SESSION['messages']['register_error']['pseudo'] . "</p>";
    $_SESSION['messages']['register_error']['pseudo'] = "";
}
else if (isset($_SESSION['messages']['register_error']['email']) && $_SESSION['messages']['register_error']['email'] != "") {
    echo "<p>" . $_SESSION['messages']['register_error']['email'] . "</p>";
    $_SESSION['messages']['register_error']['email'] = "";
}
?>

<form action="<?= URL . "/register" ?>" method="post">
    <label>Pseudo</label>
    <input type="text" name="username">

    <label>Email</label>
    <input type="email" name="email">

    <label>Mot de passe</label>
    <input type="password" name="password">

    <button type="submit">Valider</button>
</form>