<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\User;

class LoginController extends Authorization
{
    public function index(): void
    {
        $this->logout();

        $this->setDir("Login");
        $this->setTitle("Entre na sua conta | Humbleprice");
        $this->setDescription("Entre na sua conta.");
        $this->setKeywords("forum, dev, entrar, login");

        $this->renderLayout($this->getData());
    }

    public function signin(): ?bool
    {
        $this->logout(false);

        $user = new User();

        if (isset($_POST["email"]) && isset($_POST["password"])) {
            if (filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)) {
                $email = filter_input(
                    INPUT_POST,
                    "email",
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            } else {
                die("Insira um e-mail válido para continuar.");
            }

            $password = filter_input(
                INPUT_POST,
                "password",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            if (! empty($email) && ! empty($password)) {
                if ($user->login($email, $password)) {
                    return true;
                }

                die("Usuário e/ou senha incorretos.");
            }

            die("Preencha todos os campos para continuar.");
        }

        die("Preencha todos os campos para continuar.");
    }
}