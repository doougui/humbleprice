<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\User;

class RegisterController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->setDir("Register");
        $this->setTitle("Crie uma conta | Humbleprice");
        $this->setDescription("Crie sua conta.");
        $this->setKeywords("forum, dev, registro, register");

        $this->renderLayout($this->getData());
    }

    public function signup(): void
    {
        $this->logout(false);

        $user = new User();

        if (
            isset($_POST["name"])
            && isset($_POST["email"])
            && isset($_POST["password"])
        ) {
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

            if (strlen($email) !== 0 && strlen($password) !== 0) {
                if ($user->register($name, $email, $password)) {
                    die(json_encode([]));
                }

                die(
                    json_encode(
                        [
                            "error" => "Usuário já cadastrado. 
                            <a href='".DIRPAGE."login'>Faça seu login.</a>"
                        ]
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