<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;
use App\Models\OfferLike;

class OfferlikeController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add(string $slug = null): void
    {
        $offer = new Offer();
        $offerLike = new OfferLike();

        if (! $this->isAjax()) {
            $this->redirect(DIRPAGE);
        }

        if (
            empty($slug)
            || ! $offerId = $offer->getId("slug", $slug)
        ) {
            die(
                json_encode(
                    ["error" => "Esta oferta é inválida."]
                )
            );
        }

        if (! $this->authenticated()) {
            die(
                json_encode(
                    [
                        "error" => "Você precisa estar logado para 
                            realizar esta ação."
                    ]
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
                    [
                        "error" => "Você não tem permissão para 
                        realizar esta ação."
                    ]
                )
            );
        }

        $liked = $offerLike->liked($offerId, user()["id"]);

        if ($liked) {
            $offerLike->remove($offerId, user()["id"]);
            die(json_encode([]));
        }

        $offerLike->add($offerId, user()["id"]);
        die(json_encode([]));
    }
}