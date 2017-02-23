<?php

namespace App\Controllers;


class Controller
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    protected function view ($filepath, array $data = []) {

        $file = __DIR__ . "/../../resources/Views/" . str_replace('.', '/', $filepath) . ".php";

        extract($data);
        include_once $file;
    }

    public function redirect ($path) {
        header("Location:" . URL . $path);

        return $this;
    }
    protected function withMessage ($type, $message, $subtype = null) {
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