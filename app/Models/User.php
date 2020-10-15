<?php

namespace App\Models;

class User extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "user";
    }

    public function login(string $email, string $password): bool
    {
        $sql = "SELECT 
                    id, password
                FROM 
                    user
                WHERE 
                    email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":email", $email, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $user = $sql->fetch();

            if (password_verify($password, $user["password"])) {
                $_SESSION["user"] = $user["id"];
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
                    user 
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
                        user
                    WHERE 
                        id = :user_id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":user_id", $userId);
            $sql->execute();

            $_SESSION["user"] = $sql->fetch()["id"];

            return true;
        }

        return false;
    }

    public function editUser(
        int $id,
        string $name,
        string $email,
        string $password
    ): bool {
        $pass = "";
        if (! empty($password)) {
            $pass = ", password = :password";
        }

        $sql = "UPDATE 
                    user 
                SET 
                    name = :name, 
                    email = :email 
                    {$pass} 
                WHERE 
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":name", $name, \PDO::PARAM_STR);
        $sql->bindParam(":email", $email, \PDO::PARAM_STR);
        $sql->bindParam(":id", $id, \PDO::PARAM_INT);

        if (!empty($password)) {
            $sql->bindParam(":password", $password, \PDO::PARAM_STR);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function deleteUser(int $id): bool
    {
        $sql = "DELETE FROM 
                    user 
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

    public function hasPermission()
    {
        
    }

    private function emailExists(string $email): bool
    {
        $sql = "SELECT id FROM user 
							WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":email", $email, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }
}