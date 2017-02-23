<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Auth\Login;
use App\Models\Auth\Register;
use App\Validation\Validation;

class AuthController extends Controller
{
    public function registerPage () {
        if (isset($_SESSION['is_online'])) {
            $this->redirect("/");
        }
        $this->view('auth.register');
    }

    public function register (array $user_data) {

        $user_data_OK = array(
            "username" => htmlspecialchars($user_data['username']),
            "email" => htmlspecialchars($user_data['email']),
            "password" => htmlspecialchars($user_data['password'])
        );

        $check = Register::registerUser(new Validation(), $user_data_OK);

        if (isset($check["error_name"]) && $check['error_name'] === true) {
            $this->redirect('/register')->withMessage("register_error", "Ce pseudo est déjà utilisé.", "pseudo");

            return;
        }

        if (isset($check["error_email"]) && $check['error_email'] === true) {
            $this->redirect('/register')->withMessage("register_error", "Cette adresse email est déjà utilisée", "email");

            return;
        }

        if (isset($check["error_password"]) && $check['error_password'] === true) {
            $this->redirect('/register')->withMessage("register_error", "Le mot de passe doit respecter les restrictions suivantes: au moins 8 caractères, au moins une majuscule, au moins une minuscule et au moins un chiffre.", "password");

            return;
        }

        $this->redirect('/login')->withMessage("register_success", "Inscription effectuée, veuillez-vous connecter.");
    }

    public function loginPage () {
        if (isset($_SESSION['is_online'])) {
            $this->redirect("/");
        }
        $this->view('auth.login');
    }

    public function login (array $user_data) {

        $user_data_to_check = array(
            "email" => htmlspecialchars($user_data['email']),
            "password" => htmlspecialchars($user_data['password'])
        );

        $user = Login::checkLogin($user_data_to_check);

        if (empty($user)) {
            $this->redirect('/login')->withMessage("login_error", "Un des champs renseigné est invalide.");
        }
        else {
            Login::login($user);

            if (isset($_SESSION['is_online']) && $_SESSION['role'] === "admin") {
                $this->redirect('/admin')->withMessage("login_success", "Vous êtes connecté.", "admin");
                var_dump($_SESSION);
            }
            else if (isset($_SESSION['is_online'])) {
                $this->redirect('/')->withMessage("login_success", "Vous êtes connecté.", "user");

            }
        }
    }

    public function logout () {
        Login::logout();

        $this->redirect('/');
    }
}