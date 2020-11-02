<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Offer;
use App\Models\OfferLike;

class CommentlikeController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add(string $id = null): void
    {
        $comment = new Comment();
        $commentLike = new CommentLike();
        $offer = new Offer();

        if (! $this->isAjax()) {
            die(
                json_encode(
                    ["error" => "Direct access not allowed"]
                )
            );
        }

        if (
            empty($id)
            || ! $commentData = $comment->getInfo("id", $id, ["id_offer"])
        ) {
            die("Este comentário é inválido.");
        }

        if (! $this->authenticated()) {
            die("Você precisa estar logado para realizar esta ação.");
        }

        $offerData = $offer->getInfo(
            "id",
            $commentData["id_offer"],
            ["slug", "status"]
        );

        if (
            ! $this->hasPermission("MANAGE_OFFERS")
            && $offerData["status"] !== "approved"
        ) {
            die("Você não tem permissão para realizar esta ação.");
        }

        $liked = $commentLike->liked($id, user()["id"]);

        if ($liked) {
            $commentLike->remove($id, user()["id"]);
            die();
        }

        $commentLike->add($id, user()["id"]);
    }
}