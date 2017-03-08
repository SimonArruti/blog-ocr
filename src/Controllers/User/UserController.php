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

            if (isset($data['email'])) {
                $email = $data['email'];
                $user = new User($_SESSION['user_id']);
                $user->setEmail($email);

                $_SESSION['email'] = $email;
            }

            if (isset($data['old-password']) && isset($data['new-password']) && isset($data['c-new-password'])) {

                $old_password = htmlentities($data['old-password']);
                $new_password = htmlentities($data['new-password']);
                $c_new_password = htmlentities($data['c-new-password']);

                $modify_password = $this->modify_password($old_password, $new_password, $c_new_password);

                if ($modify_password) {
                    Login::logout();

                    $this->redirect("/");
                }
                else {
                    $this->redirect("/user/" . $_SESSION['user_id'] . "/account");
                }

            }
            else {
                $this->redirect("/user/" . $_SESSION['user_id'] . "/account");
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