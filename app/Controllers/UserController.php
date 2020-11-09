<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\User;

class UserController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->redirect(DIRPAGE);
    }

    public function edit(): void
    {
        $this->authRequired();

        $user = new User();

        $this->setDir('EditUser');
        $this->setTitle('Edite seu perfil | Humbleprice');
        $this->setDescription('Aqui você pode editar todas as informações do seu perfil de usuário.');
        $this->setKeywords('offer, profile, editar, perfil');

        $this->setData("user", $user->getInfo("id", user()["id"],
                ["name", "email", "avatar"]
            )
        );

        $this->renderLayout($this->getData());
    }

    public function update(): void
    {
        $this->authRequired();

        if (! $this->isAjax()) {
            $this->redirect(DIRPAGE);
        }

        $user = new User();

        if (isset($_POST["name"]) && isset($_POST["email"])) {
            $name = filter_input(
                INPUT_POST,
                "name",
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $email = filter_input(
                INPUT_POST,
                "email",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            if (! empty($_FILES["avatar"]["size"])) {
                $avatar = $_FILES["avatar"];
            }

            if (
                isset($_POST["password"])
                && isset($_POST["password-confirmation"])
            ) {
                $password = filter_input(
                    INPUT_POST,
                    "password",
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
                $passwordConfirmation = filter_input(
                    INPUT_POST,
                    "password-confirmation",
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }

            if (strlen($name) !== 0 && strlen($email) !== 0) {
                if (isset($password)
                    && strlen($password) !== 0
                ) {
                    if (
                        isset($passwordConfirmation)
                        && strlen($passwordConfirmation) !== 0
                    ) {
                        if ($password !== $passwordConfirmation) {
                            die(
                                json_encode(
                                    ["error" => "As senhas não são compatíveis"]
                                )
                            );
                        }

                        $password = password_hash($password, PASSWORD_DEFAULT);
                    } else {
                        die(
                            json_encode(
                                ["error" => "Repita a senha para continuar."]
                            )
                        );
                    }
                } else {
                    $password = null;
                }

                if (isset($avatar)) {
                    $imageName = $this->treatImage($avatar, "users");
                }

                $info = [
                    "name" => $name,
                    "email" => $email,
                    "password" => $password, PASSWORD_DEFAULT
                ];

                if (isset($imageName)) {
                    $info["avatar"] = $imageName;
                }

                if ($user->update($info)) {
                    die(json_encode([]));
                }

                die(
                    json_encode(
                        [
                            "error" => "Este email já esta em uso."
                        ]
                    )
                );
            }
        }

        die(
            json_encode(
                [
                    "error" => "Preencha todos os campos para continuar"
                ]
            )
        );
    }

    public function suspended(string $email = null): void
    {
        $this->authRequired();

        $loggedEmail = user()["email"];

        if ($email !== $loggedEmail) {
            $this->redirect(DIRPAGE."user/suspended/{$loggedEmail}");
        }

        $this->setDir('Suspended');
        $this->setTitle('Perfil suspenso | Humbleprice');
        $this->setDescription('Este perfil foi suspenso. Se você acha que isto foi um erro, entre em contato com nossa equipe de administração..');
        $this->setKeywords('suspended, profile, user, perfil');

        $this->renderLayout($this->getData());
    }
}