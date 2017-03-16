<?php

namespace App\Models\Auth;

class Register
{
    private static $error_pseudo;
    private static $error_email;
    private static $error_password;

    public static function registerUser (array $user_data) {
        global $bdd;

        $name = $user_data['username'];
        $email = $user_data['email'];
        $password = $user_data['password'];
        $c_password = $user_data['c-password'];

        $name_check = self::checkIfPseudoExists($name);
        $email_check = self::checkIfEmailExistsAndFits($email);
        $password_check = self::checkIfPasswordFit($password, $c_password);


        if (!$name_check) {
            return array("error_name" => self::$error_pseudo);
        }
        if (!$email_check) {
            return array("error_email" => self::$error_email);
        }
        if (!$password_check) {
            return array("error_password" => self::$error_password);
        }
        if ($name_check && $email_check && $password_check) {
            $password = self::hash_password($password);

            $prepare = $bdd->connection()->prepare('
                INSERT INTO users(username, email, password) 
                VALUES (:username, :email, :password)
            ');

            $prepare->execute(array(
                "username" => $name,
                "email" => $email,
                "password" => $password
            ));
        }
    }

    private static function checkIfPseudoExists ($name) {

        global $bdd;

        $match_name = $bdd->connection()->prepare('SELECT username FROM users WHERE username = :name');
        $match_name->execute(array("name" => $name));

        $result_name = $match_name->fetch();

        if (!empty($result_name)) {
            self::$error_pseudo = true;

            return false;
        }
        else {
            self::$error_pseudo = false;

            return true;
        }

    }

    private static function checkIfEmailExistsAndFits ($email) {
        global $bdd;

        $regexp = '/^(\s*|[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})$/';

        $match_email = $bdd->connection()->prepare('SELECT email FROM users WHERE email = :email');
        $match_email->execute(array("email" => $email));

        $result_mail = $match_email->fetch();

        if(!empty($result_mail) && preg_match($regexp, $email) == 1) {
            self::$error_email = true;

            return false;
        }
        else {
            self::$error_email = false;

            return true;
        }

    }

    private static function checkIfPasswordFit ($password, $c_password) {
        $regexp = '/^((?=\S*?[A-Z])(?=\S*?[a-éz])(?=\S*?[0-9]).{7,})\S$/';

        if (preg_match($regexp, $password) == 1 && $password === $c_password) {
            self::$error_password = false;

            return true;
        }
        else {
            self::$error_password = true;

            return false;
        }
    }

    private static function hash_password (string $password_brut) {
        return password_hash($password_brut, PASSWORD_BCRYPT);
    }
}