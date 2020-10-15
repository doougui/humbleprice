<?php

namespace App\Models;

class Table extends Connection
{
    protected string $table;

    public function getAll(array $fields): array
    {
        $fields = implode(", ", $fields);

        $sql = "SELECT
                    $fields
                FROM
                    {$this->table}";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }

        return [];
    }

    public function getId(
        string $column,
        string $value,
        string $table = null
    ): ?int {
        $table = ($table) ?? $this->table;

        $sql = "SELECT
                    id
                FROM
                    {$table}
                WHERE
                    {$column} = :{$column}";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":{$column}", $value, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch()['id'];
        }

        return null;
    }

    public function getInfo(int $id, array $fields): array
    {
        $fields = implode(", ", $fields);

        $sql = "SELECT 
                    $fields
                FROM 
                     {$this->table} WHERE 
                id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id", $id, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        } else {
            return [];
        }
    }

    public function isChildOf(int $childId, int $parentId, string $table): bool
    {
        $sql = "SELECT
                    id
                FROM 
                    {$this->table}
                WHERE 
                    id = :childId
                AND
                    id_{$table} = :parentId";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":childId", $childId, \PDO::PARAM_INT);
        $sql->bindParam(":parentId", $parentId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }
}