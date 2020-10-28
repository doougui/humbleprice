<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;
use App\Models\Like;

class LikeController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    public function add(string $slug = null): void
    {
        $offer = new Offer();
        $like = new Like();

        if (
            empty($slug)
            || ! $offerId = $offer->getId("slug", $slug)
        ) {
            die("Esta oferta é inválida.");
        }

        if (! $this->authenticated()) {
            die("Você precisa estar logado para realizar esta ação.");
        }

        $liked = $like->liked($offerId, user()["id"]);

        if ($liked) {
            $like->remove($offerId, user()["id"]);
            die();
        }

        $like->add($offerId, user()["id"]);
    }
}