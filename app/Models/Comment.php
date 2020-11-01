<?php

namespace App\Models;

use App\Core\Table;

class Comment extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "comments";
    }

    public function getOfferComments(int $offerId): array
    {
        $sql = "SELECT
                    comments.id,
                    id_parent, 
                    users.name AS author,
                    users.avatar AS avatar,
                    comment,
                    created_at
                FROM
                    comments
                INNER JOIN
                    users
                ON
                    comments.id_author = users.id
                WHERE 
                    id_offer = :id_offer
                AND 
                    id_parent is null
                ORDER BY
                    created_at
                DESC
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_offer", $offerId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $comments = $sql->fetchAll();

            foreach ($comments as $key => $comment) {
                $sql = "SELECT
                    comments.id AS id,
                    id_parent, 
                    users.name AS author,
                    users.avatar AS avatar,
                    comment,
                    created_at
                FROM
                    comments
                INNER JOIN
                    users
                ON
                    comments.id_author = users.id
                WHERE 
                    id_offer = :id_offer
                AND
                    id_parent = :id_parent
                ";
                $sql = $this->db->prepare($sql);
                $sql->bindParam(":id_parent", $comment["id"], \PDO::PARAM_INT);
                $sql->bindParam(":id_offer", $offerId, \PDO::PARAM_INT);
                $sql->execute();

                if ($sql->rowCount() > 0) {
                    $children = $sql->fetchAll();

                    foreach ($children as $child) {
                        $comments[$key]["children"][] = $child;
                    }
                }
            }

            return $comments;
        }

        return [];
    }

    public function store(array $info): array
    {
        $sql = "INSERT INTO
                    {$this->table}
                    (id_offer, id_author, comment)
                VALUES
                    (:id_offer, :id_author, :comment)";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_offer", $info["offerId"], \PDO::PARAM_INT);
        $sql->bindParam(":id_author", user()["id"], \PDO::PARAM_INT);
        $sql->bindParam(":comment", $info["comment"], \PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $commentId = $this->db->lastInsertId();

            $sql = "SELECT
                    comments.id AS id,
                    id_parent, 
                    users.name AS author,
                    users.avatar AS avatar,
                    comment,
                    created_at
                FROM
                    comments
                INNER JOIN
                    users
                ON
                    comments.id_author = users.id
                WHERE 
                    comments.id = :id_comment
            ";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_comment", $commentId);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            }
        }

        return [];
    }
}