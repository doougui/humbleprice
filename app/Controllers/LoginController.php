<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\User;

class LoginController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->logout();

        $this->setDir("Login");
        $this->setTitle("Entre na sua conta | Humbleprice");
        $this->setDescription("Entre na sua conta.");
        $this->setKeywords("entrar, login");

        $this->renderLayout($this->getData());
    }

    public function signin(): void
    {
        if (! $this->isAjax()) {
            $this->redirect(DIRPAGE);
        }

        $user = new User();

        $this->logout(false);

        if (isset($_POST["email"]) && isset($_POST["password"])) {
            if (filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)) {
                $email = filter_input(
                    INPUT_POST,
                    "email",
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            } else {
                die(
                    json_encode(
                        ["error" => "Insira um e-mail válido para continuar."]
                    )
                );
            }

            $password = filter_input(
                INPUT_POST,
                "password",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            if (strlen($email) !== 0 && strlen($password) !== 0) {
                if ($user->login($email, $password)) {
                    die(json_encode([]));
                }

                die(
                    json_encode(
                        ["error" => "Usuário e/ou senha incorretos."]
                    )
                );
            }
        }

        die(
            json_encode(
                ["error" => "Preencha todos os campos para continuar."]
            )
        );
    }
}