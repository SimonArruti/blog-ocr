<?php if (!isset($_SESSION)) session_start(); //var_dump($_SESSION) ?>

<h1>Dashboard</h1>

<a href="<?= URL . '/' ?>">Retour au site</a>

<?php if (isset($_SESSION['messages']['login_success']['admin']) && $_SESSION['messages']['login_success']['admin'] != "") {
    echo "<p>" . $_SESSION['messages']['login_success']['admin'] . "</p>";

    $_SESSION['messages']['login_success']['admin'] = "";
}
?>

<ul>
    <li><a href="<?= URL . '/admin/posts/create' ?>">Create</a></li>
    <li><a href="<?= URL . '/admin/posts/list' ?>">Liste des posts</a></li>
    <li><a href="<?= URL . '/admin/posts/comments' ?>">
            Commentaire signalés <?php if ($count != 0) echo "(" . $count . ")" ?>
        </a>
    </li>
</ul>
