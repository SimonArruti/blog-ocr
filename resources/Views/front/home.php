<h1>Homepage</h1>

<?php if (isset($_SESSION['messages']['login_success']['user'])) {
    echo "<p>" . $_SESSION['messages']['login_success']['user'] . "</p>";
    $_SESSION['messages']['login_success']['user'] = '';
} ?>

<div>
    <?php if (isset($_SESSION['is_online'])) : ?>
        <strong>Bonjour, <?= $_SESSION['email'] ?></strong>
        <?php if ($_SESSION['role'] === "admin") : ?>
            <a href=<?= URL . '/admin' ?>>Administration</a>
        <?php endif ?>
        <a href=<?= URL . '/logout' ?>>Déconnexion</a>
    <?php else : ?>
        <a href=<?= URL . '/login' ?>>Connexion</a>
        <a href=<?= URL . '/register' ?>>Inscription</a>
    <?php endif ?>
</div>

<?php foreach ($posts as $post) : ?>
    <h3><?= $post->title ?></h3>
    <p><?= $post->abstract ?></p>
    <p>publié le <?= $post->date ?></p>
    <a href="<?= URL . '/posts/' . $post->id ?>">Voir plus</a>
<?php endforeach ?>
