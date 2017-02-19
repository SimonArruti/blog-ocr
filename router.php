<?php

use App\Controllers\FrontController;
use App\Controllers\Auth\AuthController;

$base_uri = "/blog/public";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {

    switch ($uri) {

        case $base_uri . "/" :
            $ctrl = new FrontController();
            $ctrl->index();

            break;

        case preg_match('#' . $base_uri . '/posts\/([1-9][0-9]*)$#', $uri, $matched) == 1 :
            $ctrl = new FrontController();
            $ctrl->show($matched[1]);

            break;

        case $base_uri . "/login" :
            $ctrl = new AuthController();
            $ctrl->loginPage();

            break;

        case $base_uri . "/register" :
            $ctrl = new AuthController();
            $ctrl->registerPage();

            break;

        case $base_uri . "/logout" :
            $ctrl = new AuthController();
            $ctrl->logout();
    }

}

if ($method === "POST") {

    switch ($uri) {

        case $base_uri . "/login" :
            $ctrl = new AuthController();
            $ctrl->login($_POST);

            break;

        case $base_uri . "/register":
            $ctrl = new AuthController();
            $ctrl->register($_POST);

    }
}
