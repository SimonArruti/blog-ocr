<?php

namespace App\Middlewares;

use App\Controllers\Controller;

class AdminMiddleware extends Controller {

    //private $is_admin = false;

    public function handleAdmin () {
        if (isset($_SESSION['is_online'])) {
            if (isset($_SESSION['role']) && $_SESSION['role'] === "admin") {
                return true;
            }
            else {
                $this->noAdmin();
            }
        }
        else {
            $this->noAdmin();
        }
    }

    public function noAdmin () {
        $this->redirect("/");
    }

}