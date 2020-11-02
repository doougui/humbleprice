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
            die(
                json_encode(
                    ["error" => "Direct access not allowed"]
                )
            );
        }

        if (
            empty($slug)
            || ! $offerId = $offer->getId("slug", $slug)
        ) {
            die("Esta oferta é inválida.");
        }

        if (! $this->authenticated()) {
            die("Você precisa estar logado para realizar esta ação.");
        }

        $offerData = $offer->getInfo("id", $offerId, ["status"]);

        if (
            ! $this->hasPermission("MANAGE_OFFERS")
            && $offerData["status"] !== "approved"
        ) {
            die("Você não tem permissão para realizar esta ação.");
        }

        $liked = $offerLike->liked($offerId, user()["id"]);

        if ($liked) {
            $offerLike->remove($offerId, user()["id"]);
            die();
        }

        $offerLike->add($offerId, user()["id"]);
    }
}