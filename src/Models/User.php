<?php

namespace App\Models;


class User
{
    private $id;
    private $name;
    private $email;

    public function __construct($id, $name = '', $email = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getEmail () {
        if ($this->email === '') {
            global $bdd;

            $query = $bdd->connection()->prepare('SELECT email from users WHERE id = :id');
            $query->execute(array("id" => $this->id));

            $email = $query->fetch(\PDO::FETCH_OBJ);

            return $email;
        }

        return $this->email;
    }

    public function setEmail ($value) {
        global $bdd;

        $regexp = '/^(\s*|[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})$/';

        if (preg_match($regexp, $value)) {
            $query = $bdd->connection()->prepare('UPDATE users SET email = :email WHERE id = :id');
            $query->execute(array(
                "email" => $value,
                "id" => $this->id
            ));

            return true;
        }
        else {
            return false;
        }

    }

    public function comparePassword ($password) {
        $old_password = $this->getPassword($this->id);

        if (password_verify($password, $old_password->password)) {
            return true;
        }
        else {
            return false;
        }
    }

    private function getPassword ($id) {
        global $bdd;

        $query = $bdd->connection()->prepare("SELECT password FROM users WHERE id = :id");
        $query->execute(array("id" => $id));

        $password = $query->fetch(\PDO::FETCH_OBJ);

        return $password;
    }

    public function setPassword ($data) {
        global $bdd;
        var_dump($data);
        var_dump($this->checkIfNewPasswordFit($data['new-password'], $data['c-new-password']));
        if ($this->checkIfNewPasswordFit($data['new-password'], $data['c-new-password'])) {
            var_dump("coucou");

            $password = $this->hash_password($data['new-password']);

            $query = $bdd->connection()->prepare("UPDATE users SET password = :password WHERE id = :id");
            $query->execute(array(
                "password" => $password,
                "id" => $this->id
            ));
            return true;
        }
    }

    private function checkIfNewPasswordFit ($password, $c_password) {
        $regexp = '/^((?=\S*?[A-Z])(?=\S*?[a-éz])(?=\S*?[0-9]).{7,})\S$/';

        if (preg_match($regexp, $password) == 1 && $password == $c_password) {
            var_dump("cou");
            return true;
        }
        else {

            return false;
        }
    }

    private function hash_password (string $password_brut) {
        return password_hash($password_brut, PASSWORD_BCRYPT);
    }
}