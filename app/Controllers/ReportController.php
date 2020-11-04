<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;

class ReportController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authRequired();
    }

    public function index(): void
    {
        $this->withPermission("MANAGE_OFFERS");
        
        
    }

    public function create(
        string $offerSlug = null,
        string $reasonSlug = null
    ): void {
        $offer = new Offer();
        $reason = new Reason();

        if (
            empty($offerSlug)
            || ! $offerId = $offer->getId("slug", $offerSlug)
        ) {
            die(json_encode(["error" => "A oferta especificada é inválida."]));
        }

        if (
            empty($reasonSlug)
            || ! $offerId = $reason->getId("slug", $reasonSlug)
        ) {
            die(json_encode(["error" => "O tipo do report é inválido."]));
        }
    }
}