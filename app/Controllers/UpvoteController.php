<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;
use App\Models\Upvote;

class UpvoteController extends Authorization
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
        $upvote = new Upvote();

        if (
            empty($slug)
            || ! $offerId = $offer->getId("slug", $slug)
        ) {
            die("Esta oferta é inválida.");
        }

        if (! $this->authenticated()) {
            die("Você precisa estar logado para realizar esta ação.");
        }

        $upvoted = $upvote->upvoted($offerId, user()["id"]);

        if ($upvoted) {
            $upvote->remove($offerId, user()["id"]);
            die();
        }

        $upvote->add($offerId, user()["id"]);
    }
}