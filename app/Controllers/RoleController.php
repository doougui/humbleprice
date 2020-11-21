<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Ability;
use App\Models\Role;
use App\Models\User;

class RoleController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authRequired()->withPermission("MANAGE_PERMISSIONS");
    }

    public function index(): void
    {
        $role = new Role();

        $this->setDir("Role");
        $this->setTitle("Painel de permissões | Humbleprice");
        $this->setDescription("Ajuste as permissões dos cargos");
        $this->setKeywords("usuarios, painel, panel, permission, cargo, role");

        $perPage = 10;
        $pagination = paginate($role, $perPage);

        $roles = $role->getAll(["id", "name", "label"], null, null, "id DESC");

        $this->setData("roles", $roles);

        $this->setData("totalPages", $pagination["totalPages"]);
        $this->setData("currentPage", $pagination["currentPage"]);

        $this->renderLayout($this->getData());
    }

    public function edit(string $label): void
    {
        $role = new Role();
        $ability = new Ability();

        if (
            empty($label)
            || ! $roleId = $role->getId("label", $label)
        ) {
            $this->redirect(DIRPAGE."role");
        }

        $roleData = $role->getInfo("id", $roleId, ["id", "label", "name"]);

        if ($roleData["id"] >= user()["id_role"]) {
            $this->redirect(DIRPAGE."role");
        }

        $this->setDir("EditRole");
        $this->setTitle("Editando cargo {$roleData['name']} | Humbleprice");
        $this->setDescription("Ajuste as permissões do cargo {$roleData['name']}");
        $this->setKeywords("usuarios, painel, panel, permission, cargo, role");

        $allAbilities = $ability->getAll(["id", "label", "name"]);
        $roleAbilities = $role->getAbilities($roleId);

        $this->setData("role", $roleData);
        $this->setData("allAbilities", $allAbilities);
        $this->setData("roleAbilities", $roleAbilities);

        $this->setData("hasAllPermissions", $this->hasPermission("ALL"));

        $this->renderLayout($this->getData());
    }

    public function allow(
        string $roleLabel = null,
        string $abilityLabel = null
    ): void {
        $role = new Role();
        $ability = new Ability();

        if (! $this->isAjax()) {
            $this->redirect(DIRPAGE);
        }

        if (
            empty($roleLabel)
            || ! $roleId = $role->getId("label", $roleLabel)
        ) {
            die(
                json_encode(["error" => "Informe um cargo válido."])
            );
        }

        if (
            empty($abilityLabel)
            || ! $abilityId = $ability->getId("label", $abilityLabel)
        ) {
            die(
                json_encode(["error" => "Informe uma habilidade válido."])
            );
        }

        $abilityData = $ability->getInfo(
            "id",
            $abilityId,
            ["id", "label", "name"]
        );

        $hasAllPermissions = $this->hasPermission("ALL");
        $roleData = $role->getInfo("id", $roleId, ["id", "label", "name"]);

        if ($roleData["id"] >= user()["id_role"]) {
            die(
                json_encode(["error" => "Você não tem permissão para realizar esta ação."])
            );
        }

        if (
            ! $hasAllPermissions
            && ! $this->hasPermission($abilityData["label"])
        ) {
            die(
                json_encode(["error" => "Você não tem permissão para realizar esta ação."])
            );
        }

        if ($role->togglePermission($roleId, $abilityId)) {
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
}