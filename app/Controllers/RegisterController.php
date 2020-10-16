<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(): void
    {
        $this->setDir("Register");
        $this->setTitle("Crie uma conta | Humbleprice");
        $this->setDescription("Crie sua conta.");
        $this->setKeywords("forum, dev, registro, register");

        $this->renderLayout($this->getData());
    }

    public function signup(): ?bool
    {
        unset($_SESSION["user"]);

        $user = new User();

        if (isset($_POST["name"]) && !empty($_POST["name"]) &&
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["password"]) && !empty($_POST["password"])
        ) {
            if (filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)) {
                $email = filter_input(
                    INPUT_POST,
                    "email",
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            } else {
                die("Insira um e-mail válido para continuar.");
            }

            $name = filter_input(
                INPUT_POST,
                "name",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $password = password_hash(
                filter_input(
                    INPUT_POST,
                    "password",
                    FILTER_SANITIZE_SPECIAL_CHARS
                ),
                PASSWORD_DEFAULT
            );

            if ($user->register($name, $email, $password)) {
                return true;
            } else {
                die("Usuário já cadastrado. <a href='".DIRPAGE."login'>Faça seu login.</a>");
            }
        } else {
            die("Preencha todos os campos para continuar.");
        }
    }
}