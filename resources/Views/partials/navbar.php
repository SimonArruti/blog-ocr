<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= URL . '/' ?>">Jean Forteroche</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <?php if (isset($_SESSION['is_online'])) : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= strtoupper($_SESSION['name']) ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href=<?= URL . '/user/'. $_SESSION['user_id'] .'/account' ?>>Mon compte</a></li>
                            <li class="divider"></li>
                            <?php if ($_SESSION['role'] === "admin") : ?>
                                <li><a href=<?= URL . '/admin' ?>>Administration</a></li>
                                <li class="divider"></li>
                            <?php endif ?>
                            <li><a href=<?= URL . '/logout' ?>>Déconnexion</a></li>
                        </ul>
                    </li>

                <?php else : ?>
                    <li><a href=<?= URL . '/login' ?>>CONNEXION</a></li>
                    <li><a href=<?= URL . '/register' ?>>INSCRIPTION</a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

