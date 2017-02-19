<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Auth\Login;
use App\Models\Auth\Register;

class AuthController extends Controller
{
    public function registerPage () {
        $this->view('auth.register');
    }

    public function register (array $user_data) {

        $password_brut = htmlspecialchars($user_data['password']);

        $user_data_OK = array(
            "username" => htmlspecialchars($user_data['username']),
            "email" => htmlspecialchars($user_data['email']),
            "password" => password_hash($password_brut, PASSWORD_BCRYPT)
        );

        $check = Register::registerUser($user_data_OK);

        if ($check["error_name"] === true) {
            $this->redirect('/register')->withMessage("register_error", "Ce pseudo est déjà utilisé.", "pseudo");
        }
        elseif ($check["error_email"] === true) {
            $this->redirect('/register')->withMessage("register_error", "Cette adresse email est déjà utilisée", "email");
        }
        else {
            $this->redirect('/login')->withMessage("register_success", "Inscription effectuée, veuillez-vous connecter.");
        }
    }

    public function loginPage () {
        $this->view('auth.login');
    }

    public function login (array $user_data) {

        $password = htmlspecialchars($user_data['password']);

        $user_data_to_check = array(
            "email" => htmlspecialchars($user_data['email']),
            "password" => $password
        );

        $user = Login::checkLogin($user_data_to_check);

        //var_dump($check);

        if (empty($user)) {
            $this->redirect('/login')->withMessage("login_error", "Un des champs renseigné est invalide.");
        }
        else {
            Login::login($user);

            $this->redirect('/')->withMessage("login_success", "Vous êtes connecté.");
        }
    }

    public function logout () {
        Login::logout();

        $this->redirect('/');
    }
}