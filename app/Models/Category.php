<?php

namespace App\Models;

use App\Core\Table;

class Category extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "categories";
    }

    public function subcategories(int $categoryId): array
    {
        $sql = "SELECT
                    id, id_category, slug, name
                FROM
                    subcategories
                WHERE 
                    id_category = :id_category";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_category", $categoryId, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }

        return [];
    }
}