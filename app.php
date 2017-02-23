<?php

require_once "vendor/autoload.php";

define('URL', "http://localhost/blog/public");

$bdd = new App\Database\Connect("blog");

require_once "router.php";