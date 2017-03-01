<?php

use App\Controllers\FrontController;
use App\Middlewares\AdminMiddleware;
use App\Controllers\Auth\AuthController;
use App\Controllers\Post\PostController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Comment\CommentController;


$base_uri = "/blog/public";
$admin_uri = $base_uri . "/admin";

$admin_middleware = new AdminMiddleware();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {

    switch ($uri) {

        case $base_uri . "/" :
            $ctrl = new FrontController();
            $ctrl->index();

            break;

        case preg_match('#' . $base_uri . '/posts\/([1-9][0-9]*\/?)$#', $uri, $matched) == 1 :
            $ctrl = new FrontController();
            $ctrl->show($matched[1]);

            break;

        // ---------- ROUTES GET LOGIN ---------- //

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

            break;

        // ---------- ROUTES GET COMMENTS ---------- //

        // ---------- ROUTES GET ADMIN ----------- //

        case preg_match('#' . $admin_uri . '(/?)$#', $uri) == 1 :
            header("Location:" . URL .  "/admin/posts");

            break;

        case preg_match('#' . $admin_uri . '/(posts\/?)$#', $uri) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new AdminController();
                $ctrl->index();
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/list)#', $uri) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new PostController();
                $ctrl->index();
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/create)#', $uri) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new PostController();
                $ctrl->create();
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/edit\/([1-9][0-9]*))#', $uri, $matched) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new PostController();
                $ctrl->edit($matched[2]);
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/comments)#', $uri) == 1 :
            $ctrl = new AdminController();
            $ctrl->comments();

            break;
    }

}

if ($method === "POST") {

    switch ($uri) {

        // ---------- ROUTES POST LOGIN ---------- //

        case $base_uri . "/login" :
            $ctrl = new AuthController();
            $ctrl->login($_POST);

            break;

        case $base_uri . "/register":
            $ctrl = new AuthController();
            $ctrl->register($_POST);

            break;

        // ---------- ROUTES POST COMMENTS ---------- //

        case preg_match('#' . $base_uri . '/(comments\/add\/([1-9][0-9]*))#', $uri, $matched) == 1 :
            $ctrl = new CommentController();
            $ctrl->add($matched[2], $_POST);

            break;

        case preg_match('#' . $base_uri . '/(comments\/warn\/([1-9][0-9]*)\/([1-9][0-9]*))#', $uri, $matched) == 1 :
            $ctrl = new CommentController();
            $ctrl->warn($matched[2], $matched[3]);

            break;

        // ---------- ROUTES POST ADMIN ---------- //

        case preg_match('#' . $admin_uri . '/(posts\/store)$#', $uri) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new PostController();
                $ctrl->store($_POST);
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/update\/([1-9][0-9]*))#', $uri, $matched) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new PostController();
                $ctrl->update($matched[2], $_POST);
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/delete\/([1-9][0-9]*))#', $uri, $matched) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new PostController();
                $ctrl->delete($matched[2]);
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/comments\/delete\/([1-9][0-9]*))#', $uri, $matched) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new CommentController();
                $ctrl->delete($matched[2]);
            }

            break;

        case preg_match('#' . $admin_uri . '/(posts\/comments\/restore\/([1-9][0-9]*))#', $uri, $matched) == 1 :
            $is_admin = $admin_middleware->handleAdmin();
            if ($is_admin) {
                $ctrl = new CommentController();
                $ctrl->restore($matched[2]);
            }

            break;

    }
}
