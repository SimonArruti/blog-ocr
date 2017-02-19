<?php session_start() ?>
<h1>Homepage</h1>

<div>
    <?php if (isset($_SESSION['is_online'])) : ?>
        <strong>Bonjour, <?= $_SESSION['email'] ?></strong>
        <a href=<?= URL . '/logout' ?>>Déconnexion</a>
    <?php else : ?>
        <a href=<?= URL . '/login' ?>>Connexion</a>
        <a href=<?= URL . '/register' ?>>Inscription</a>
    <?php endif ?>
</div>

<?php foreach ($posts as $post) : ?>
    <h3><?= $post->title ?></h3>
    <p><?= $post->abstract ?></p>
    <a href="<?= URL . '/posts/' . $post->id ?>">Voir plus</a>
<?php endforeach ?>
