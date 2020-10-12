<?php

namespace App\Models;

class Offer extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'offer';
    }

    public function getLastOffers(string $filter = ""): array
    {
        $filterString = "1 = 1";
        if (! empty($filter)) {
            $filterString = "platform = :filter";
        }

        $sql = "SELECT 
                    * 
                FROM 
                    {$this->table} 
                WHERE 
                    end_offer >= NOW() AND ".$filterString." ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":filter", $filter, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }

        return [];
    }

    public function registerOffer(array $info): bool {
        $sql = "INSERT INTO {$this->table} 
                    (id_category, id_subcategory, link, name, old_price, new_price, end_offer , image) VALUES 
                    (:category, :subcategory, :link, :name, :oldPrice, :newPrice, :endOffer, :picture)";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":category", $info["categoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":subcategory", $info["subcategoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":link", $info["link"], \PDO::PARAM_STR);
        $sql->bindParam(":name", $info["name"], \PDO::PARAM_STR);
        $sql->bindParam(":oldPrice", $info["oldPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":newPrice", $info["newPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":picture", $info["picture"], \PDO::PARAM_STR);
        $sql->bindParam(":endOffer", $info["endOffer"], \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function deleteOffer(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id", $id, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }
}