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

    public function getLastReports(string $status = "pending"): array
    {
        $sql = "SELECT 
                    users.name AS author,
                    offers.image AS image,
                    offers.name AS offer_name,
                    offers.slug AS offer_slug,
                    reasons.name AS reason,
                    reported_at,
                    reports.status
                FROM 
                    {$this->table} 
                INNER JOIN
                    users
                ON
                    {$this->table}.id_author = users.id
                INNER JOIN
                    offers
                ON
                    {$this->table}.id_offer = offers.id
                INNER JOIN
                    reasons
                ON
                    {$this->table}.id_reason = reasons.id
                WHERE 
                    (offers.end_offer >= NOW() OR offers.end_offer is null)
                AND
                    {$this->table}.status = :status
                ORDER BY 
                    reported_at 
                DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":status", $status, \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }

        return [];
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
                AND
                    status != 'closed'
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