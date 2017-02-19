<?php

namespace App\Models\Auth;


class Register
{
    private static $error_pseudo;
    private static $error_email;

    public static function registerUser (array $user_data) {

        global $bdd;

        $name = $user_data['username'];
        $email = $user_data['email'];
        $password = $user_data['password'];

        $name_check = self::checkIfPseudoExists($name);
        $email_check = self::checkIfEmailExists($email);

        var_dump(self::$error_pseudo);

        if (!$name_check) {
            return array("error_name" => self::$error_pseudo);
        }
        else if (!$email_check) {
            return array("error_email" => self::$error_email);
        }
        else {
            $prepare = $bdd->connection()->prepare('INSERT INTO users(username, email, password) VALUES (:username, :email, :password)');

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

    private static function checkIfEmailExists ($email) {

        global $bdd;

        $match_email = $bdd->connection()->prepare('SELECT email FROM users WHERE email = :email');
        $match_email->execute(array("email" => $email));

        $result_mail = $match_email->fetch();

        if(!empty($result_mail)) {
            self::$error_email = true;

            return false;
        }
        else {
            self::$error_email = false;

            return true;
        }

    }
}