<?php include(__DIR__ . "/../partials/header.php") ?>
<div class="jumbotron">
    <div class="container">
        <?php
        if (isset($_SESSION['messages']['account']['success_password']) && $_SESSION['messages']['account']['success_password'] != "") {

            echo "<div class=\"alert alert-dismissible alert-success\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <p>" . $_SESSION['messages']['account']['success_password'] . "</p>
                    </div>";

            $_SESSION['messages']['account']['success_password'] = "";
        }
        if (isset($_SESSION['messages']['login_success']['user']) && $_SESSION['messages']['login_success']['user'] != "") {
            echo "<div class=\"alert alert-dismissible alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['login_success']['user'] . "</p>
                </div>";

            $_SESSION['messages']['login_success']['user'] = "";

        }

        ?>
        <h1>Accueil</h1>
        <p>Bienvenue sur le site de Jean Forteroche, découvrez ici en avant-première les chapitres de mon nouveau livre: "A l'assault de chez Antoine Lucsko"</p>
        <a class="btn btn-primary" href="<?= URL . '/posts/2' ?>">Lire le premier chapitre !</a>
    </div>
</div>
<div class="container-fluid">
    <div class="col-lg-8 col-md-offset-2">

        <?php foreach ($posts as $post) : ?>
            <div class="panel panel-default">
                <div class="panel-heading"><h3><?= ucfirst($post->title) ?></h3></div>
                <div class="panel-body">
                    <p>Résumé: <?= $post->abstract ?></p>
                    <p>Publié le <?= $post->date ?></p>
                    <a href="<?= URL . '/posts/' . $post->id ?>">Voir plus</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php include(__DIR__ . "/../partials/footer.php") ?>



