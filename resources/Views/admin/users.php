<?php include(__DIR__ . "/../partials/header.php") ?>
<div class="container-fluid">
    <h2>Liste des utilisateurs</h2>
    <div class="col-md-10 col-md-offset-1">

        <?php
            if (isset($_SESSION['messages']['users']['ban']) && $_SESSION['messages']['users']['ban'] != "") {

            echo "<div class=\"alert alert-dismissible alert-success\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <p>" . $_SESSION['messages']['users']['ban'] . "</p>
                </div>";

                $_SESSION['messages']['users']['ban'] = "";
            }
            if (isset($_SESSION['messages']['users']['unban']) && $_SESSION['messages']['users']['unban'] != "") {

                echo "<div class=\"alert alert-dismissible alert-success\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                        <p>" . $_SESSION['messages']['users']['unban'] . "</p>
                    </div>";

                $_SESSION['messages']['users']['unban'] = "";
            }
        ?>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->status == 1 ? "Admis" : "Banni" ?></td>
                    <?php if ($user->status == 1) : ?>
                        <td>
                            <form class="form-inline" action="<?= URL . '/admin/users/ban/' . $user->id ?>" method="post">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Voulez-vous vraiment bannir cet utilisateur ?')">Bannir</button>
                            </form>
                        </td>
                    <?php else : ?>
                        <td>
                            <form class="form-inline" action="<?= URL . '/admin/users/unban/' . $user->id ?>" method="post">
                                <button class="btn btn-warning" type="submit" onclick="return confirm('Voulez-vous vraiment rétablir cet utilisateur ?')">Dé-bannir</button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div>
<?php include(__DIR__ . "/../partials/footer.php") ?>

