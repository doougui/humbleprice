<?php

namespace App\Controllers;

use App\Models\Offer;
use App\Models\User;

class QueueController extends Controller
{
    public function index(): void
    {
        $user = new User();
        $offer = new Offer();

        if (! isset($_SESSION["user"]) ||
            ! $user->hasPermission(
            $this->getData()["user"]["id_role"],
            "MANAGE_QUEUE")
        ) {
            header("Location: ".DIRPAGE);
            exit;
        }

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
}