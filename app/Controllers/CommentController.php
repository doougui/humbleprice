<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Comment;
use App\Models\Offer;

class CommentController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list(string $slug = null): void
    {
        $offer = new Offer();
        $comment = new Comment();

        if ($_SERVER["HTTP_REFERER"] !== DIRPAGE."offer/view/{$slug}") {
            die(json_encode([]));
        }

        if (
            empty($slug)
            || ! $offerId = $offer->getId("slug", $slug)
        ) {
            die(
                json_encode(
                    ["error" => "Oferta inválida."]
                )
            );
        }

        $offerData = $offer->getInfo("id", $offerId, ["status"]);

        if (
            ! $this->hasPermission("MANAGE_OFFERS")
            && $offerData["status"] !== "approved"
        ) {
            die(
                json_encode(
                    ["error" => "Você não tem permissão para realizar esta ação."]
                )
            );
        }

        $comments = $comment->getOfferComments($offerId);

        die(
            json_encode(
                $comments
            )
        );
    }

    public function publish(string $slug = null): void
    {
        $this->authRequired();

        $offer = new Offer();
        $comment = new Comment();

        if ($_SERVER["HTTP_REFERER"] !== DIRPAGE."offer/view/{$slug}") {
            die(json_encode([]));
        }

        if (
            empty($slug)
            || ! $offerId = $offer->getId("slug", $slug)
        ) {
            die(
                json_encode(
                    ["error" => "Oferta inválida."]
                )
            );
        }

        $offerData = $offer->getInfo("id", $offerId, ["status"]);

        if (
            ! $this->hasPermission("MANAGE_OFFERS")
            && $offerData["status"] !== "approved"
        ) {
            die(
                json_encode(
                    ["error" => "Você não tem permissão para realizar esta ação."]
                )
            );
        }

        if (isset($_POST["comment"])) {
            $commentData = $_POST["comment"];

            $info = [
                "comment" => $commentData,
                "offerId" => $offerId
            ];

            if (strlen($commentData) !== 0) {
                if ($comment->store($info)) {
                    die(json_encode([]));
                }

                die(
                    json_encode(
                        ["error" => "Algo de errado ocorreu. Tente novamente mais tarde!"]
                    )
                );
            }
        }

        die(
            json_encode(
                ["error" => "Preencha todos os campos para continuar"]
            )
        );
    }
}