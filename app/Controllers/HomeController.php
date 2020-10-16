<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;

class HomeController extends Authorization
{
    public function index(): void
    {
        $offer = new Offer();

        $this->setDir("Home");
        $this->setTitle("Encontre os melhores preços | Humbleprice");
        $this->setDescription("Aqui você encontra os produtos que você deseja com os melhores preços possíveis.");
        $this->setKeywords("ofertas, produtos, preço");

        $this->setData("offers", $offer->getLastOffers());

        $this->renderLayout($this->getData());
    }
}