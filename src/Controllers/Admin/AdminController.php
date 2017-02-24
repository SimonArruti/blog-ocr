<?php

namespace App\Controllers\Admin;

use App\Helpers\Helpers;

class AdminController
{
    use Helpers;

    public function index () {
        $this->view("admin.dashboard");
    }
}