<?php

namespace App\Models\Auth;


class Login
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function login ($user_data) {

        $_SESSION['is_online'] = true;
        $_SESSION['user_id'] = $user_data->id;
        $_SESSION['name'] = $user_data->username;
        $_SESSION['email'] = $user_data->email;

        if ($user_data->role === "admin") {
            $_SESSION['role'] = "admin";
        }
        else {
            $_SESSION['role'] = $user_data->role;
        }
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

    public static function checkEmail ($email) {

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

    public static function sendTempPassword ($email) {
        $temp_password = self::createTempPassword();

        $transport = \Swift_SmtpTransport::newInstance('localhost', 1025);

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject("Votre demande de mot de passe.")
            ->setFrom(array("test@mail.com" => "Test TEST"))
            ->setTo(array($email => "Name"))
            ->setBody("Vous avez fait une demande de nouveau mot de passe sur le site jean-forteroche.fr. Veuillez trouver ci-dessous un mot de passe temporaire pour vous connecter au site.<br> Vous pourrez ensuite le changer dans votre profil utilisateur.<br> Mot de passe temporaire: <strong>$temp_password</strong>")
        ;

        $mailer->send($message);

        self::changeUserPassword($temp_password, $email);

        return true;
    }

    private static function createTempPassword () {
        $alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $letter = substr(str_shuffle($alpha), 0, 1);

        $bytes = random_bytes(6);
        $temp_password = $letter . bin2hex($bytes);

        return $temp_password;
    }

    private static function changeUserPassword ($password, $email) {
        global $bdd;

        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = $bdd->connection()->prepare("UPDATE users SET password = :password WHERE email = :email");
        $query->execute(array(
            "password" => $password,
            "email" => $email
        ));
    }

    public static function logout () {
        if (isset($_SESSION) ) {
            session_destroy();
        }
    }
}