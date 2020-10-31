<?php

namespace App\Models;

use App\Core\Table;

class Offer extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "offers";
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
                AND
                      status != 'closed'
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

    public function store(array $info): bool {
        $sql = "INSERT INTO 
                    {$this->table} 
                    (id_author, id_category, id_subcategory, slug, link, name, additional_info, old_price, new_price, end_offer , image, status) 
                VALUES 
                    (:id_author, :id_category, :id_subcategory, :slug, :link, :name, :additional_info, :old_price, :new_price, :end_offer, :picture, :status)";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_author", user()["id"], \PDO::PARAM_INT);
        $sql->bindParam(":id_category", $info["categoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":id_subcategory", $info["subcategoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":slug", $info["slug"], \PDO::PARAM_STR);
        $sql->bindParam(":link", $info["link"], \PDO::PARAM_STR);
        $sql->bindParam(":name", $info["name"], \PDO::PARAM_STR);
        $sql->bindParam(":additional_info", $info["additionalInfo"], \PDO::PARAM_STR);
        $sql->bindParam(":old_price", $info["oldPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":new_price", $info["newPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":picture", $info["picture"], \PDO::PARAM_STR);
        $sql->bindParam(":end_offer", $info["endOffer"], \PDO::PARAM_STR);
        $sql->bindParam(":status", $info["status"], \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function update(array $info): bool {
        $sql = "UPDATE
                    {$this->table}
                SET
                    id_category = :id_category,
                    id_subcategory = :id_subcategory,
                    slug = :slug,
                    link = :link,
                    name = :name,
                    additional_info = :additional_info,
                    old_price = :old_price,
                    new_price = :new_price,
                    ".(isset($info['picture']) ? "image = :picture," : "")."
                    end_offer = :end_offer
                WHERE
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_category", $info["categoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":id_subcategory", $info["subcategoryId"], \PDO::PARAM_INT);
        $sql->bindParam(":slug", $info["slug"], \PDO::PARAM_STR);
        $sql->bindParam(":link", $info["link"], \PDO::PARAM_STR);
        $sql->bindParam(":name", $info["name"], \PDO::PARAM_STR);
        $sql->bindParam(":additional_info", $info["additionalInfo"], \PDO::PARAM_STR);
        $sql->bindParam(":old_price", $info["oldPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":new_price", $info["newPrice"], \PDO::PARAM_INT);
        $sql->bindParam(":end_offer", $info["endOffer"], \PDO::PARAM_STR);
        $sql->bindParam(":id", $info["offerId"], \PDO::PARAM_STR);

        if (isset($info["picture"])) {
            $sql->bindParam(":picture", $info["picture"], \PDO::PARAM_STR);
        }

        try {
            $sql->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateStatus(int $offerId, string $status): bool
    {
        $sql = "UPDATE 
                    {$this->table} 
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

    public function getRelatedOffers(int $offerId): array
    {
        $sql = "SELECT 
                    id_category, 
                    id_subcategory
                FROM
                    {$this->table}
                WHERE
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id", $offerId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $offer = $sql->fetch();

            $sql = "SELECT
                        slug, name, old_price, new_price, image
                    FROM
                        {$this->table}
                    WHERE
                        (end_offer >= NOW() OR end_offer is null)
                    AND
                        id_category = :id_category
                    AND
                        id_subcategory = :id_subcategory
                    AND
                        status = 'approved'
                    AND
                        id != :id
                    LIMIT
                        3";
            $sql = $this->db->prepare($sql);
            $sql->bindParam(":id_category", $offer["id_category"], \PDO::PARAM_INT);
            $sql->bindParam(":id_subcategory", $offer["id_subcategory"], \PDO::PARAM_INT);
            $sql->bindParam(":id", $offerId, \PDO::PARAM_INT);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return $sql->fetchAll();
            }
        }

        return [];
    }

    public function incrementViews(int $offerId): bool
    {
        $sql = "UPDATE
                    {$this->table}
                SET
                    views = views + 1
                WHERE
                    id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id", $offerId, \PDO::PARAM_INT);

        try {
            $sql->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}