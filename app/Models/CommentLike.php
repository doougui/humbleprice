<?php

namespace App\Models;

use App\Core\Table;

class CommentLike extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "comment_likes";
    }

    public function liked(int $commentId, int $userId): bool
    {
        $sql = "SELECT
                    id
                FROM
                    {$this->table}
                WHERE
                    id_comment = :id_comment
                AND
                    id_user = :id_user
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_comment", $commentId, \PDO::PARAM_INT);
        $sql->bindParam(":id_user", $userId, \PDO::PARAM_INT);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function add(int $commentId, int $userId): void
    {
        $sql = "INSERT INTO
                    {$this->table}
                    (id_comment, id_user)
                VALUES
                    (:id_comment, :id_user)
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam(":id_comment", $commentId, \PDO::PARAM_INT);
        $sql->bindParam(":id_user", $userId, \PDO::PARAM_INT);
        $sql->execute();
    }

    public function remove(int $commentId, int $userId): void
    {
        $sql = "DELETE FROM
                    {$this->table}
                WHERE
                    id_comment = :id_comment
                AND
                    id_user = :id_user
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindParam("id_comment", $commentId, \PDO::PARAM_INT);
        $sql->bindParam("id_user", $userId, \PDO::PARAM_INT);
        $sql->execute();
    }
}