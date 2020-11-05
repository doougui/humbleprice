<?php

namespace App\Models;

use App\Core\Table;

class Report extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "reports";
    }

    public function create(int $offerId, int $reasonId): bool
    {
        $sql = "INSERT INTO
                    {$this->table}
                    (id_author, id_offer, id_reason)
                VALUES
                    (:id_author, :id_offer, :id_reason)
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_author", user()["id"], \PDO::PARAM_INT);
        $sql->bindParam(":id_offer", $offerId, \PDO::PARAM_INT);
        $sql->bindParam(":id_reason", $reasonId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function offerAlreadyReportedByUser(int $offerId): bool
    {
        $sql = "SELECT
                    id
                FROM
                    {$this->table}
                WHERE
                    id_offer = :id_offer
                AND
                    id_author = :id_author
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_offer", $offerId, \PDO::PARAM_INT);
        $sql->bindParam(":id_author", user()["id"], \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }
}