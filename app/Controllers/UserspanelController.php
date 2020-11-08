<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Role;
use App\Models\User;

class UserspanelController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authRequired()->withPermission("MANAGE_USERS");
    }

    public function index(): void
    {
        $user = new User();
        $role = new Role();

        $this->setDir("UsersPanel");
        $this->setTitle("Painel de usuários | Humbleprice");
        $this->setDescription("Ajuste as permissões dos usuários ou manuseie os mesmos");
        $this->setKeywords("usuarios, painel, panel, permission, action");

        $usersCount = $user->count("1", "1");

        $currentPage = 1;

        if (isset($_GET["page"])) {
            if (
                strlen(filter_input(
                    INPUT_GET,
                    "page",
                    FILTER_SANITIZE_NUMBER_INT
                )) !== 0) {
                $currentPage = filter_input(
                    INPUT_GET,
                    "page",
                    FILTER_SANITIZE_NUMBER_INT
                );
            }
        }

        $perPage = 10;
        $totalPages = ceil($usersCount / $perPage);

        $offset = ($currentPage - 1) * $perPage;

        $this->setData("users", $user->getAll(
            [
                "users.name AS name",
                "suspended",
                "email",
                "id_role",
                "roles.name AS role",
                "roles.label AS role_label"
            ],
            [
                ["roles", "INNER"]
            ],
            ["users.id_role = roles.id"],
            "ORDER BY id_role DESC, users.id ASC",
            $offset,
            $perPage
        ));
        $this->setData("roles", $role->getAll(["id", "name", "label"]));

        $this->setData("totalPages", $totalPages);
        $this->setData("currentPage", $currentPage);

        $this->renderLayout($this->getData());
    }

    public function suspend(string $email = null): void
    {
        $user = new User();

        if (empty($email)) {
            die(
                json_encode(
                    ["error" => "Imforme um email válido."]
                )
            );
        }

        $userId = $user->getId("email", $email);

        if (! $userId) {
            die(
                json_encode(
                    ["error" => "O usuário informado é inválido."]
                )
            );
        }

        if ($userId === $_SESSION["user"] ||
            $user->getInfo(
                "id",
                $userId,
                ["id_role"]
            )["id_role"] >= user()["id_role"]
        ) {
            die(
                json_encode(
                    [
                        "error" => "Você não pode suspender ou re-ativar uma 
                        conta com o nível hierárquico maior ou igual ao seu."
                    ]
                )
            );
        }

        if ($user->toggleSuspension($userId)) {
            die(json_encode([]));
        }

        die(
            json_encode(
                [
                    "error" => "Não foi possível suspender ou re-ativar a conta
                    deste usuário."
                ]
            )
        );
    }

    public function delete(string $email = null): void
    {
        $user = new User();

        if (empty($email)) {
            die(
                json_encode(
                    ["error" => "Imforme um email válido."]
                )
            );
        }

        $userId = $user->getId("email", $email);

        if (! $userId) {
            die(
                json_encode(
                    ["error" => "O usuário informado é inválido."]
                )
            );
        }

        if ($userId === $_SESSION["user"] ||
            $user->getInfo(
                "id",
                $userId,
                ["id_role"]
            )["id_role"] >= user()["id_role"]
        ) {
            die(
                json_encode(
                    [
                        "error" => "Você não pode deletar uma conta com o nível 
                        hierárquico maior ou igual ao seu."
                    ]
                )
            );
        }

        if ($user->delete($userId)) {
            die(json_encode([]));
        }

        die(
            json_encode(
                ["error" => "Não foi possível deletar a conta deste usuário."]
            )
        );
    }

    public function assignRole(
        string $email = null,
        string $roleLabel = null
    ): void {
        $user = new User();
        $role = new Role();

        if (empty($email) || empty($roleLabel)) {
            die(
                json_encode(
                    ["error" => "O email ou o cargo informado são inválidos."]
                )
            );
        }

        $userId = $user->getId("email", $email);

        if (! $userId) {
            die(
                json_encode(
                    ["error" => "O usuário informado é inválido."]
                )
            );
        }

        $roleId = $role->getId("label", $roleLabel);

        if (! $roleId) {
            die(
                json_encode(
                    ["error" => "O cargo informado é inválido."]
                )
            );
        }

        if ($roleId >= user()["id_role"]
            || $user->getInfo(
                "id",
                $userId,
                ["id_role"]
            )["id_role"] >= user()["id_role"]
        ) {
            die(
                json_encode(
                    [
                        "error" => "Você não pode atribuir um cargo maior 
                        ou mudar o cargo de alguém com o nível hierárquico 
                        maior ou igual ao seu."
                    ]
                )
            );
        }

        if ($user->assignRole($userId, $roleId)) {
            die(json_encode([]));
        }

        die(
            json_encode(
                ["error" => "Não foi possível mudar o cargo deste usuário."]
            )
        );
    }
}