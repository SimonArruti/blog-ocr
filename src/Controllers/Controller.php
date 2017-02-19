<?php

namespace App\Controllers;


class Controller
{
    protected function view ($filepath, array $data = []) {

        $file = __DIR__ . "/../../resources/Views/" . str_replace('.', '/', $filepath) . ".php";

        extract($data);
        include_once $file;
    }

    protected function redirect ($path) {
        header("Location:" . URL . $path);

        return $this;
    }
    protected function withMessage ($type, $message, $subtype = null) {
        session_start();
        $this->session($type, $message, $subtype);
    }

    protected function session ($index, $value, $subindex = null) {
        if ($subindex === null) {
            $session = $_SESSION['messages'][$index] = $value;
        }
        else {
            $session = $_SESSION['messages'][$index][$subindex] = $value;
        }

        return $session;
    }
}