<?php

namespace App\Models;

use App\Core\Table;

class Role extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "roles";
    }

    public function getAbilities(int $roleId): array
    {
        $sql = "SELECT
                    abilities.id,
                    abilities.label,
                    abilities.name
                FROM
                    ability_role
                INNER JOIN
                    abilities
                ON
                    ability_role.id_ability = abilities.id
                WHERE
                    ability_role.id_role = :id_role
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_role", $roleId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }

        return [];
    }

    public function togglePermission(int $roleId, int $abilityId): bool
    {
        if ($this->roleAlreadyHaveAbility($roleId, $abilityId)) {
            if ($this->removeAbilityFromRole($roleId, $abilityId)) {
                return true;
            }

            return false;
        }

        $sql = "INSERT INTO 
                    ability_role 
                    (id_ability, id_role)
                VALUES
                    (:id_ability, :id_role)";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_ability", $abilityId, \PDO::PARAM_INT);
        $sql->bindParam(":id_role", $roleId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    private function roleAlreadyHaveAbility(int $roleId, int $abilityId): bool
    {
        $sql = "SELECT
                    count(id_role) AS amount
                FROM
                    ability_role
                WHERE
                    id_role = :id_role
                AND
                    id_ability = :id_ability
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_role", $roleId, \PDO::PARAM_INT);
        $sql->bindParam(":id_ability", $abilityId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $amount = $sql->fetch()["amount"];

            if ($amount > 0) {
                return true;
            }
        }

        return false;
    }

    private function removeAbilityFromRole(int $roleId, int $abilityId): bool
    {
        $sql = "DELETE FROM
                    ability_role
                WHERE
                    id_ability = :id_ability
                AND
                    id_role = :id_role";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_ability", $abilityId, \PDO::PARAM_INT);
        $sql->bindParam(":id_role", $roleId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }
}