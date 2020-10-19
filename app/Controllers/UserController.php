<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\User;

class UserController extends Authorization
{
    public function index(): void
    {
        $this->redirect(DIRPAGE);
    }

    public function edit(int $id = null): void
    {
        $user = new User();

        if (empty($id) ||
            ! isset($_SESSION['user'])
            || $id !== $_SESSION['user']['id']
        ) {
            $this->redirect(DIRPAGE);
        }

        $this->setDir('EditUser');
        $this->setTitle('Forum - Editar perfil');
        $this->setDescription('Edite seu perfil.');
        $this->setKeywords('forum, dev, editar perfil, perfil');

        $this->setData("user", $user->getInfo($id, ["name", "email"]));

        $this->renderLayout($this->getData());
    }

    public function editUser(): ?bool
    {
        $user = new User();

        if (isset($_POST['id']) && ! empty($_POST['id']) &&
            isset($_POST['name']) && ! empty($_POST['name']) &&
            isset($_POST['email']) && ! empty($_POST['email'])
        ) {
            if (filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) {
                $email = filter_input(
                    INPUT_POST,
                    'email',
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            } else {
                die("Insira um e-mail válido para continuar.");
            }

            $id = filter_input(
                INPUT_POST,
                'id',
                FILTER_SANITIZE_SPECIAL_CHARS
            );
            $name = filter_input(
                INPUT_POST,
                'name',
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            if (isset($_POST['password']) && ! empty($_POST['password'])) {
                $password = password_hash(
                    filter_input(
                        INPUT_POST,
                        'password',
                        FILTER_SANITIZE_SPECIAL_CHARS
                    ),
                    PASSWORD_DEFAULT
                );
            } else {
                $password = '';
            }

            if ($user->editUser($id, $name, $email, $password)) {
                return true;
            } else {
                die("Não foi possível atualizar as informações.");
            }
        } else {
            die("Todos os campos devem estar preenchidos.");
        }
    }

    public function deleteUser(): ?bool
    {
        $user = new User();

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

            if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $id) {
                if ($user->deleteUser($id)) {
                    return true;
                } else {
                    echo "Não foi possível deletar sua conta.";
                }
            }
        } else {
            echo "Preencha todos os campos para continuar.";
        }
    }

    public function suspended(string $email = null): void
    {
        $loggedEmail = user()["email"];

        if ($email !== $loggedEmail) {
            $this->redirect(DIRPAGE."user/suspended/{$loggedEmail}");
        }
    }
}