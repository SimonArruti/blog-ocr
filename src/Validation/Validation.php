<?php

namespace App\Validation;


class Validation
{
    public function hash_password (string $password_brut) {
        return password_hash($password_brut, PASSWORD_BCRYPT);
    }
}