<?php

namespace App\Controllers;

use App\Core\Authorization;
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

        $this->setDir("UsersPanel");
        $this->setTitle("Painel de usuários | Humbleprice");
        $this->setDescription("Ajuste as permissões dos usuários ou manuseie os mesmos");
        $this->setKeywords("usuarios, painel, panel, permission, action");

        $this->setData("users", $user->getAll(
            ["user.name AS name", "email", "role.name AS role"],
            [
                ["role", "INNER"]
            ],
            ["user.id_role = role.id", "user.id_offer = offer.id"]
        ));

        $this->renderLayout($this->getData());
    }
}