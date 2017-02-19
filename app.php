<?php

require_once "vendor/autoload.php";

define('URL', "http://localhost/blog/public");

require_once "src/database/Connect.php";

$bdd = new App\Database\Connect("blog");

require_once "router.php";