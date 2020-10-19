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
        $this->authenticated()->withPermission("MANAGE_USERS");
    }

    public function index(): void
    {
        $user = new User();
        $role = new Role();

        $this->setDir("UsersPanel");
        $this->setTitle("Painel de usuários | Humbleprice");
        $this->setDescription("Ajuste as permissões dos usuários ou manuseie os mesmos");
        $this->setKeywords("usuarios, painel, panel, permission, action");

        $this->setData("users", $user->getAll(
            [
                "user.name AS name",
                "suspended",
                "email",
                "id_role",
                "role.name AS role",
                "role.label AS role_label"
            ],
            [
                ["role", "INNER"]
            ],
            ["user.id_role = role.id"],
            "ORDER BY id_role DESC, user.id ASC"
        ));
        $this->setData("roles", $role->getAll(["name", "label"]));

        $this->renderLayout($this->getData());
    }

    public function suspend(string $email = null): ?bool
    {
        $user = new User();

        if (empty($email)) {
            $this->redirect(DIRPAGE."userspanel");
        }

        $userId = $user->getId("email", $email);

        if ($userId === $_SESSION["user"] ||
            $user->getInfo(
                $userId, ["id_role"]
            )["id_role"] >= user()["id_role"]
        ) {
            die("Você não pode suspender ou re-ativar uma conta com o nível hierárquico maior ou igual que o seu.");
        }

        if ($user->toggleSuspension($userId)) {
            return true;
        }

        die("Não foi possível suspender este usuário.");
    }
}