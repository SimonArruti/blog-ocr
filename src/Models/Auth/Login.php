<?php

namespace App\Models\Auth;


class Login
{
    public static function login ($user_data) {
        session_start();

        $_SESSION['is_online'] = true;
        $_SESSION['name'] = $user_data->username;
        $_SESSION['email'] = $user_data->email;
    }

    public static function checkLogin (array $user_data) {

        global $bdd;

        $email = $user_data['email'];
        $password = $user_data['password'];

        $email_check = self::checkEmail($email);

        if ($email_check) {
            $password_check = self::checkPassword($email, $password);

            if ($password_check) {
                $user_query = $bdd->connection()->prepare('SELECT * FROM users WHERE email = :email');

                $user_query->execute(array("email" => $email));

                $user = $user_query->fetch(\PDO::FETCH_OBJ);

                return $user;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    private static function checkEmail ($email) {

        global $bdd;

        $match_email = $bdd->connection()->prepare('SELECT email FROM users WHERE email = :email');
        $match_email->execute(array("email" => $email));

        $result_email = $match_email->fetch();

        if (empty($result_email)) {
            return false;
        }
        else {
            return true;
        }
    }

    private static function checkPassword ($email, $password) {

        global $bdd;

        $match_password = $bdd->connection()->prepare('SELECT password FROM users WHERE email = :email');
        $match_password->execute(array("email" => $email));

        $result_password = $match_password->fetch();

        if (password_verify($password, $result_password['password'])) {
            return true;
        }
        else {
            return false;
        }

    }

    public static function logout () {
        session_start();
        if ($_SESSION) {
            session_destroy();
        }
    }
}