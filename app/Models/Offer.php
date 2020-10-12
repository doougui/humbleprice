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

    public function registerOffer(array $data): bool {
        $sql = "INSERT INTO {$this->table} 
                            (id_category, id_subcategory, link, name, old_price, new_price, end_offer , image) VALUES 
                            (:category, :subcategory, :link, :name, :oldPrice, :newPrice, :endOffer, :tmpname)";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":category", $data["categoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":subcategory", $data["subcategoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":link", $data["link"], \PDO::PARAM_STR);
        $sql->bindParam(":name", $data["name"], \PDO::PARAM_STR);
        $sql->bindParam(":oldPrice", $data["oldPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":newPrice", $data["newPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":tmpname", $data["tmpname"], \PDO::PARAM_STR);
        $sql->bindParam(":endOffer", $data["endOffer"], \PDO::PARAM_STR);
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