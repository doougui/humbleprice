<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function index(): void
    {
        unset($_SESSION["user"]);

        $this->setDir("Login");
        $this->setTitle("Entre na sua conta | Humbleprice");
        $this->setDescription("Entre na sua conta.");
        $this->setKeywords("forum, dev, entrar, login");

        $this->renderLayout($this->getData());
    }

    public function signin(): ?bool
    {
        unset($_SESSION["user"]);

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
                } else {
                    die("Usuário e/ou senha incorretos.");
                }
            } else {
                die("Preencha todos os campos para continuar.");
            }
        } else {
            die("Preencha todos os campos para continuar.");
        }
    }

    public function logout() {
        unset($_SESSION["user"]);
        header("Location: ".DIRPAGE."login");
    }
}