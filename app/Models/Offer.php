<?php

namespace App\Models;

use App\Core\Table;

class Offer extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'offer';
    }

    public function getLastOffers(
        int $category = null,
        int $subcategory = null,
        string $status = "approved"
    ): array {
        $categoryQuery = "1 = 1";
        if (! empty($category)) {
            $categoryQuery = "id_category = :category";
        }

        $subcategoryQuery = "2 = 2";
        if (! empty($subcategory)) {
            $subcategoryQuery = "id_subcategory = :subcategory";
        }

        $sql = "SELECT 
                    * 
                FROM 
                    {$this->table} 
                WHERE 
                    (end_offer >= NOW() OR end_offer is null)
                AND
                    status = :status
                AND 
                      {$categoryQuery}
                AND
                      {$subcategoryQuery}
                ORDER BY 
                    end_offer 
                ASC";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":status", $status, \PDO::PARAM_STR);

        if (! empty($category)) {
            $sql->bindParam(":category", $category, \PDO::PARAM_INT);
        }

        if (! empty($subcategory)) {
            $sql->bindParam(":subcategory", $subcategory, \PDO::PARAM_INT);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }

        return [];
    }

    public function registerOffer(array $info): bool {
        $sql = "INSERT INTO 
                    {$this->table} 
                    (id_category, id_subcategory, slug, link, name, old_price, new_price, end_offer , image) 
                VALUES 
                    (:category, :subcategory, :slug, :link, :name, :oldPrice, :newPrice, :endOffer, :picture)";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":category", $info["categoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":subcategory", $info["subcategoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":slug", $info["slug"], \PDO::PARAM_STR);
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

    public function updateStatus(int $offerId, string $status): bool
    {
        $sql = "UPDATE 
                    offer 
                SET 
                    status = :status 
                WHERE 
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":status", $status, \PDO::PARAM_STR);
        $sql->bindParam(":id", $offerId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function deleteOffer(int $id): bool
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
}