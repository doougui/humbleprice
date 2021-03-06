<?php

namespace App\Models;

use App\Core\Table;

class User extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "users";
    }

    public function isSuspended(string $email): bool
    {
        $sql = "SELECT
                    suspended
                FROM
                    {$this->table}
                WHERE
                    email = :email
                AND
                    suspended = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":email", $email, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function login(string $email, string $password): bool
    {
        $sql = "SELECT 
                    id, password
                FROM 
                    {$this->table}
                WHERE 
                    email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":email", $email, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $user = $sql->fetch();

            if (password_verify($password, $user["password"])) {
                $_SESSION["user"] = intval($user["id"]);
                return true;
            }
        }

        return false;
    }

    public function register(
        string $name,
        string $email,
        string $password
    ): bool {
        if ($this->emailExists($email)) {
            return false;
        }

        $sql = "INSERT INTO 
                    {$this->table} 
                    (name, email, password) 
                VALUES 
                    (:name, :email, :password)";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":name", $name, \PDO::PARAM_STR);
        $sql->bindParam(":email", $email, \PDO::PARAM_STR);
        $sql->bindParam(":password", $password, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $userId = $this->db->lastInsertId();

            $sql = "SELECT 
                        id
                    FROM
                        {$this->table}
                    WHERE 
                        id = :user_id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":user_id", $userId);
            $sql->execute();

            $_SESSION["user"] = intval($sql->fetch()["id"]);

            return true;
        }

        return false;
    }

    public function update(array $info): bool
    {
        if ($this->emailExists($info["email"])) {
            return false;
        }

        $password = "";
        if (! empty($info["password"])) {
            $password = ", password = :password";
        }

        $avatar = "";
        if (! empty($info["avatar"])) {
            $avatar = ", avatar = :avatar";
        }

        $sql = "UPDATE 
                    {$this->table} 
                SET 
                    name = :name, 
                    email = :email 
                    {$password} 
                    {$avatar}
                WHERE 
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":name", $info["name"], \PDO::PARAM_STR);
        $sql->bindParam(":email", $info["email"], \PDO::PARAM_STR);
        $sql->bindParam(":id", user()["id"], \PDO::PARAM_INT);

        if (! empty($password)) {
            $sql->bindParam(":password", $info["password"], \PDO::PARAM_STR);
        }

        if (! empty($avatar)) {
            $sql->bindParam(":avatar", $info["avatar"], \PDO::PARAM_STR);
        }

        $sql->execute();

        return true;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM 
                    {$this->table} 
                WHERE 
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id", $id, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function toggleSuspension(int $userId): bool
    {
        $isUserSuspended = $this->getInfo("id", $userId, ["suspended"]);

        $suspended = 1;
        if ($isUserSuspended["suspended"]) {
            $suspended = 0;
        }

        $sql = "UPDATE 
                    {$this->table} 
                SET 
                    suspended = :suspended 
                WHERE 
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":suspended", $suspended, \PDO::PARAM_STR);
        $sql->bindParam(":id", $userId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function hasPermission(int $roleId, string $permission): bool
    {
        $ability = (new Ability())->getId("label", $permission);

        $sql = "SELECT
                    id_ability, id_role
                FROM
                    ability_role
                WHERE
                    id_role = :id_role AND id_ability = :id_ability
                OR
                    id_role = :id_role AND id_ability = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_role", $roleId, \PDO::PARAM_INT);
        $sql->bindParam(":id_ability", $ability, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function assignRole(int $userId, int $roleId): bool
    {
        $sql = "UPDATE
                    {$this->table}
                SET
                    id_role = :id_role
                WHERE
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_role", $roleId, \PDO::PARAM_INT);
        $sql->bindParam(":id", $userId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    private function emailExists(string $email): bool
    {
        if (user() && $email == user()["email"]) {
            return false;
        }

        $sql = "SELECT 
                    id 
                FROM 
                     {$this->table} 
                WHERE 
                    email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":email", $email, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }
}