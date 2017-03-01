<?php
namespace App\Helpers;

trait Helpers
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

    protected function redirect ($path) {
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

    protected function userIP () {
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}