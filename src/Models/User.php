<?php

namespace App\Models;


class User
{
    private $comment;

    public function __construct()
    {
        $this->comment = new Comment();
    }

    public function addComment () {

    }
}