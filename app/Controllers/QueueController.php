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

        $perPage = 30;
        $pagination = paginate($offer, $perPage, ["status" => "approved"]);

        $this->setData(
            "pendingOffers",
            $offer->getLastOffers(
                $pagination["offset"],
                $perPage,
                null,
                null,
                "pending"
        ));

        $this->setData("totalPages", $pagination["totalPages"]);
        $this->setData("currentPage", $pagination["currentPage"]);

        $this->renderLayout($this->getData());
    }
}