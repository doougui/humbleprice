<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;

class QueueController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authRequired()->withPermission("MANAGE_QUEUE");
    }

    public function index(): void
    {
        $offer = new Offer();

        $this->setDir("Queue");
        $this->setTitle("Fila de promoções | Humbleprice");
        $this->setDescription("Verifique se uma promoção é válida ou não através da fila.");
        $this->setKeywords("ofertas, produtos, preço, fila, queue, approval");

        $this->setData(
            "pendingOffers",
            $offer->getLastOffers(null, null, "pending"
        ));

        $this->renderLayout($this->getData());
    }

    public function approve(string $slug = null): ?bool
    {
        if ($this->setOfferStatus("approved", $slug)) {
            return true;
        }

        die("Não foi possível aprovar essa oferta.");
    }

    public function refuse(string $slug = null): ?bool
    {
        if ($this->setOfferStatus("refused", $slug)) {
            return true;
        }

        die("Não foi possível recusar essa oferta.");
    }

    private function setOfferStatus(string $status, string $slug = null): ?bool
    {
        $offer = new Offer();

        if (empty($slug)) {
            die("Esta oferta é inválida.");
        }

        $offerId = $offer->getId("slug", $slug);

        if (! $offerId) {
            die("Esta oferta é inválida.");
        }

        if ($offer->updateStatus($offerId, $status)) {
            return true;
        }

        die("Não foi possível alterar o status desta oferta.");
    }
}