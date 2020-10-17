<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;

class QueueController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authenticated()->withPermission("MANAGE_QUEUE");
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

    public function approve(string $slug = ""): ?bool
    {
        $offer = new Offer();

        if (empty($slug)) {
            $this->redirect(DIRPAGE);
        }

        $offerId = $offer->getId("slug", $slug);

        if ($offer->updateStatus($offerId, "approved")) {
            return true;
        }

        die("Não foi possível aprovar essa oferta.");
    }

    public function refuse(string $slug = ""): ?bool
    {
        $offer = new Offer();

        if (empty($slug)) {
            $this->redirect(DIRPAGE);
        }

        $offerId = $offer->getId("slug", $slug);

        if ($offer->updateStatus($offerId, "refused")) {
            return true;
        }

        die("Não foi possível recusar essa oferta.");
    }
}