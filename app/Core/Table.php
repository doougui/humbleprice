<?php

namespace App\Core;

class Table extends Connection
{
    protected string $table;

    public function getAll(
        array $fields,
        array $joins = null,
        array $on = null,
        string $orderBy = null
    ): array {
        $fields = implode(", ", $fields);

        $joinQuery = "";

        if (! empty($joins)) {
            foreach ($joins as $key => $join) {
                $joinQuery .=
                    "{$join[1]} JOIN
                        $join[0]
                    ON
                        {$on[$key]}
                    ";
            }
        }

        $sql = "SELECT
                    $fields
                FROM
                    {$this->table}
                {$joinQuery}
                {$orderBy}";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }

        return [];
    }

    public function getId(
        string $byColumn,
        string $value,
        string $table = null
    ): ?int {
        $table = ($table) ?? $this->table;

        $sql = "SELECT
                    id
                FROM
                    {$table}
                WHERE
                    {$byColumn} = :{$byColumn}";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":{$byColumn}", $value, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch()['id'];
        }

        return null;
    }

    public function getInfo(
        string $byColumn,
        string $value,
        array $fields,
        array $joins = null,
        array $on = null
    ): array {
        $fields = implode(", ", $fields);

        $joinQuery = "";

        if (! empty($joins)) {
            foreach ($joins as $key => $join) {
                $joinQuery .=
                    "{$join[1]} JOIN
                        $join[0]
                    ON
                        {$on[$key]}
                    ";
            }
        }

        $sql = "SELECT 
                    $fields
                FROM 
                    {$this->table} 
                {$joinQuery}
                WHERE 
                    {$this->table}.{$byColumn} = :{$byColumn}";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":{$byColumn}", $value, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }

        return [];
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