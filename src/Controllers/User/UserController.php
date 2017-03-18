<?php

namespace App\Controllers\User;


use App\Helpers\Helpers;
use App\Models\Auth\Login;
use App\Models\User;

class UserController
{
    use Helpers;

    public function modify_infos ($data) {

        if (isset($_SESSION['is_online'])) {

            //var_dump(!empty($data['email'])); die;

            if (!empty($data['email']) && $data['email'] === $_SESSION['email']) {
                //var_dump("ejnfdsf");

                if (!empty($data['old-password']) && !empty($data['new-password']) && !empty($data['c-new-password'])) {
                    //var_dump("gggggg"); die;

                    $old_password = htmlentities($data['old-password']);
                    $new_password = htmlentities($data['new-password']);
                    $c_new_password = htmlentities($data['c-new-password']);

                    $modify_password = $this->modify_password($old_password, $new_password, $c_new_password);

                    if ($modify_password) {
                        $this->redirect("/")->withMessage("account", "Les informations ont bien été prises en compte.", "success_password");
                    }
                    else {
                        $this->redirect("/user/" . $_SESSION['user_id'] . "/account")->withMessage("account", "Les champs de mots de passe doivent être renseignés et correspondre aux restrictions.", "error_password");
                    }
                }
                else {
                    $this->redirect("/user/" . $_SESSION['user_id'] . "/account");
                }
            }
            else if (!empty($data['email']) && $data['email'] != $_SESSION['email']) {
                $email = $data['email'];
                $user = new User($_SESSION['user_id']);
                $user->setEmail($email);

                $_SESSION['email'] = $email;

                if (!empty($data['old-password']) && !empty($data['new-password']) && !empty($data['c-new-password'])) {
                    //var_dump("gggggg"); die;

                    $old_password = htmlentities($data['old-password']);
                    $new_password = htmlentities($data['new-password']);
                    $c_new_password = htmlentities($data['c-new-password']);

                    $modify_password = $this->modify_password($old_password, $new_password, $c_new_password);

                    if ($modify_password) {
                        $this->redirect("/")->withMessage("account", "Les informations ont bien été prises en compte.", "success_password");
                    } else {
                        $this->redirect("/user/" . $_SESSION['user_id'] . "/account")->withMessage("account", "Les champs de mots de passe doivent être renseignés et correspondre aux restrictions.", "error_password");
                    }
                }
                else {
                    $this->redirect("/user/" . $_SESSION['user_id'] . "/account")->withMessage("account", "Les informations ont bien été prises en compte.", "success_email");
                }
            }
            else {
                $this->redirect("/user/" . $_SESSION['user_id'] . "/account")->withMessage("account", "Le champ email ne peut pas être vide.", "error_email");
            }
        }
    }

    private function modify_password ($old_password, $new_password, $c_new_password) {
        $user = new User($_SESSION['user_id']);
        $compare = $user->comparePassword($old_password);

        if ($compare) {
            if ($user->setPassword(array("new-password" => $new_password, "c-new-password" => $c_new_password))) {
                return true;
            }
        }

        return false;
    }
}